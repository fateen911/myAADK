<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';

    protected $fillable = [
        'users_id',
        'no_kp',
        'nama',
        'emel',
        'no_tel',
        'jawatan',
        'peranan',
        'negeri_bertugas',
        'daerah_bertugas',
    ];

    public function program()
    {
        return $this->hasMany(Program::class);
    }
}
