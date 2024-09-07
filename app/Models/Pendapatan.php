<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendapatan extends Model
{
    use HasFactory;

    protected $table = 'senarai_pendapatan';

    protected $fillable = [
        'id',
        'pendapatan',
    ];
}
