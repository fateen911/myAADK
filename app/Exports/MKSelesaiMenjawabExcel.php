<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
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
use Carbon\Carbon;

class MKSelesaiMenjawabExcel implements FromCollection, WithHeadings, WithMapping, WithColumnFormatting, WithEvents,  WithColumnWidths
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $sixMonthsAgo = Carbon::now()->subMonths(6);

        $query = DB::table('keputusan_kepulihan_klien as kk')
            ->join('klien as k', 'kk.klien_id', '=', 'k.id')
            ->join('senarai_negeri_pejabat as n', 'k.negeri_pejabat', '=', 'n.negeri_id')
            ->join('senarai_daerah_pejabat as d', 'k.daerah_pejabat', '=', 'd.kod')
            ->join('tahap_kepulihan as t', 'kk.tahap_kepulihan_id', '=', 't.id')
            ->select(
                'k.nama',
                'k.no_kp',
                'n.negeri',
                'd.daerah',
                'kk.updated_at',
                't.tahap'
            )
            ->where('kk.updated_at', '>=', $sixMonthsAgo)
            ->where('kk.status', 'Selesai')
            ->orderBy('kk.updated_at', 'desc');

        if (!empty($this->filters['from_date_s'])) {
            $query->whereDate('kk.updated_at', $this->filters['from_date_s']);
        }
        if (!empty($this->filters['to_date_s'])) {
            $query->whereDate('kk.updated_at', $this->filters['to_date_s']);
        }
        if (!empty($this->filters['tahap_kepulihan_id'])) {
            $query->where('kk.tahap_kepulihan_id', $this->filters['tahap_kepulihan_id']);
        }
        if (!empty($this->filters['aadk_negeri_s'])) {
            $query->where('k.negeri_pejabat', $this->filters['aadk_negeri_s']);
        }
        if (!empty($this->filters['aadk_daerah_s'])) {
            $query->where('k.daerah_pejabat', $this->filters['aadk_daerah_s']);
        }

        return collect($query->get());
    }

    public function headings(): array
    {
        return [
            ['PELAPORAN: MODAL KEPULIHAN - SENARAI KLIEN SELESAI MENJAWAB'], 
            [''],
            [
                'BIL.',
                'NAMA',
                'NO. KAD PENGENALAN',
                'AADK NEGERI',
                'AADK DAERAH',                
                'TARIKH TERAKHIR MENJAWAB',
                'TAHAP KEPULIHAN',
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
            $row->negeri,
            $row->daerah,
            $row->updated_at ? \Carbon\Carbon::parse($row->updated_at)->format('d/m/Y') : 'N/A',
            $row->tahap,
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
            'G' => 30,
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
                $sheet->mergeCells('A1:G1');
                $sheet->mergeCells('A2:G2');

                // Title Styling (Row 1)
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 16],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                ]);

                // Find the last row with data
                $lastRow = $event->sheet->getHighestRow();

                // Apply header styling (Row 3)
                $sheet->getStyle('A3:G3')->applyFromArray([
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
                $sheet->getStyle('A1:G' . $lastRow)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'], // Black border color
                        ],
                    ],
                ]);

                // Center align all data except for column B (Nama)
                $sheet->getStyle('A4:A' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('C4:G' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            },
        ];
    }
}