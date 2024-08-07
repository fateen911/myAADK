<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawatanKlienUpdateRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'klien_id', 
        'requested_data', 
        'status'
    ];

    public function rawatanKlien()
    {
        return $this->belongsTo(RawatanKlien::class, 'klien_id');
    }
}
