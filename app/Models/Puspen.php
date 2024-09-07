<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puspen extends Model
{
    use HasFactory;

    protected $table = 'senarai_puspen';

    protected $fillable = [
        'id',
        'negeri_id',
        'puspen',
    ];
}
