<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class viewklienlocal extends Model
{
    use HasFactory;

    protected $table = 'viewklien';

    protected $fillable = [
        'AADK_Negeri',
        'AADK_Daerah',
        'id_pk',
        'id_ki',
        'mykad',
        'nama',
        'jantina',
        'emel',
        'penyakit',
        'oku',
        'pendaftaran oku',
        'kategori oku',
        'telefon',
        'id_agama',
        'agama',
        'id_bangsa',
        'bangsa',
        'id_pendidikan',
        'pendidikan',
        'st_kahwin',
        'markah',
        'tkh_penilaian',
        'id_fasiliti',
        'tkh_perintah',
        'ki_detail_seksyen',
        'tkh_mulaPengawasan',
        'tkh_tamatPengawasan',
        'PUSPEN01',
        'Neg_PUSPEN01',
        'Nama_PUSPEN01',
        'PUSPEN02',
        'Neg_PUSPEN02',
        'Nama_PUSPEN02',
        'alamat01',
        'alamat02',
        'alamat03',
        'poskod',
        'negeri',
    ];
}
