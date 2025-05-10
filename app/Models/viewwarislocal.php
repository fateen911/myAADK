<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class viewwarislocal extends Model
{
    use HasFactory;

    protected $table = 'viewwaris';

    protected $fillable = [
        'id_pk',
        'wr_nama',
        'wr_alamat1',
        'wr_alamat2',
        'wr_alamat3',
        'wr_poskod',
        'wr_negeri',
        'wr_notel',
        'wr_hubungan',
        
    ];
}
