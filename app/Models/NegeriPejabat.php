<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NegeriPejabat extends Model
{
    use HasFactory;

    protected $table = 'senarai_negeri_pejabat';

    protected $fillable = [
        'id',
        'negeri_id',
        'negeri',
        'alamat',
        'no_tel',
        'no_fax',
    ];
}
