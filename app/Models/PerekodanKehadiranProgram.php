<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpOffice\PhpSpreadsheet\Calculation\Financial\Securities\Price;

class PerekodanKehadiranProgram extends Model
{
    use HasFactory;

    protected $table = 'perekodan_kehadiran_program';

    protected $fillable = [
        'program_id',
        'klien_id',
        'tarikh_perekodan',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function klien()
    {
        return $this->belongsTo(Klien::class);
    }
}
