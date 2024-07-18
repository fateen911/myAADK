<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasanganKlienUpdateRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'klien_id', 
        'requested_data', 
        'status'
    ];

    public function client()
    {
        return $this->belongsTo(PasanganKlien::class, 'klien_id');
    }
}
