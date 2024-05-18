<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Negeri extends Model
{
    use HasFactory;

    protected $table = 'senarai_negeri';

    protected $fillable = [
        'id',
        'negeri',
    ];
}
