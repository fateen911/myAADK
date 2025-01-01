<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotifikasiPegawaiDaerah extends Model
{
    use HasFactory;

    protected $table = 'notifikasi_pegawai_daerah';

    protected $fillable = [
        'klien_id',
        'message',
        'daerah_aadk_baru',
        'daerah_aadk_asal',
        'is_read',
    ];

    public function klien() {
        return $this->belongsTo(Klien::class);
    }
}
