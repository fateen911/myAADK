<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;

class AnalisisMKExcel implements FromView, WithEvents
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function view(): View
    {
        $sixMonthsAgo = now()->subMonths(6);
        $modalKepulihan = [
            'modal_fizikal', 'modal_psikologi', 'modal_sosial', 'modal_persekitaran', 'modal_insaniah',
            'modal_spiritual', 'modal_rawatan', 'modal_kesihatan', 'modal_strategi_daya_tahan', 'modal_resiliensi'
        ];

        // Fetch data with filters
        $query = DB::table('keputusan_kepulihan_klien as kk')
            ->join('skor_modal as sm', function ($join) {
                $join->on('kk.klien_id', '=', 'sm.klien_id')
                    ->on('kk.sesi', '=', 'sm.sesi');
            })
            ->join('klien as u', 'kk.klien_id', '=', 'u.id')
            ->select('kk.klien_id', 'kk.skor', 'sm.*')
            ->where('kk.updated_at', '>=', $sixMonthsAgo)
            ->where('kk.status', 'Selesai');

        // Apply filters if set
        if (!empty($this->filters['tahap_kepulihan_id'])) {
            $query->where('kk.tahap_kepulihan_id', $this->filters['tahap_kepulihan_id']);
        }
        if (!empty($this->filters['aadk_negeri_s'])) {
            $query->where('u.negeri', $this->filters['aadk_negeri_s']);
        }
        if (!empty($this->filters['aadk_daerah_s'])) {
            $query->where('u.daerah', $this->filters['aadk_daerah_s']);
        }

        $data = collect($query->get());

        // Define categories for classification
        $categories = collect([
            'Sangat Memuaskan' => [3.51, 4.0],
            'Memuaskan' => [2.51, 3.5],
            'Kurang Memuaskan' => [1.51, 2.5],
            'Sangat Tidak Memuaskan' => [1.0, 1.5],
        ]);

        // Count clients per category & modal
        $counts = $categories->mapWithKeys(function ($range, $category) use ($data, $modalKepulihan) {
            return [
                $category => collect($modalKepulihan)->mapWithKeys(function ($modal) use ($data, $range) {
                    return [$modal => $data->filter(fn($item) => $item->$modal >= $range[0] && $item->$modal <= $range[1])->count()];
                })
            ];
        });

        $totalClients = $data->unique('klien_id')->count();

        return view('pelaporan.modal_kepulihan.excel_analisis_modal', compact('counts', 'modalKepulihan', 'totalClients'));
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet;

                // Set specific column widths
                $sheet->getColumnDimension('A')->setWidth(25); // Tahap Kepulihan
                $sheet->getColumnDimension('J')->setWidth(30);
                $sheet->getColumnDimension('K')->setWidth(20);
                $columns = range('B', 'I'); // Adjust based on the number of columns
                foreach ($columns as $column) {
                    $sheet->getColumnDimension($column)->setWidth(20);
                }

                // Apply styling
                $sheet->getStyle('A5:K5')->getFont()->setBold(true);
                $sheet->getStyle('A5:A9')->getFont()->setBold(true);
                $sheet->getStyle('A5:K9')->getAlignment()->setHorizontal('center');

                $sheet->getStyle('A5:K9')->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'], // Black border color
                        ],
                    ],
                ]);
            }
        ];
    }
}

