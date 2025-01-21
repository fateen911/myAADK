<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TidakKerja extends Model
{
    use HasFactory;

    protected $table = 'senarai_tidak_kerja';

    protected $fillable = [
        'id',
        'alasan',
    ];
}
