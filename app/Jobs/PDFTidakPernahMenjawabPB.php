<?php

namespace App\Jobs;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class PDFTidakPernahMenjawabPB implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    protected $chunkIndex;

    public function __construct($data, $chunkIndex)
    {
        $this->data = $data;
        $this->chunkIndex = $chunkIndex;
    }

    public function handle()
    {
        $pdf = Pdf::loadView('pelaporan.modal_kepulihan.pdf_tidak_pernah_menjawab', ['filteredData' => $this->data])
                  ->setPaper('a4', 'landscape');

        $fileName = "tidak_pernah_menjawab_part_{$this->chunkIndex}.pdf";
        Storage::put("public/reports/{$fileName}", $pdf->output());
    }
}

