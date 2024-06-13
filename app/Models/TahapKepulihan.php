<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahapKepulihan extends Model
{
    use HasFactory;

    protected $table = 'tahap_kepulihan';

    protected $fillable = [
        'tahap',
        'kebarangkalian',
    ];
}
