<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MKTidakPernahMenjawabExcelPN implements FromCollection, WithHeadings, WithMapping, WithColumnFormatting, WithEvents,  WithColumnWidths
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
        $pegawai = Auth::user();
        $pegawaiNegeri = DB::table('pegawai')->where('users_id', $pegawai->id)->first();

        $query = DB::table('klien as u')
                    ->leftJoin('keputusan_kepulihan_klien as kk', 'u.id', '=', 'kk.klien_id') // Just a simple left join
                    ->leftJoin('senarai_negeri_pejabat as n', 'u.negeri_pejabat', '=', 'n.negeri_id')
                    ->leftJoin('senarai_daerah_pejabat as d', 'u.daerah_pejabat', '=', 'd.kod')
                    ->select(
                        'u.id as klien_id',
                        'u.nama',
                        'u.no_kp',
                        'd.daerah',  // Get the actual daerah name
                        'n.negeri',  // Get the actual negeri name
                    )
                    ->whereNull('kk.klien_id') // No records in keputusan_kepulihan_klien
                    ->where('u.negeri_pejabat', $pegawaiNegeri->negeri_bertugas);

        if (!empty($this->filters['aadk_daerah_tpm'])) {
            $query->where('u.daerah_pejabat', $this->filters['aadk_daerah_tpm']);
        }

        return collect($query->get());
    }

    public function headings(): array
    {
        return [
            ['PELAPORAN: MODAL KEPULIHAN - SENARAI KLIEN TIDAK PERNAH MENJAWAB'], 
            [''],
            [
                'BIL.',
                'NAMA',
                'NO. KAD PENGENALAN',
                'AADK NEGERI',
                'AADK DAERAH',                
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
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 36,           
            'C' => 24,
            'D' => 20,
            'E' => 30,
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => '@', // Forces column C (NO KP) to be treated as text
            'C' => NumberFormat::FORMAT_NUMBER,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                
                // Merge title row
                $sheet->mergeCells('A1:E1');
                $sheet->mergeCells('A2:E2');

                // Title Styling (Row 1)
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 16],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                ]);

                // Find the last row with data
                $lastRow = $event->sheet->getHighestRow();

                // Apply header styling (Row 3)
                $sheet->getStyle('A3:E3')->applyFromArray([
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
                $sheet->getStyle('A1:E' . $lastRow)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'], // Black border color
                        ],
                    ],
                ]);

                // Center align all data except for column B (Nama)
                $sheet->getStyle('A4:A' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('C4:E' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            },
        ];
    }
}
