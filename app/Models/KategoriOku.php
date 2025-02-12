<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriOku extends Model
{
    use HasFactory;

    protected $table = 'senarai_oku';

    protected $fillable = [
        'id',
        'kategori',
    ];
}
