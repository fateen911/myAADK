<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriProgram extends Model
{
    use HasFactory;

    protected $table = 'kategori_program';

    protected $fillable = [
        'nama',
    ];

    public function program()
    {
        return $this->hasMany(Program::class);
    }
}
