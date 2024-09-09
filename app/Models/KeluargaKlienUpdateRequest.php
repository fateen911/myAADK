<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeluargaKlienUpdateRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'klien_id', 
        'requested_data', 
        'status',
        'alasan_ditolak'
    ];

    public function keluargaKlien()
    {
        return $this->belongsTo(KeluargaKlien::class, 'klien_id');
    }
}
