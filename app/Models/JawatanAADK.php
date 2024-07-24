<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawatanAADK extends Model
{
    use HasFactory;

    protected $table = 'senarai_jawatan';

    protected $fillable = [
        'id',
        'jawatan_gred',
    ];
}
