<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkorModal extends Model
{
    use HasFactory;

    protected $table = 'skor_modal';

    protected $fillable = [
        'klien_id',
        'sesi',
        'modal_fizikal',
        'modal_psikologi',
        'modal_sosial',
        'modal_persekitaran',
        'modal_insaniah',
        'modal_spiritual',
        'modal_rawatan',
        'modal_kesihatan',
        'modal_strategi_daya_tahan',
        'modal_resiliensi',
    ];
}
