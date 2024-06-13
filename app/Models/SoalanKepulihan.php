<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoalanKepulihan extends Model
{
    use HasFactory;

    protected $table = 'soalan_modal_kepulihan';

    protected $fillable = [
        'modal_id',
        'kategori_id',
        'no_soalan',
        'soalan',
    ];
}
