<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SejarahProfilKlien extends Model
{
    use HasFactory;

    protected $table = 'sejarah_profil_klien';

    protected $fillable = [
        'klien_id',
        'status_kemaskini',
        'bahagian_kemaskini',
        'pengemaskini',
    ];

    public function pengemaskini()
    {
        return $this->belongsTo(User::class, 'pengemaskini');
    }
}
