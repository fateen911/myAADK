<?php

namespace App\Exports;

use App\Models\KeputusanKepulihan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MKBelumSelesaiMenjawabExcel implements FromCollection, WithHeadings, WithMapping, WithColumnFormatting, WithEvents,  WithColumnWidths
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $sixMonthsAgo = Carbon::now()->subMonths(6);

        $query = DB::table('keputusan_kepulihan_klien as kk')
                ->join('klien as u', 'kk.klien_id', '=', 'u.id')
                ->leftJoin('senarai_negeri_pejabat as n', 'u.negeri_pejabat', '=', 'n.negeri_id')
                ->leftJoin('senarai_daerah_pejabat as d', 'u.daerah_pejabat', '=', 'd.kod')
                ->select(
                    'u.id as klien_id',
                    'u.nama',
                    'u.no_kp',
                    'd.daerah as nama_daerah',  // Get the actual daerah name
                    'n.negeri as nama_negeri',  // Get the actual negeri name
                    'kk.updated_at',
                    'kk.status' // Assuming there is a status column
                )
                ->where('kk.status', '!=', 'Selesai') // Not completed responses
                ->where('kk.updated_at', '>=', $sixMonthsAgo)
                ->whereIn('kk.updated_at', function ($query) {
                    $query->select(DB::raw('MAX(updated_at)'))
                        ->from('keputusan_kepulihan_klien')
                        ->whereColumn('klien_id', 'kk.klien_id')
                        ->groupBy('klien_id');
                })
                ->groupBy('u.id', 'u.nama', 'u.no_kp', 'd.daerah', 'n.negeri','kk.updated_at', 'kk.status')
                ->orderBy('kk.updated_at', 'desc');

        if (!empty($this->filters['from_date_bs']) && !empty($this->filters['to_date_bs'])) {
            $query->whereBetween('kk.updated_at', [$this->filters['from_date_bs'], $this->filters['to_date_bs']]);
        }
        if (!empty($this->filters['aadk_negeri_bs'])) {
            $query->where('k.negeri_pejabat', $this->filters['aadk_negeri_bs']);
        }
        if (!empty($this->filters['aadk_daerah_bs'])) {
            $query->where('k.daerah_pejabat', $this->filters['aadk_daerah_bs']);
        }

        return collect($query->get());
    }

    public function headings(): array
    {
        return [
            ['PELAPORAN: MODAL KEPULIHAN - SENARAI KLIEN BELUM SELESAI MENJAWAB'], 
            [''],
            [
                'BIL.',
                'NAMA',
                'NO. KAD PENGENALAN',
                'AADK NEGERI',
                'AADK DAERAH',                
                'TARIKH TERAKHIR MENJAWAB',
            ],
        ];
    }

    public function map($row): array
    {
        // Increment the counter for "BIL" column
        static $counter = 0;
        $counter++;

        return [
            "\u{200B}" . $counter . ".", // Adds a zero-width space before the number
            $row->nama,
            strval($row->no_kp), // Converts to string without adding apostrophe
            $row->nama_negeri,
            $row->nama_daerah,
            $row->updated_at ? \Carbon\Carbon::parse($row->updated_at)->format('d/m/Y') : 'N/A',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 35,           
            'C' => 25,
            'D' => 25,
            'E' => 40,
            'F' => 30,
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => '@', // Forces column C (NO KP) to be treated as text
            'C' => NumberFormat::FORMAT_NUMBER,
            'F' => NumberFormat::FORMAT_DATE_DDMMYYYY, // Format Date
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                
                // Merge title row
                $sheet->mergeCells('A1:F1');
                $sheet->mergeCells('A2:F2');

                // Title Styling (Row 1)
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 16],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                ]);

                // Find the last row with data
                $lastRow = $event->sheet->getHighestRow();

                // Apply header styling (Row 3)
                $sheet->getStyle('A3:F3')->applyFromArray([
                    'font' => [
                        'bold' => true, 
                        'size' => 12, 
                        'color' => ['rgb' => '000000'], // Change font color to Black
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'D3D3D3'], // Gray background
                    ],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                ]);

                // Apply borders to all data rows (A1:G$lastRow)
                $sheet->getStyle('A1:F' . $lastRow)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'], // Black border color
                        ],
                    ],
                ]);

                // Center align all data except for column B (Nama)
                $sheet->getStyle('A4:A' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('C4:F' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            },
        ];
    }
}
