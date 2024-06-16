<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $table = 'program';

    protected $fillable = [
        'penganjur_id',
        'nama',
        'objektif',
        'tempat',
        'tarikh',
        'masa',
        'catatan',
        'pautan'
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function programKehadiran()
    {
        return $this->hasMany(ProgramKehadiran::class);
    }
}
