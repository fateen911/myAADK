<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KlienUpdateRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'klien_id', 
        'requested_data', 
        'status',
        'alasan_ditolak'
    ];

    public function client()
    {
        return $this->belongsTo(Klien::class, 'klien_id');
    }
}
