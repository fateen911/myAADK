<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MKSelesaiMenjawabExcel implements FromCollection
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
            );

        // Apply Filters
        if (!empty($this->filters['from_date_s']) && !empty($this->filters['to_date_s'])) {
            $query->whereBetween('kk.updated_at', [$this->filters['from_date_s'], $this->filters['to_date_s']]);
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
        return ['Nama', 'No. Kad Pengenalan', 'AADK Negeri', 'AADK Daerah', 'Tarikh Terakhir Menjawab', 'Tahap Kepulihan'];
    }

    public function map($row): array
    {
        return [
            $row->nama,
            $row->no_kp,
            optional($row->negeriPejabat)->negeri,
            optional($row->daerahPejabat)->daerah,
            $row->updated_at ? \Carbon\Carbon::parse($row->updated_at)->format('d/m/Y') : 'N/A',
            optional($row->tahapKepulihan)->tahap,
        ];
    }
}
