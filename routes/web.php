<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DaftarPenggunaController;
use App\Http\Controllers\ProfilKlienController;
use App\Http\Controllers\PengurusanProgController;
use App\Http\Controllers\ModalKepulihanController;
use Illuminate\Support\Facades\Route;

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', function () {
    return view('welcome');
});

//TRY
Route::get('/pengurusan_program/tryQR',[PengurusanProgController::class, 'tryQR'])->name('pengurusan_program.tryQR');
Route::get('/pengurusan_program/try',[PengurusanProgController::class, 'try'])->name('pengurusan_program.try');

// PENGURUSAN PROGRAM - QR CODE
Route::get('/pengurusan_program/qr_code',[PengurusanProgController::class, 'qrCode'])->name('pengurusan_program.qr_code');
Route::get('/pengurusan_program/share', [PengurusanProgController::class, 'share']);

// PENGURUSAN PROGRAM - PEGAWAI AADK
Route::get('/pengurusan_program/pegawai_aadk/daftar_prog',[PengurusanProgController::class, 'daftarProgPA'])->name('pengurusan_program.pegawai_aadk.daftar_prog');
//Route::post('/pengurusan_program/pegawai_aadk/post_daftar_prog',[PengurusanProgController::class, 'postDaftarProgPA'])->name('pengurusan_program.pegawai_aadk.post_daftar_prog');
Route::get('/pengurusan_program/pegawai_aadk/kemaskini_prog',[PengurusanProgController::class, 'kemaskiniProgPA'])->name('pengurusan_program.pegawai_aadk.kemaskini_prog');
//Route::post('/pengurusan_program/pegawai_aadk/post_kemaskini_prog',[PengurusanProgController::class, 'postKemaskiniProgPA'])->name('pengurusan_program.pegawai_aadk.post_kemaskini_prog');
Route::get('/pengurusan_program/pegawai_aadk/maklumat_prog',[PengurusanProgController::class, 'maklumatProgPA'])->name('pengurusan_program.pegawai_aadk.maklumat_prog');
Route::get('/pengurusan_program/pegawai_aadk/senarai_prog',[PengurusanProgController::class, 'senaraiProgPA'])->name('pengurusan_program.pegawai_aadk.senarai_prog');
Route::get('/pengurusan_program/pegawai_aadk/tambah_kategori',[PengurusanProgController::class, 'tambahKategoriPA'])->name('pengurusan_program.pegawai_aadk.tambah_kategori');
//Route::post('/pengurusan_program/pegawai_aadk/post_tambah_kategori',[PengurusanProgController::class, 'postTambahKategoriPA'])->name('pengurusan_program.pegawai_aadk.post_tambah_kategori');
Route::get('/pengurusan_program/pegawai_aadk/kategori_prog',[PengurusanProgController::class, 'kategoriProgPA'])->name('pengurusan_program.pegawai_aadk.kategori_prog');

// PENGURUSAN PROGRAM - PENRADBIR SISTEM
Route::get('/pengurusan_program/pentadbir_sistem/daftar_prog',[PengurusanProgController::class, 'daftarProgPS'])->name('pengurusan_program.pentadbir_sistem.daftar_prog');
//Route::post('/pengurusan_program/pentadbir_sistem/post_daftar_prog',[PengurusanProgController::class, 'postDaftarProgPS'])->name('pengurusan_program.pentadbir_sistem.post_daftar_prog');
Route::get('/pengurusan_program/pentadbir_sistem/kemaskini_prog',[PengurusanProgController::class, 'kemaskiniProgPS'])->name('pengurusan_program.pentadbir_sistem.kemaskini_prog');
//Route::post('/pengurusan_program/pentadbir_sistem/post_kemaskini_prog',[PengurusanProgController::class, 'postKemaskiniProgPS'])->name('pengurusan_program.pentadbir_sistem.post_kemaskini_prog');
Route::get('/pengurusan_program/pentadbir_sistem/maklumat_prog',[PengurusanProgController::class, 'maklumatProgPS'])->name('pengurusan_program.pentadbir_sistem.maklumat_prog');
Route::get('/pengurusan_program/pentadbir_sistem/senarai_prog',[PengurusanProgController::class, 'senaraiProgPS'])->name('pengurusan_program.pentadbir_sistem.senarai_prog');
Route::get('/pengurusan_program/pentadbir_sistem/tambah_kategori',[PengurusanProgController::class, 'tambahKategoriPS'])->name('pengurusan_program.pentadbir_sistem.tambah_kategori');
Route::post('/pengurusan_program/pentadbir_sistem/post_tambah_kategori',[PengurusanProgController::class, 'postTambahKategoriPS'])->name('pengurusan_program.pentadbir_sistem.post_tambah_kategori');
Route::get('/pengurusan_program/pentadbir_sistem/kategori_prog',[PengurusanProgController::class, 'kategoriProgPS'])->name('pengurusan_program.pentadbir_sistem.kategori_prog');

