<?php

namespace App\Exports;

use App\Models\Program;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExcelPengesahan implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Program::all();
    }

    public function headings(): array
    {
        return [
            'penganjur_id',
            'nama',
            'objektif',
            'tempat',
            'tarikh',
            'masa',
            'catatan',
            'pautan',
            'status'
        ];
    }

    /**
     * Map the data to the desired format.
     *
     * @param mixed $user
     * @return array
     */
//    public function map($user): array
//    {
//        return [
//            $user->id,
//            $user->name,
//            $user->email,
//            $user->created_at->format('Y-m-d H:i:s'),
//            $user->updated_at->format('Y-m-d H:i:s')
//        ];
//    }

    /**
     * Apply styles to the Excel sheet.
     *
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1 => ['font' => ['bold' => true]],

            // Style a specific cell.
            'A1' => ['font' => ['bold' => true, 'color' => ['argb' => 'FF0000']]],
        ];
    }
}
