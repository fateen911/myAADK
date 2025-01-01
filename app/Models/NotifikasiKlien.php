<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotifikasiKlien extends Model
{
    use HasFactory;

    protected $table = 'notifikasi_klien';

    protected $fillable = [
        'klien_id',
        'status',
        'message',
        'is_read',
    ];

    public function klien() {
        return $this->belongsTo(Klien::class);
    }
}
