<?php

namespace App\Exports;

use App\Models\DaerahPejabat;
use App\Models\Negeri;
use App\Models\NegeriPejabat;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class PelaporanAktivitiExcel implements FromArray, WithHeadings, WithStyles, WithTitle
{
    protected $program;

    public function __construct($program)
    {
        $this->program = $program;
    }

    /**
     * @return array
     */
    public function array(): array
    {
        $data = [
            [''], // Empty row for spacing
            [''], // Empty row for spacing
            ['BIL.','NAMA', 'ID', 'KATEGORI', 'TEMPAT AKTIVITI', 'AADK NEGERI', 'AADK DAERAH', 'STATUS']
        ];

        $count = 1;
        foreach ($this->program as $item) {
            // Get the state and district names based on the negeri_pejabat and daerah_pejabat
            $negeri = NegeriPejabat::where('id', $item->negeri)->first();
            $daerah = DaerahPejabat::where('kod', $item->daerah)->first();

            $displayNegeri = $negeri->negeri;
            if (Str::contains($displayNegeri, 'NEGERI SEMBILAN')|| Str::contains($displayNegeri, 'WILAYAH PERSEKUTUAN')) {
                // For Negeri Sembilan, remove only 'AADK '
                $displayNegeri = Str::replaceFirst('AADK', '', $negeri->negeri);
            } else {
                // For others, remove 'AADK NEGERI '
                $displayNegeri = Str::replaceFirst('AADK NEGERI', '', $negeri->negeri);
            }

            $data[] = [
                $count,
                strtoupper($item->nama),
                $item->custom_id,
                strtoupper($item->kategori->nama),
                strtoupper($item->tempat),
                strtoupper($displayNegeri),
                strtoupper(str_replace('AADK DAERAH', '', $daerah->daerah)),
                $item->status,
            ];
            $count++;
        }

        return $data;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'PELAPORAN - SENARAI AKTIVITI';
    }

    /**
     * @param Worksheet $sheet
     * @return void
     */
    public function styles(Worksheet $sheet)
    {
        // Title row style
        $sheet->mergeCells('A1:H1');
        $sheet->setCellValue('A1', 'PELAPORAN - SENARAI AKTIVITI');
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);

        // Table header styles
        $sheet->getStyle('A3')->getFont()->setBold(true);
        $sheet->getStyle('B3')->getFont()->setBold(true);
        $sheet->getStyle('C3')->getFont()->setBold(true);
        $sheet->getStyle('D3')->getFont()->setBold(true);
        $sheet->getStyle('E3')->getFont()->setBold(true);
        $sheet->getStyle('F3')->getFont()->setBold(true);
        $sheet->getStyle('G3')->getFont()->setBold(true);
        $sheet->getStyle('H3')->getFont()->setBold(true);

        // Style the table with borders
        $highestRow = $sheet->getHighestRow(); // Get the highest row number
        $highestColumn = $sheet->getHighestColumn(); // Get the highest column letter
        $range = 'A3:' . $highestColumn . $highestRow; // Define the range of the table

        // Apply borders
        $sheet->getStyle($range)->applyFromArray([
            'borders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
                'inside' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);

        // Adjust column widths
        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(30);
        $sheet->getColumnDimension('C')->setWidth(10);
        $sheet->getColumnDimension('D')->setWidth(30);
        $sheet->getColumnDimension('E')->setWidth(30);
        $sheet->getColumnDimension('F')->setWidth(30);
        $sheet->getColumnDimension('G')->setWidth(30);
        $sheet->getColumnDimension('H')->setWidth(20);

    }
}


