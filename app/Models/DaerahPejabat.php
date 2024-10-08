<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaerahPejabat extends Model
{
    use HasFactory;

    protected $table = 'senarai_daerah_pejabat';

    protected $fillable = [
        'id',
        'kod',
        'negeri_id',
        'daerah',
        'alamat',
        'no_tel',
        'no_fax',
    ];
}
