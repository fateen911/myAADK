<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DaftarPenggunaController;
use App\Http\Controllers\ProfilKlienController;
use Illuminate\Support\Facades\Route;

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', function () {
    return view('welcome');
});

// DASHBOARD
Route::get('/dashboard',[HomeController::class, 'index'])->middleware('auth')->name('dashboard');

// KEMASKINI PROFIL AKAUN PENGGUNA
Route::middleware('auth')->group(function () {
    Route::get('/kemaskini/kata-laluan', [ProfileController::class, 'updatePassword'])->name('update.password');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// PENTADBIR - DAFTAR PENGGUNA
Route::get('/senarai-pengguna',[DaftarPenggunaController::class, 'senaraiPengguna'])->middleware('auth')->name('senarai-pengguna');
Route::post('kemaskini-pengguna', [DaftarPenggunaController::class, 'kemaskiniPengguna'])->name('kemaskini-pengguna');
Route::post('daftar-pengguna', [DaftarPenggunaController::class, 'daftarPengguna'])->name('daftar-pengguna');

// PENTADBIR - PENGURUSAN PROFIL 
Route::get('/senarai-klien',[ProfilKlienController::class, 'senaraiKlien'])->middleware('auth')->name('senarai-klien');
Route::get('/maklumat-klien/{id}', [ProfilKlienController::class, 'approveUpdate'])->middleware('auth')->name('maklumat-klien');
Route::post('/kemaskini/maklumat/peribadi-klien/{id}', [ProfilKlienController::class, 'kemaskiniMaklumatPeribadiKlien'])->middleware('auth')->name('kemaskini.maklumat.peribadi.klien');
Route::post('/kemaskini/maklumat/pekerjaan-klien/{id}', [ProfilKlienController::class, 'kemaskiniMaklumatPekerjaanKlien'])->middleware('auth')->name('kemaskini.maklumat.pekerjaan.klien');
Route::post('/kemaskini/maklumat/waris-klien/{id}', [ProfilKlienController::class, 'kemaskiniMaklumatWarisKlien'])->middleware('auth')->name('kemaskini.maklumat.waris.klien');
Route::post('/kemaskini/maklumat/pasangan-klien/{id}', [ProfilKlienController::class, 'kemaskiniMaklumatPasanganKlien'])->middleware('auth')->name('kemaskini.maklumat.pasangan.klien');
Route::post('/kemaskini/maklumat/rawatan-klien/{id}', [ProfilKlienController::class, 'kemaskiniMaklumatRawatanKlien'])->middleware('auth')->name('kemaskini.maklumat.rawatan.klien');

// PENTADBIR - APPROVE REQUEST TO UPDATE PROFILE 
Route::get('/officer/view-requests/{id}', [ProfilKlienController::class, 'viewUpdateRequest'])->name('pegawai.viewUpdateRequest');
Route::patch('/approve-update/{id}', [ProfilKlienController::class, 'approveUpdate'])->name('pegawai.approveUpdate');

// KLIEN - PENGURUSAN PROFIL 
Route::get('/pengurusan/profil-peribadi', [ProfilKlienController::class, 'pengurusanProfil'])->middleware('auth')->name('pengurusan-profil');
Route::get('muat-turun/maklumat-profil-diri', [ProfilKlienController::class, 'muatTurunProfilDiri'])->name('export.profil.diri');

// KLIEN - SEND REQUEST TO UPDATE PROFILE 
Route::post('/klien/profil-peribadi/request-update', [ProfilKlienController::class, 'klienRequestUpdate'])->name('klien.requestUpdate');
Route::post('/klien/maklumat-rawatan/request-update', [ProfilKlienController::class, 'rawatanKlienRequestUpdate'])->name('rawatanKlien.requestUpdate');
Route::post('/klien/maklumat-perkerjaan/request-update', [ProfilKlienController::class, 'pekerjaanKlienRequestUpdate'])->name('pekerjaanKlien.requestUpdate');
Route::post('/klien/maklumat-waris/request-update', [ProfilKlienController::class, 'warisKlienRequestUpdate'])->name('warisKlien.requestUpdate');
Route::post('/klien/maklumat-pasangan/request-update', [ProfilKlienController::class, 'pasanganKlienRequestUpdate'])->name('pasanganKlien.requestUpdate');


require __DIR__.'/auth.php';
