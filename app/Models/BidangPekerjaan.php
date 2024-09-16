<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BidangPekerjaan extends Model
{
    use HasFactory;

    protected $table = 'senarai_bidang_pekerjaan';

    protected $fillable = [
        'id',
        'bidang',
    ];
}
