<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkalaJawapan extends Model
{
    use HasFactory;

    protected $table = 'skala_jawapan';

    protected $fillable = [
        'skala',
        'jawapan',
    ];
}
