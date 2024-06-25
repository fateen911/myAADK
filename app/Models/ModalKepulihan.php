<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModalKepulihan extends Model
{
    use HasFactory;

    protected $table = 'kategori_modal_kepulihan';

    protected $fillable = [
        'modal',
        'nama_modal',
    ];
}
