<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendidikan extends Model
{
    use HasFactory;

    protected $table = 'senarai_pendidikan';

    protected $fillable = [
        'id',
        'pendidikan',
    ];
}
