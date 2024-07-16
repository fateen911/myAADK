<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengesahanKehadiranProgram extends Model
{
    use HasFactory;

    protected $table = 'pengesahan_kehadiran_program';

    protected $fillable = [
        'program_id',
        'klien_id',
        'tarikh_pengesahan',
        'keputusan',
        'catatan',
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
