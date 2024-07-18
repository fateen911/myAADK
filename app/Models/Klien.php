<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klien extends Model
{
    use HasFactory;

    protected $table = 'klien';

    protected $fillable = [
        'no_kp',
        'nama',
        'no_tel',
        'emel',
        'alamat_rumah',
        'poskod',
        'daerah',
        'negeri',
        'jantina',
        'agama',
        'bangsa',
        'tahap_pendidikan',
        'status_kemaskini',
    ];

    public function profileUpdateRequests()
    {
        return $this->hasMany(KlienUpdateRequest::class, 'klien_id');
    }

    public function programKehadiran()
    {
        return $this->hasMany(ProgramKehadiran::class);
    }

    public function pegesahanKehadiranProgram()
    {
        return $this->hasMany(PengesahanKehadiranProgram::class);
    }

    public function perekodanKehadiranProgram()
    {
        return $this->hasMany(PerekodanKehadiranProgram::class);
    }
}
