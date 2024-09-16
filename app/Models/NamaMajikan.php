<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NamaMajikan extends Model
{
    use HasFactory;

    protected $table = 'senarai_majikan';

    protected $fillable = [
        'id',
        'majikan',
    ];
}