// PENGURUSAN PROGRAM - KLIEN
Route::get('/pengurusan_program/klien/daftar_kehadiran',[PengurusanProgController::class, 'daftarKehadiran'])->name('pengurusan_program.klien.daftar_kehadiran');
//Route::post('/pengurusan_program/klien/post_daftar_kehadiran',[PengurusanProgController::class, 'postDaftarKehadiran'])->name('pengurusan_program.klien.post_daftar_kehadiran');
Route::get('/pengurusan_program/klien/pengesahan_kehadiran',[PengurusanProgController::class, 'pengesahanKehadiran'])->name('pengurusan_program.klien.pengesahan_kehadiran');
//Route::post('/pengurusan_program/klien/post_pengesahan_kehadiran',[PengurusanProgController::class, 'postPengesahanKehadiran'])->name('pengurusan_program.klien.post_pengesahan_kehadiran');

// PENGURUSAN PROGRAM - HEBAHAN
Route::get('/pengurusan_program/hebahan/emel', [PengurusanProgController::class, 'hebahanEmel'])->name('pengurusan_program.hebahan.emel');
Route::get('/pengurusan_program/hebahan/sms', [PengurusanProgController::class, 'hebahanSMS'])->name('pengurusan_program.hebahan.sms');
Route::get('/pengurusan_program/hebahan/telegram', [PengurusanProgController::class, 'hebahanTelegram'])->name('pengurusan_program.hebahan.telegram');

// PENGURUSAN PROGRAM - PENRADBIR SISTEM - PDF/EXCEL
Route::get('/pengurusan_program/pdf_pengesahan',[PengurusanProgController::class, 'pdfPengesahan'])->name('pengurusan_program.pdf_pengesahan');
Route::get('/pengurusan_program/excel_pengesahan',[PengurusanProgController::class, 'excelPengesahan'])->name('pengurusan_program.excel_pengesahan');
Route::get('/pengurusan_program/pdf_perekodan',[PengurusanProgController::class, 'pdfPerekodan'])->name('pengurusan_program.pdf_perekodan');
Route::get('/pengurusan_program/excel_perekodan',[PengurusanProgController::class, 'excelPerekodan'])->name('pengurusan_program.excel_perekodan');

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
Route::get('/pentadbir/senarai-pengguna',[DaftarPenggunaController::class, 'senaraiPengguna'])->middleware('auth')->name('senarai-pengguna');
Route::post('pentadbir/kemaskini-pengguna', [DaftarPenggunaController::class, 'kemaskiniPengguna'])->name('kemaskini-pengguna');
Route::post('pentadbir/daftar-pengguna', [DaftarPenggunaController::class, 'daftarPengguna'])->name('daftar-pengguna');

// PENTADBIR - PENGURUSAN PROFIL
Route::get('/pentadbir-pegawai/senarai-klien',[ProfilKlienController::class, 'senaraiKlien'])->middleware('auth')->name('senarai-klien');
Route::get('/pentadbir-pegawai/maklumat-klien/{id}', [ProfilKlienController::class, 'maklumatKlien'])->middleware('auth')->name('maklumat-klien');

// PENTADBIR UPDATE CLIENT'S PROFILE WITHOUT NEED TO APPROVE THE REQUEST
Route::post('/kemaskini/maklumat/peribadi-klien/{id}', [ProfilKlienController::class, 'kemaskiniMaklumatPeribadiKlien'])->middleware('auth')->name('kemaskini.maklumat.peribadi.klien');
Route::post('/kemaskini/maklumat/pekerjaan-klien/{id}', [ProfilKlienController::class, 'kemaskiniMaklumatPekerjaanKlien'])->middleware('auth')->name('kemaskini.maklumat.pekerjaan.klien');
Route::post('/kemaskini/maklumat/waris-klien/{id}', [ProfilKlienController::class, 'kemaskiniMaklumatWarisKlien'])->middleware('auth')->name('kemaskini.maklumat.waris.klien');
Route::post('/kemaskini/maklumat/pasangan-klien/{id}', [ProfilKlienController::class, 'kemaskiniMaklumatPasanganKlien'])->middleware('auth')->name('kemaskini.maklumat.pasangan.klien');
Route::post('/kemaskini/maklumat/rawatan-klien/{id}', [ProfilKlienController::class, 'kemaskiniMaklumatRawatanKlien'])->middleware('auth')->name('kemaskini.maklumat.rawatan.klien');

