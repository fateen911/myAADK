<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daerah extends Model
{
    use HasFactory;

    protected $table = 'senarai_daerah';

    protected $fillable = [
        'id',
        'daerah',
        'negeri_id',
    ];

    public function negeri()
    {
        return $this->belongsTo(Negeri::class);
    }
}
