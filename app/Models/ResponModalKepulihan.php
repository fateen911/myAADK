<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponModalKepulihan extends Model
{
    use HasFactory;

    protected $table = 'respon_modal_kepulihan';

    protected $fillable = [
        'klien_id',
        'soalan_id',
        'skala_id',
        'status',
    ];
}
