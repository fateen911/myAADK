<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkalaModalKepulihan extends Model
{
    use HasFactory;

    protected $table = 'skala_modal_kepulihan';

    protected $fillable = [
        'klien_id',
        'modal_id',
        'skala_id',
        'sesi',
    ];
}
