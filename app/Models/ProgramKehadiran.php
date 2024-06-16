<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramKehadiran extends Model
{
    use HasFactory;

    protected $table = 'program_kehadiran';

    protected $fillable = [
        'program_id',
        'klien_id',
        'pegawai_id',
        'tkh_pengesahan',
        'pengesahan',
        'catatan',
        'pautan',
        'tkh_pengesahan',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function program(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    public function klien(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Klien::class);
    }
}
