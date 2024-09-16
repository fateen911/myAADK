<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NamaPekerjaan extends Model
{
    use HasFactory;

    protected $table = 'senarai_pekerjaan';

    protected $fillable = [
        'id',
        'pekerjaan',
    ];
}
