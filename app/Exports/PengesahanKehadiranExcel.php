<?php
namespace App\Exports;

use App\Models\DaerahPejabat;
use App\Models\Negeri;
use App\Models\PengesahanKehadiranProgram;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class PengesahanKehadiranExcel implements FromArray, WithHeadings, WithStyles, WithTitle
{
    protected $nama;
    protected $tarikh_mula;
    protected $tarikh_tamat;
    protected $tempat;
    protected $pengesahan;

    public function __construct($program, $pengesahan)
    {
        $this->nama = strtoupper($program->nama);
        $this->tarikh_mula = Carbon::parse($program->tarikh_mula)->format('d/m/Y, h:iA');
        $this->tarikh_tamat = Carbon::parse($program->tarikh_tamat)->format('d/m/Y, h:iA');
        $this->tempat = strtoupper($program->tempat);

        // Fetch program and klien details using Eloquent relationships
        $pengesahan_data = PengesahanKehadiranProgram::with('program','klien')->where('program_id', $program->id)->get();

        // Initialize empty arrays for storing negeri and daerah values
        $pengesahan = [];
        $count = 1;
        // Loop through each pengesahan to fetch negeri and daerah
        foreach ($pengesahan_data as $item) {
            // Get the state and district names based on the klien's negeri_pejabat and daerah_pejabat
            $negeri = Negeri::where('id', $item->klien->negeri_pejabat)->first();
            $daerah = DaerahPejabat::where('kod', $item->klien->daerah_pejabat)->first();

            // Add the negeri and daerah information to each pengesahan
            $pengesahan[] = [
                'count' => $count,
                'klien' => $item->klien->nama,
                'no_kp' => $item->klien->no_kp,
                'alamat' => $item->klien->alamat_rumah,
                'no_tel' => $item->klien->no_tel ? $item->klien->no_tel : 'TIADA',
                'keputusan' => $item->keputusan,
                'negeri' => $negeri ? $negeri->negeri : 'TIADA',
                'daerah' => $daerah ? $daerah->daerah : 'TIADA',
                'catatan' => $item->catatan ? $item->catatan : 'TIADA',
            ];
            $count++;
        }

        $this->pengesahan = $pengesahan;
    }

    /**
     * @return array
     */
    public function array(): array
    {
        $data = [
            [''], // Empty row for spacing
            [''], // Empty row for spacing
            ['NAMA AKTIVITI: ' . $this->nama],
            ['TARIKH/MASA MULA: ' . $this->tarikh_mula],
            ['TARIKH/MASA TAMAT: ' . $this->tarikh_tamat],
            ['TEMPAT: ' . $this->tempat],
            [''], // Empty row for spacing
            ['BIL.','NAMA', 'NO. KAD PENGENALAN', 'ALAMAT', 'NO. TELEFON', 'PENGESAHAN','NEGERI', 'DAERAH','CATATAN']
        ];

        $data[] = $this->pengesahan;

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
        return 'SENARAI MAKLUM BALAS KEHADIRAN';
    }

    /**
     * @param Worksheet $sheet
     * @return void
     */
    public function styles(Worksheet $sheet)
    {
        // Title row style
        $sheet->mergeCells('A1:I1');
        $sheet->setCellValue('A1', 'SENARAI MAKLUM BALAS KEHADIRAN');
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);

        // Program name, date and place styles
        $sheet->getStyle('A3')->getFont()->setBold(true);
        $sheet->getStyle('A4')->getFont()->setBold(true);
        $sheet->getStyle('A5')->getFont()->setBold(true);
        $sheet->getStyle('A6')->getFont()->setBold(true);

        // Table header styles
        $sheet->getStyle('A8')->getFont()->setBold(true);
        $sheet->getStyle('B8')->getFont()->setBold(true);
        $sheet->getStyle('C8')->getFont()->setBold(true);
        $sheet->getStyle('D8')->getFont()->setBold(true);
        $sheet->getStyle('E8')->getFont()->setBold(true);
        $sheet->getStyle('F8')->getFont()->setBold(true);
        $sheet->getStyle('G8')->getFont()->setBold(true);
        $sheet->getStyle('H8')->getFont()->setBold(true);
        $sheet->getStyle('I8')->getFont()->setBold(true);

        // Style the table with borders
        $highestRow = $sheet->getHighestRow(); // Get the highest row number
        $highestColumn = $sheet->getHighestColumn(); // Get the highest column letter
        $range = 'A8:' . $highestColumn . $highestRow; // Define the range of the table

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

        // Set national ID column to text
        $nationalIdColumn = 'C'; // National ID is in column C
        for ($row = 8; $row <= $highestRow; $row++) {
            $sheet->setCellValueExplicit($nationalIdColumn . $row, $sheet->getCell($nationalIdColumn . $row)->getValue(), DataType::TYPE_STRING);
        }
        // Adjust column widths
        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(40);
        $sheet->getColumnDimension('C')->setWidth(20);
        $sheet->getColumnDimension('D')->setWidth(50);
        $sheet->getColumnDimension('E')->setWidth(20);
        $sheet->getColumnDimension('F')->setWidth(20);
        $sheet->getColumnDimension('G')->setWidth(20);
        $sheet->getColumnDimension('H')->setWidth(20);
        $sheet->getColumnDimension('I')->setWidth(20);
    }
}

