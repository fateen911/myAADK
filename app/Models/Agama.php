<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agama extends Model
{
    use HasFactory;

    protected $table = 'senarai_agama';

    protected $fillable = [
        'id',
        'agama',
    ];
}