// PENTADBIR - APPROVE REQUEST TO UPDATE PROFILE
Route::patch('/approve-update/peribadi-klien/{id}', [ProfilKlienController::class, 'approveUpdateKlien'])->name('approve.update.klien');
Route::patch('/approve-update/pekerjaan-klien/{id}', [ProfilKlienController::class, 'approveUpdatePekerjaan'])->name('approve.update.pekerjaan');
Route::patch('/approve-update/waris-klien/{id}', [ProfilKlienController::class, 'approveUpdateWaris'])->name('approve.update.waris');
Route::patch('/approve-update/pasangan-klien/{id}', [ProfilKlienController::class, 'approveUpdatePasangan'])->name('approve.update.pasangan');
Route::patch('/approve-update/rawatan-klien/{id}', [ProfilKlienController::class, 'approveUpdateRawatan'])->name('approve.update.rawatan');

// KLIEN - PENGURUSAN PROFIL
Route::get('/pengurusan/profil-peribadi', [ProfilKlienController::class, 'pengurusanProfil'])->middleware('auth')->name('pengurusan-profil');
Route::get('muat-turun/maklumat-profil-diri', [ProfilKlienController::class, 'muatTurunProfilDiri'])->name('export.profil.diri');

// KLIEN - SEND REQUEST TO UPDATE PROFILE
Route::post('/klien/profil-peribadi/request-update', [ProfilKlienController::class, 'klienRequestUpdate'])->name('klien.requestUpdate');
Route::post('/klien/maklumat-rawatan/request-update', [ProfilKlienController::class, 'rawatanKlienRequestUpdate'])->name('rawatanKlien.requestUpdate');
Route::post('/klien/maklumat-perkerjaan/request-update', [ProfilKlienController::class, 'pekerjaanKlienRequestUpdate'])->name('pekerjaanKlien.requestUpdate');
Route::post('/klien/maklumat-waris/request-update', [ProfilKlienController::class, 'warisKlienRequestUpdate'])->name('warisKlien.requestUpdate');
Route::post('/klien/maklumat-pasangan/request-update', [ProfilKlienController::class, 'pasanganKlienRequestUpdate'])->name('pasanganKlien.requestUpdate');

// KLIEN - MODUL KEPULIHAN
Route::get('/klien/soal-selidik/kepulihan', [ModalKepulihanController::class, 'soalanKepulihanTest'])->middleware('auth')->name('klien.soalanKepulihan.test');
Route::get('/klien/modul-kepulihan/soal-selidik', [ModalKepulihanController::class, 'soalSelidik'])->middleware('auth')->name('klien.soalSelidik');
Route::get('/klien/modul-kepulihan/soalan-demografi', [ModalKepulihanController::class, 'soalanDemografi'])->middleware('auth')->name('klien.soalanDemografi');
Route::post('/klien/autosave/demografi', [ModalKepulihanController::class, 'autosaveResponSoalanDemografi'])->name('klien.autosave.demografi');
Route::post('/simpan/jawapan-demografi', [ModalKepulihanController::class, 'storeResponSoalanDemografi'])->name('klien.submit.demografi');
Route::get('/klien/modul-kepulihan/soalan-kepulihan', [ModalKepulihanController::class, 'soalanKepulihan'])->middleware('auth')->name('klien.soalanKepulihan');
Route::post('/klien/autosave/kepulihan',  [ModalKepulihanController::class, 'autosaveResponSoalanKepulihan'])->name('klien.autosave.kepulihan');
Route::post('/klien/hantar/jawapan/soalan-kepulihan', [ModalKepulihanController::class, 'storeResponSoalanKepulihan'])->name('klien.submit.kepulihan');

// PENTADBIR - MODUL KEPULIHAN
Route::get('/modul-kepulihan/maklum-balas', [ModalKepulihanController::class, 'maklumBalasKepulihan'])->middleware('auth')->name('maklum.balas.kepulihan');

require __DIR__.'/auth.php';
