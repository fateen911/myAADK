<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class viewfamililocal extends Model
{
    use HasFactory;

    protected $table = 'viewfamili';

    protected $fillable = [
        'id_pk',
        'lk_nama_bapa',
        'status_bapa',
        'lk_notel_bapa',
        'lk_nama_ibu',
        'status_ibu',
        'lk_notel_ibu',
        'lk_nama_psgn',
        'status_psgn',
        'lk_notel_psgn',
        'lk_kerja_psgn',
        
    ];
}
