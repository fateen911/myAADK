<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bangsa extends Model
{
    use HasFactory;

    protected $table = 'senarai_bangsa';

    protected $fillable = [
        'id',
        'bangsa',
    ];
}
