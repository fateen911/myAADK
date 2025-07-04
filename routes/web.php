<?php

use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DaftarPenggunaController;
use App\Http\Controllers\DatabaseTestController;
use App\Http\Controllers\FamiliViewController;
use App\Http\Controllers\KerjaViewController;
use App\Http\Controllers\KlienViewController;
use App\Http\Controllers\ProfilKlienController;
use App\Http\Controllers\PengurusanProgController;
use App\Http\Controllers\ModalKepulihanController;
use App\Http\Controllers\TelegramBotController;
use App\Http\Controllers\PejabatPengawasanController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\PelaporanController;
use App\Http\Controllers\WarisViewController;
use Illuminate\Support\Facades\Route;

// SECOND DB
Route::get('/test-second-db', [DatabaseTestController::class, 'testSecondDb']);
Route::get('/klien-view', [KlienViewController::class, 'viewKlien']);
Route::get('/klien-view-update', [KlienViewController::class, 'viewKlienUpdate']);
Route::get('/kerja-view', [KerjaViewController::class, 'viewKerja']);
Route::get('/famili-view', [FamiliViewController::class, 'viewFamili']);
Route::get('/waris-view', [WarisViewController::class, 'viewWaris']);
Route::get('/klien-view-add', [KlienViewController::class, 'addKlien']);

// LANDING PAGE
Route::get('/', function () {
    return view('landing_page.version_3');
});

// AJAX GET DAERAH 
Route::get('/get-daerah/{id}', action: [ProfilKlienController::class, 'getDaerah'])->name('getDaerah');
Route::get('/get-daerah-bertugas/{negeri_id}', [DaftarPenggunaController::class, 'getDaerahBertugas'])->name('get-daerah-bertugas');

// PENGURUSAN PROGRAM - KLIEN
Route::get('/pengurusan-program/klien/daftar-kehadiran/{id}',[PengurusanProgController::class, 'daftarKehadiran'])->name('pengurusan_program.klien.daftar_kehadiran');
Route::post('/pengurusan-program/klien/post-daftar-kehadiran/{id}',[PengurusanProgController::class, 'postDaftarKehadiran'])->name('pengurusan_program.klien.post_daftar_kehadiran');
Route::get('/pengurusan-program/klien/pengesahan-kehadiran/{id}',[PengurusanProgController::class, 'pengesahanKehadiran'])->name('pengurusan_program.klien.pengesahan_kehadiran');
Route::post('/pengurusan-program/klien/post-pengesahan-kehadiran/{id}',[PengurusanProgController::class, 'postPengesahanKehadiran'])->name('pengurusan_program.klien.post_pengesahan_kehadiran');

// ACCESS CONTROL
// All users
Route::middleware('auth')->group(function () {

    // KEMASKINI PROFIL AKAUN PENGGUNA
    Route::get('/kemaskini/kata-laluan', [ProfileController::class, 'updatePassword'])->name('update.password');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

Route::middleware(['auth', 'prevent-back-history'])->group(function () {
    Route::get('/dashboard',[HomeController::class, 'index'])->name('dashboard');  
});


// Pentadbir Sistem (levels 1)
Route::middleware(['auth', 'level:1'])->group(function () {

    // DAFTAR PENGGUNA
    Route::get('/pentadbir/senarai-pengguna',[DaftarPenggunaController::class, 'senaraiPengguna'])->middleware('auth')->name('senarai-pengguna');
    Route::post('pentadbir/kemaskini/klien', [DaftarPenggunaController::class, 'pentadbirKemaskiniKlien'])->name('pentadbir-kemaskini-klien');
    Route::post('pentadbir/semak-kp', [DaftarPenggunaController::class, 'semakKp'])->name('semak.kp');
    Route::post('pentadbir/daftar/klien', [DaftarPenggunaController::class, 'pentadbirDaftarKlien'])->name('pentadbir-daftar-klien');
    Route::post('pentadbir/kemaskini/pegawai', [DaftarPenggunaController::class, 'kemaskiniPegawai'])->name('kemaskini-pegawai');
    Route::post('pentadbir/daftar/pegawai', [DaftarPenggunaController::class, 'daftarPegawai'])->name('daftar-pegawai');
    Route::post('/pentadbir/kelulusan/permohonan/pendaftaran-pegawai/{id}', [DaftarPenggunaController::class, 'permohonanPegawaiLulus'])->middleware('auth')->name('kelulusan-permohonan-pegawai');
    Route::post('/pentadbir/permohonan/pendaftaran-pegawai/ditolak/{id}', [DaftarPenggunaController::class, 'permohonanPegawaiDitolak'])->middleware('auth')->name('permohonan-pegawai-ditolak');

    Route::get('/pentadbir/ajax/senarai-klien', [DaftarPenggunaController::class, 'getDataKlien'])->name('ajax-senarai-klien');
    Route::get('/modal/daftar-klien/{id}', [DaftarPenggunaController::class, 'modalDaftarKlien'])->name('modal-daftar-klien');
    Route::get('/modal/kemaskini-klien/{id}', [DaftarPenggunaController::class, 'modalKemaskiniKlien'])->name('modal-kemaskini-klien');
    Route::get('/pentadbir/ajax/senarai-pegawai', [DaftarPenggunaController::class, 'getDataPegawai'])->name('ajax-senarai-pegawai');
    Route::get('/modal/kemaskini-pegawai/{id}', [DaftarPenggunaController::class, 'modalKemaskiniPegawai'])->name('modal-kemaskini-pegawai');
    Route::get('/pentadbir/ajax/senarai-permohonan-pegawai', [DaftarPenggunaController::class, 'getDataPermohonanPegawai'])->name('ajax-senarai-permohonan-pegawai');
    Route::get('/modal/luluskan-pegawai/{id}', [DaftarPenggunaController::class, 'modalPermohonanPegawai'])->name('modal-luluskan-pegawai');
    Route::get('/modal/alasan-ditolak/pegawai/{id}', [DaftarPenggunaController::class, 'modalPermohonanPegawaiDitolak'])->name('modal-permohonan-pegawai-ditolak');

    // PENGURUSAN PROFIL KLIEN
    Route::get('/pentadbir/senarai-klien',[ProfilKlienController::class, 'senaraiKlien'])->middleware('auth')->name('senarai-klien');
    Route::get('/pentadbir/senarai-klien/telah-kemaskini/profil',[ProfilKlienController::class, 'klienTelahKemaskiniProfil'])->middleware('auth')->name('telah-kemaskini-profil.1');
    Route::get('/pentadbir/senarai-klien/belum-kemaskini/profil',[ProfilKlienController::class, 'klienBelumKemaskiniProfil'])->middleware('auth')->name('belum-kemaskini-profil.1');

    // PENGURUSAN PERMOHONAN KEMASKINI PROFIL KLIEN
    Route::get('/pentadbir/senarai-permohonan-klien',[ProfilKlienController::class, 'senaraiPermohonanKlien'])->middleware('auth')->name('senarai-permohonan-klien');
    Route::get('/pentadbir/permohonan/belum-selesai',[ProfilKlienController::class, 'permohonanKlienBelumSelesai'])->middleware('auth')->name('permohonan-belum-selesai.1');
    Route::get('/pentadbir/permohonan/selesai',[ProfilKlienController::class, 'permohonanKlienSelesai'])->middleware('auth')->name('permohonan-selesai.1');

    // AJAX MODAL KEPULIHAN
    Route::get('/pentadbir/modul-kepulihan/selesai-menjawab', [ModalKepulihanController::class, 'selesaiMenjawabPB'])->middleware('auth')->name('selesai-menjawab.1');
    Route::get('/pentadbir/modul-kepulihan/belum-selesai-menjawab', [ModalKepulihanController::class, 'belumSelesaiMenjawabPB'])->middleware('auth')->name('belum-selesai-menjawab.1');
    Route::get('/pentadbir-brpp/modul-kepulihan/tidak-menjawab-lebih-6Bulan', [ModalKepulihanController::class, 'tidakMenjawabLebih6BulanPB'])->middleware('auth')->name('tidak-menjawab-lebih-6Bulan.1');
    Route::get('/pentadbir-brpp/modul-kepulihan/tidak-pernah-menjawab', [ModalKepulihanController::class, 'tidakPernahMenjawabPB'])->middleware('auth')->name('tidak-pernah-menjawab.1');

});

// Klien (levels 2)
Route::middleware(['auth', 'level:2'])->group(function () {

    // PENGURUSAN PROFIL
    Route::get('/pengurusan/profil-peribadi', [ProfilKlienController::class, 'pengurusanProfil'])->middleware('auth')->name('pengurusan-profil');
    Route::get('muat-turun/PDF/profil-diri', [ProfilKlienController::class, 'muatTurunProfilDiri'])->name('export.profil.diri');

    // SEND REQUEST TO UPDATE PROFILE
    Route::post('/klien/profil-peribadi/request-update', [ProfilKlienController::class, 'klienRequestUpdate'])->name('klien.requestUpdate');
    Route::post('/klien/maklumat-perkerjaan/request-update', [ProfilKlienController::class, 'pekerjaanKlienRequestUpdate'])->name('pekerjaanKlien.requestUpdate');
    Route::post('/klien/maklumat-pasangan/request-update', [ProfilKlienController::class, 'keluargaKlienRequestUpdate'])->name('pasanganKlien.requestUpdate');
    Route::post('/klien/maklumat-bapa/request-update', [ProfilKlienController::class, 'bapaKlienRequestUpdate'])->name('bapaKlien.requestUpdate');
    Route::post('/klien/maklumat-ibu/request-update', [ProfilKlienController::class, 'ibuKlienRequestUpdate'])->name('ibuKlien.requestUpdate');
    Route::post('/klien/maklumat-penjaga/request-update', [ProfilKlienController::class, 'penjagaKlienRequestUpdate'])->name('penjagaKlien.requestUpdate');

    // MODUL KEPULIHAN
    Route::get('/klien/modul-kepulihan/soal-selidik', [ModalKepulihanController::class, 'soalSelidik'])->middleware('auth')->name('klien.soalSelidik');
    Route::get('/klien/modul-kepulihan/soalan-demografi', [ModalKepulihanController::class, 'soalanDemografi'])->middleware('auth')->name('klien.soalanDemografi');
    Route::post('/klien/autosave/demografi', [ModalKepulihanController::class, 'autosaveResponSoalanDemografi'])->name('klien.autosave.demografi');
    Route::post('/simpan/jawapan-demografi', [ModalKepulihanController::class, 'storeResponSoalanDemografi'])->name('klien.submit.demografi');
    Route::get('/klien/modul-kepulihan/soalan-kepulihan', [ModalKepulihanController::class, 'soalanKepulihan'])->middleware('auth')->name('klien.soalanKepulihan');
    Route::post('/klien/autosave/kepulihan',  [ModalKepulihanController::class, 'autosaveResponSoalanKepulihan'])->name('klien.autosave.kepulihan');
    Route::post('/klien/hantar/jawapan/soalan-kepulihan', [ModalKepulihanController::class, 'storeResponSoalanKepulihan'])->name('klien.submit.kepulihan');

    // PERTUKARAN PEJABAT
    Route::get('/klien/kemaskini/pejabat-pengawasan', [PejabatPengawasanController::class, 'view'])->middleware('auth')->name('pejabat-pengawasan');
    Route::post('/klien/hantar/kemaskini/pejabat-pengawasan', [PejabatPengawasanController::class, 'update'])->name('kemaskini.pejabat-pengawasan');

    // NOTIFIKASI
    Route::get('/notifikasi', [NotifikasiController::class, 'indexKlien'])->name('notifications.index');
    Route::get('/notifikasi/{id}', [NotifikasiController::class, 'markAsReadKlien'])->name('notifications.markRead');
});

// Pegawai BRPP (levels 3)
Route::middleware(['auth', 'level:3'])->group(function () {

    // PENGURUSAN PROFIL KLIEN
    Route::get('/pegawai-brpp/senarai-klien',[ProfilKlienController::class, 'senaraiKlienBrpp'])->middleware('auth')->name('senarai-klien-brpp');
    Route::get('/pegawai-brpp/senarai-klien/telah-kemaskini/profil',[ProfilKlienController::class, 'klienTelahKemaskiniProfilPB'])->middleware('auth')->name('telah-kemaskini-profil.3');
    Route::get('/pegawai-brpp/senarai-klien/belum-kemaskini/profil',[ProfilKlienController::class, 'klienBelumKemaskiniProfilPB'])->middleware('auth')->name('belum-kemaskini-profil.3');

    // PENGURUSAN PERMOHONAN KEMASKINI PROFIL KLIEN
    Route::get('/pegawai-brpp/senarai-permohonan-klien',[ProfilKlienController::class, 'senaraiPermohonanKlienBrpp'])->middleware('auth')->name('senarai-permohonan-klien-brpp');
    Route::get('/pegawai-brpp/permohonan/belum-selesai',[ProfilKlienController::class, 'permohonanKlienBelumSelesaiPB'])->middleware('auth')->name('permohonan-belum-selesai.3');
    Route::get('/pegawai-brpp/permohonan/selesai',[ProfilKlienController::class, 'permohonanKlienSelesaiPB'])->middleware('auth')->name('permohonan-selesai.3');

    // AJAX MODAL KEPULIHAN
    Route::get('/pegawai-brpp/modul-kepulihan/selesai-menjawab', [ModalKepulihanController::class, 'selesaiMenjawabPB'])->name('selesai-menjawab.3');
    Route::get('/pegawai-brpp/modul-kepulihan/belum-selesai-menjawab', [ModalKepulihanController::class, 'belumSelesaiMenjawabPB'])->name('belum-selesai-menjawab.3');
    Route::get('/pegawai-brpp/modul-kepulihan/tidak-menjawab-lebih-6Bulan', [ModalKepulihanController::class, 'tidakMenjawabLebih6BulanPB'])->name('tidak-menjawab-lebih-6Bulan.3');
    Route::get('/pegawai-brpp/modul-kepulihan/tidak-pernah-menjawab', [ModalKepulihanController::class, 'tidakPernahMenjawabPB'])->name('tidak-pernah-menjawab.3');

});

// Pegawai Negeri (levels 4)
Route::middleware(['auth', 'level:4'])->group(function () {

    // PENGURUSAN PROFIL KLIEN
    Route::get('/pegawai-negeri/senarai-klien',[ProfilKlienController::class, 'senaraiKlienNegeri'])->middleware('auth')->name('senarai-klien-negeri');
    Route::get('/pegawai-negeri/senarai-klien/telah-kemaskini/profil',[ProfilKlienController::class, 'klienTelahKemaskiniProfilPN'])->middleware('auth')->name('telah-kemaskini-profil.4');
    Route::get('/pegawai-negeri/senarai-klien/belum-kemaskini/profil',[ProfilKlienController::class, 'klienBelumKemaskiniProfilPN'])->middleware('auth')->name('belum-kemaskini-profil.4');

    // PENGURUSAN PERMOHONAN KEMASKINI PROFIL KLIEN
    Route::get('/pegawai-negeri/senarai-permohonan-klien',[ProfilKlienController::class, 'senaraiPermohonanKlienNegeri'])->middleware('auth')->name('senarai-permohonan-klien-negeri');
    Route::get('/pegawai-negeri/permohonan/belum-selesai',[ProfilKlienController::class, 'permohonanKlienBelumSelesaiPN'])->middleware('auth')->name('permohonan-belum-selesai.4');
    Route::get('/pegawai-negeri/permohonan/selesai',[ProfilKlienController::class, 'permohonanKlienSelesaiPN'])->middleware('auth')->name('permohonan-selesai.4');

    // PELAPORAN - MODAL KEPULIHAN
    Route::get('/pegawai-negeri/pelaporan/modal-kepulihan', [PelaporanController::class, 'modalKepulihanNegeri'])->middleware('auth')->name('pelaporan.modal_kepulihan.negeri');

    // PELAPORAN - MODAL KEPULIHAN - AJAX SELESAI MENJAWAB
    Route::get('/pegawai-negeri/senarai-klien/selesai-menjawab', [PelaporanController::class, 'jsonSelesaiMenjawabPN'])->name('ajax-senarai-selesai-menjawab.negeri');
    Route::get('/pegawai-negeri/pelaporan/excel/selesai-menjawab', [PelaporanController::class, 'MKselesaiMenjawabExcelPN'])->name('pelaporan.selesai-menjawab.excel.negeri');
    Route::get('/pegawai-negeri/pelaporan/pdf/modal-kepulihan/selesai-menjawab', [PelaporanController::class, 'PDFselesaiMenjawabPN'])->name('pelaporan.selesai-menjawab.pdf.negeri');
    Route::get('/pegawai-negeri/pelaporan/pdf/analisis/modal-kepulihan', [PelaporanController::class, 'PDFAnalisisModalKepulihanPN'])->name('pelaporan.analisisMK.pdf.negeri');
    Route::get('/pegawai-negeri/pelaporan/excel/analisis-mk', [PelaporanController::class, 'excelAnalisisModalKepulihanPN'])->name('pelaporan.analisisMK.excel.negeri');

    // PELAPORAN - MODAL KEPULIHAN - AJAX BELUM SELESAI MENJAWAB
    Route::get('/pegawai-negeri/senarai-klien/belum-selesai-menjawab', [PelaporanController::class, 'jsonBelumSelesaiMenjawabPN'])->name('ajax-senarai-belum-selesai-menjawab.negeri');
    Route::get('/pegawai-negeri/pelaporan/excel/belum-selesai-menjawab', [PelaporanController::class, 'MKBelumSelesaiMenjawabExcelPN'])->name('pelaporan.belum-selesai-menjawab.excel.negeri');
    Route::get('/pegawai-negeri/pelaporan/pdf/modal-kepulihan/belum-selesai-menjawab', [PelaporanController::class, 'PDFBelumSelesaiMenjawabPN'])->name('pelaporan.belum-selesai-menjawab.pdf.negeri');

    // PELAPORAN - MODAL KEPULIHAN - AJAX TIDAK MENJAWAB LEBIH 6 BULAN
    Route::get('/pegawai-negeri/senarai-klien/tidak-menjawab-lebih-6Bulan', [PelaporanController::class, 'jsonTidakMenjawabLebih6BulanPN'])->name('ajax-senarai-tidak-menjawab-lebih-6Bulan.negeri');
    Route::get('/pegawai-negeri/pelaporan/excel/tidak-menjawab-lebih-6Bulan', [PelaporanController::class, 'ExcelTidakMenjawabLebih6BulanPN'])->name('pelaporan.tidak-menjawab-lebih-6Bulan.excel.negeri');
    Route::get('/pegawai-negeri/pelaporan/pdf/modal-kepulihan/tidak-menjawab-lebih-6Bulan', [PelaporanController::class, 'PDFtidakMenjawabLebih6BulanPN'])->name('pelaporan.tidak-menjawab-lebih-6Bulan.pdf.negeri');

    // PELAPORAN - MODAL KEPULIHAN - AJAX TIDAK PERNAH MENJAWAB
    Route::get('/pegawai-negeri/senarai-klien/tidak-pernah-menjawab', [PelaporanController::class, 'jsonTidakPernahMenjawabPN'])->name('ajax-senarai-tidak-pernah-menjawab.negeri');
    Route::get('/pegawai-negeri/pelaporan/excel/tidak-pernah-menjawab', [PelaporanController::class, 'ExcelTidakPernahMenjawabPN'])->name('pelaporan.tidak-pernah-menjawab.excel.negeri');
    Route::get('/pegawai-negeri/pelaporan/pdf/modal-kepulihan/tidak-pernah-menjawab', [PelaporanController::class, 'PDFtidakPernahMenjawabPN'])->name('pelaporan.tidak-pernah-menjawab.pdf.negeri');

    // AJAX MODAL KEPULIHAN
    Route::get('/pegawai-negeri/modul-kepulihan/selesai-menjawab', [ModalKepulihanController::class, 'selesaiMenjawabPN'])->name('selesai-menjawab.4');
    Route::get('/pegawai-negeri/modul-kepulihan/belum-selesai-menjawab', [ModalKepulihanController::class, 'belumSelesaiMenjawabPN'])->name('belum-selesai-menjawab.4');
    Route::get('/pegawai-negeri/modul-kepulihan/tidak-menjawab-lebih-6Bulan', [ModalKepulihanController::class, 'tidakMenjawabLebih6BulanPN'])->name('tidak-menjawab-lebih-6Bulan.4');
    Route::get('/pegawai-negeri/modul-kepulihan/tidak-pernah-menjawab', [ModalKepulihanController::class, 'tidakPernahMenjawabPN'])->name('tidak-pernah-menjawab.4');

});

// Pegawai Daerah (levels 5)
Route::middleware(['auth', 'level:5'])->group(function () {

    // DAFTAR atau KEMASKINI KLIEN
    Route::get('/pegawai-daerah/senarai-daftar/klien',[DaftarPenggunaController::class, 'senaraiDaftarKlien'])->middleware('auth')->name('pegawai-daerah.senarai-klien');
    Route::get('/pegawai-daerah/ajax/senarai-klien', [DaftarPenggunaController::class, 'getDataKlienDaerah'])->name('pegawai-daerah-ajax-senarai-klien');
    Route::post('/pegawai-daerah/semak-kp', [DaftarPenggunaController::class, 'semakKpDaerah'])->name('pegawai-daerah.semak.kp');
    Route::get('/modal/pegawai-daerah/daftar-klien/{id}', [DaftarPenggunaController::class, 'modalDaftarKlienDaerah'])->name('modal.pegawai-daerah.daftar-klien');
    Route::post('/pegawai-daerah/daftar/klien', [DaftarPenggunaController::class, 'pegawaiDaftarKlien'])->name('pegawai-daerah.daftar.klien');
    Route::get('/modal/pegawai-daerah/kemaskini-klien/{id}', [DaftarPenggunaController::class, 'modalKemaskiniKlienDaerah'])->name('modal-daerah-kemaskini-klien');
    Route::post('/pegawai-daerah/kemaskini/klien', [DaftarPenggunaController::class, 'pegawaiKemaskiniKlien'])->name('pegawai-kemaskini-klien');

    // PENGURUSAN PROFIL KLIEN
    Route::get('/pegawai-daerah/senarai-klien',[ProfilKlienController::class, 'senaraiKlienDaerah'])->middleware('auth')->name('senarai-klien-daerah');
    Route::get('/pegawai-daerah/senarai-klien/telah-kemaskini/profil',[ProfilKlienController::class, 'klienTelahKemaskiniProfilPD'])->middleware('auth')->name('telah-kemaskini-profil.5');
    Route::get('/pegawai-daerah/senarai-klien/belum-kemaskini/profil',[ProfilKlienController::class, 'klienBelumKemaskiniProfilPD'])->middleware('auth')->name('belum-kemaskini-profil.5');

    // PENGURUSAN PERMOHONAN KEMASKINI PROFIL KLIEN
    Route::get('/pegawai-daerah/senarai-permohonan-klien',[ProfilKlienController::class, 'senaraiPermohonanKlienDaerah'])->middleware('auth')->name('senarai-permohonan-klien-daerah');
    Route::get('/pegawai-daerah/permohonan/belum-selesai',[ProfilKlienController::class, 'permohonanKlienBelumSelesaiPD'])->middleware('auth')->name('permohonan-belum-selesai.5');
    Route::get('/pegawai-daerah/permohonan/selesai',[ProfilKlienController::class, 'permohonanKlienSelesaiPD'])->middleware('auth')->name('permohonan-selesai.5');

    // PELAPORAN - MODAL KEPULIHAN
    Route::get('/pegawai-daerah/pelaporan/modal-kepulihan', [PelaporanController::class, 'modalKepulihanDaerah'])->middleware('auth')->name('pelaporan.modal_kepulihan.daerah');

    // PELAPORAN - MODAL KEPULIHAN - AJAX SELESAI MENJAWAB
    Route::get('/pegawai-daerah/senarai-klien/selesai-menjawab', [PelaporanController::class, 'jsonSelesaiMenjawabPD'])->name('ajax-senarai-selesai-menjawab.daerah');
    Route::get('/pegawai-daerah/pelaporan/excel/selesai-menjawab', [PelaporanController::class, 'MKselesaiMenjawabExcelPD'])->name('pelaporan.selesai-menjawab.excel.daerah');
    Route::get('/pegawai-daerah/pelaporan/pdf/modal-kepulihan/selesai-menjawab', [PelaporanController::class, 'PDFselesaiMenjawabPD'])->name('pelaporan.selesai-menjawab.pdf.daerah');
    Route::get('/pegawai-daerah/pelaporan/pdf/analisis/modal-kepulihan', [PelaporanController::class, 'PDFAnalisisModalKepulihanPD'])->name('pelaporan.analisisMK.pdf.daerah');
    Route::get('/pegawai-daerah/pelaporan/excel/analisis/modal-kepulihan', [PelaporanController::class, 'excelAnalisisModalKepulihanPD'])->name('pelaporan.analisisMK.excel.daerah');

    // PELAPORAN - MODAL KEPULIHAN - AJAX BELUM SELESAI MENJAWAB
    Route::get('/pegawai-daerah/senarai-klien/belum-selesai-menjawab', [PelaporanController::class, 'jsonBelumSelesaiMenjawabPD'])->name('ajax-senarai-belum-selesai-menjawab.daerah');
    Route::get('/pegawai-daerah/pelaporan/excel/belum-selesai-menjawab', [PelaporanController::class, 'MKBelumSelesaiMenjawabExcelPD'])->name('pelaporan.belum-selesai-menjawab.excel.daerah');
    Route::get('/pegawai-daerah/pelaporan/pdf/modal-kepulihan/belum-selesai-menjawab', [PelaporanController::class, 'PDFBelumSelesaiMenjawabPD'])->name('pelaporan.belum-selesai-menjawab.pdf.daerah');

    // PELAPORAN - MODAL KEPULIHAN - AJAX TIDAK MENJAWAB LEBIH 6 BULAN
    Route::get('/pegawai-daerah/senarai-klien/tidak-menjawab-lebih-6Bulan', [PelaporanController::class, 'jsonTidakMenjawabLebih6BulanPD'])->name('ajax-senarai-tidak-menjawab-lebih-6Bulan.daerah');
    Route::get('/pegawai-daerah/pelaporan/excel/tidak-menjawab-lebih-6Bulan', [PelaporanController::class, 'ExcelTidakMenjawabLebih6BulanPD'])->name('pelaporan.tidak-menjawab-lebih-6Bulan.excel.daerah');
    Route::get('/pegawai-daerah/pelaporan/pdf/modal-kepulihan/tidak-menjawab-lebih-6Bulan', [PelaporanController::class, 'PDFtidakMenjawabLebih6BulanPD'])->name('pelaporan.tidak-menjawab-lebih-6Bulan.pdf.daerah');

    // PELAPORAN - MODAL KEPULIHAN - AJAX TIDAK PERNAH MENJAWAB
    Route::get('/pegawai-daerah/senarai-klien/tidak-pernah-menjawab', [PelaporanController::class, 'jsonTidakPernahMenjawabPD'])->name('ajax-senarai-tidak-pernah-menjawab.daerah');
    Route::get('/pegawai-daerah/pelaporan/excel/tidak-pernah-menjawab', [PelaporanController::class, 'ExcelTidakPernahMenjawabPD'])->name('pelaporan.tidak-pernah-menjawab.excel.daerah');
    Route::get('/pegawai-daerah/pelaporan/pdf/modal-kepulihan/tidak-pernah-menjawab', [PelaporanController::class, 'PDFtidakPernahMenjawabPD'])->name('pelaporan.tidak-pernah-menjawab.pdf.daerah');

    // NOTIFIKASI
    Route::get('/pegawai-daerah/notifikasi', [NotifikasiController::class, 'fetchNotificationsPD'])->name('notifications.fetchNotificationsPD');
    Route::get('/pegawai-daerah/notifikasi/{id}/{message}', [NotifikasiController::class, 'markAsReadPD'])->name('notifications.markReadPD');
    Route::get('/pegawai-daerah/senarai-pertukaran-pejabat', [NotifikasiController::class, 'senaraiTukarAADKDaerahPD'])->name('notifications.senaraiTukarDaerahPD');

    // AJAX MODAL KEPULIHAN
    Route::get('/pegawai-daerah/modul-kepulihan/selesai-menjawab', [ModalKepulihanController::class, 'selesaiMenjawabPD'])->name('selesai-menjawab.5');
    Route::get('/pegawai-daerah/modul-kepulihan/belum-selesai-menjawab', [ModalKepulihanController::class, 'belumSelesaiMenjawabPD'])->name('belum-selesai-menjawab.5');
    Route::get('/pegawai-daerah/modul-kepulihan/tidak-menjawab-lebih-6Bulan', [ModalKepulihanController::class, 'tidakMenjawabLebih6BulanPD'])->name('tidak-menjawab-lebih-6Bulan.5');
    Route::get('/pegawai-daerah/modul-kepulihan/tidak-pernah-menjawab', [ModalKepulihanController::class, 'tidakPernahMenjawabPD'])->name('tidak-pernah-menjawab.5');

});

// All except klien (levels 1,3,4,5)
Route::middleware(['auth', 'level:1,3,4,5'])->group(function () {

    // PENGURUSAN PROGRAM - JSON
    Route::get('/klien-semua', [PengurusanProgController::class, 'klienSemua']);
    Route::get('/klien-negeri/{id}', [PengurusanProgController::class, 'klienNegeri']);
    Route::get('/klien-daerah/{id}', [PengurusanProgController::class, 'klienDaerah']);
    Route::get('/kategori', [PengurusanProgController::class, 'kategori']);
    Route::get('/kategori-data/{id}', [PengurusanProgController::class, 'kategoriData']);
    Route::get('/program/{id}', [PengurusanProgController::class, 'program']);
    Route::get('/program-dianjurkan', [PengurusanProgController::class, 'programDianjurkan']);
    Route::get('/pengesahan/{id}', [PengurusanProgController::class, 'pengesahan']);
    Route::get('/perekodan/{id}', [PengurusanProgController::class, 'perekodan']);
    Route::get('/daerah/{id}', [PengurusanProgController::class, 'daerah']);

    // PENGURUSAN PROGRAM - HEBAHAN
    Route::get('/pengurusan-program/hebahan/papar-hebahan/{id}', [PengurusanProgController::class, 'paparHebahan'])->name('pengurusan_program.papar_hebahan');
    Route::get('/pengurusan-program/hebahan/papar-sms/{id}', [PengurusanProgController::class, 'paparSms'])->name('pengurusan_program.papar_sms');
    Route::get('/pengurusan-program/hebahan/papar-emel/{id}', [PengurusanProgController::class, 'paparEmel'])->name('pengurusan_program.papar_emel');
    Route::get('/pengurusan-program/hebahan/papar-telegram/{id}', [PengurusanProgController::class, 'paparTelegram'])->name('pengurusan_program.papar_telegram');
    Route::get('/pengurusan-program/hebahan/filter-hebahan', [PengurusanProgController::class, 'filterHebahan'])->name('pengurusan_program.filter_hebahan');
    Route::post('/pengurusan-program/hebahan/jenis-hebahan/{id}', [PengurusanProgController::class, 'jenisHebahan'])->name('pengurusan_program.jenis_hebahan');
    Route::post('/pengurusan-program/hebahan/jenis-hebahan-2/{id}', [PengurusanProgController::class, 'jenisHebahan2'])->name('pengurusan_program.jenis_hebahan_2');

    // PENGURUSAN PROGRAM - KLIEN
    Route::post('/pengurusan-program/klien/post-daftar-kehadiran-2/{id}',[PengurusanProgController::class, 'postDaftarKehadiran2'])->name('pengurusan_program.klien.post_daftar_kehadiran2');

    // PENGURUSAN PROGRAM - PDF/EXCEL
    Route::get('/pengurusan-program/pdf-pengesahan/{id}',[PengurusanProgController::class, 'pdfPengesahan'])->name('pengurusan_program.pdf_pengesahan');
    Route::get('/pengurusan-program/excel-pengesahan/{id}',[PengurusanProgController::class, 'excelPengesahan'])->name('pengurusan_program.excel_pengesahan');
    Route::get('/pengurusan-program/pdf-perekodan/{id}',[PengurusanProgController::class, 'pdfPerekodan'])->name('pengurusan_program.pdf_perekodan');
    Route::get('/pengurusan-program/excel-perekodan/{id}',[PengurusanProgController::class, 'excelPerekodan'])->name('pengurusan_program.excel_perekodan');
    Route::get('/pengurusan-program/qr-code/{id}',[PengurusanProgController::class, 'qrCode'])->name('pengurusan_program.qr_code');

    // PELAPORAN - AKTIVITI
    Route::get('/pelaporan/aktiviti/excel', [PelaporanController::class, 'excelPelaporanAktiviti'])->name('pelaporan.aktiviti.excel');
    Route::get('/pelaporan/aktiviti/pdf', [PelaporanController::class, 'pdfPelaporanAktiviti'])->name('pelaporan.aktiviti.pdf');
    Route::get('/pelaporan/aktiviti/senarai-kehadiran/{id}', [PelaporanController::class, 'pelaporanKehadiran'])->name('pelaporan.aktiviti.kehadiran');
    Route::get('/pelaporan/program/{id}', [PelaporanController::class, 'pelaporanProgram']);

    // PENGURUSAN PROFIL KLIEN
    Route::get('/pentadbir-pegawai/maklumat-klien/{id}', [ProfilKlienController::class, 'maklumatKlien'])->middleware('auth')->name('maklumat-klien');
    Route::get('muat-turun/PDF/profil-klien/{id}', [ProfilKlienController::class, 'muatTurunProfilKlien'])->name('export.profil.klien');

    // UPDATE CLIENT'S PROFILE WITHOUT NEED TO APPROVE THE REQUEST
    Route::post('/kemaskini/maklumat/peribadi-klien/{id}', [ProfilKlienController::class, 'kemaskiniMaklumatPeribadiKlien'])->middleware('auth')->name('kemaskini.maklumat.peribadi.klien');
    Route::post('/kemaskini/maklumat/pekerjaan-klien/{id}', [ProfilKlienController::class, 'kemaskiniMaklumatPekerjaanKlien'])->middleware('auth')->name('kemaskini.maklumat.pekerjaan.klien');
    Route::post('/kemaskini/maklumat/pasangan-klien/{id}', [ProfilKlienController::class, 'kemaskiniMaklumatKeluargaKlien'])->middleware('auth')->name('kemaskini.maklumat.pasangan.klien');
    Route::post('/kemaskini/maklumat/rawatan-klien/{id}', [ProfilKlienController::class, 'kemaskiniMaklumatRawatanKlien'])->middleware('auth')->name('kemaskini.maklumat.rawatan.klien');
    Route::post('/kemaskini/maklumat/bapa-klien/{id}', [ProfilKlienController::class, 'kemaskiniMaklumatBapaKlien'])->middleware('auth')->name('kemaskini.bapa.klien');
    Route::post('/kemaskini/maklumat/ibu-klien/{id}', [ProfilKlienController::class, 'kemaskiniMaklumatIbuKlien'])->middleware('auth')->name('kemaskini.ibu.klien');
    Route::post('/kemaskini/maklumat/penjaga-klien/{id}', [ProfilKlienController::class, 'kemaskiniMaklumatPenjagaKlien'])->middleware('auth')->name('kemaskini.penjaga.klien');

    // APPROVE REQUEST TO UPDATE PROFILE
    Route::patch('/approve-update/peribadi-klien/{id}', [ProfilKlienController::class, 'approveUpdateKlien'])->name('approve.update.klien');
    Route::patch('/approve-update/pekerjaan-klien/{id}', [ProfilKlienController::class, 'approveUpdatePekerjaan'])->name('approve.update.pekerjaan');
    Route::patch('/approve-update/pasangan-klien/{id}', [ProfilKlienController::class, 'approveUpdateKeluarga'])->name('approve.update.pasangan');
    Route::patch('/approve-update/rawatan-klien/{id}', [ProfilKlienController::class, 'approveUpdateRawatan'])->name('approve.update.rawatan');
    Route::patch('/approve-update/bapa-klien/{id}', [ProfilKlienController::class, 'approveUpdateBapa'])->name('approve.update.bapa');
    Route::patch('/approve-update/ibu-klien/{id}', [ProfilKlienController::class, 'approveUpdateIbu'])->name('approve.update.ibu');
    Route::patch('/approve-update/penjaga-klien/{id}', [ProfilKlienController::class, 'approveUpdatePenjaga'])->name('approve.update.penjaga');

    // REJECT REQUEST TO UPDATE PROFILE
    Route::post('/tolak-update/peribadi-klien/{id}', [ProfilKlienController::class, 'tolakUpdateKlien'])->name('tolak.update.klien');
    Route::post('/tolak-update/pekerjaan-klien/{id}', [ProfilKlienController::class, 'tolakUpdatePekerjaan'])->name('tolak.update.pekerjaan');
    Route::post('/tolak-update/pasangan-klien/{id}', [ProfilKlienController::class, 'tolakUpdateKeluarga'])->name('tolak.update.pasangan');
    Route::post('/tolak-update/rawatan-klien/{id}', [ProfilKlienController::class, 'tolakUpdateRawatan'])->name('tolak.update.rawatan');
    Route::post('/tolak-update/bapa-klien/{id}', [ProfilKlienController::class, 'tolakUpdateBapa'])->name('tolak.update.bapa');
    Route::post('/tolak-update/ibu-klien/{id}', [ProfilKlienController::class, 'tolakUpdateIbu'])->name('tolak.update.ibu');
    Route::post('/tolak-update/penjaga-klien/{id}', [ProfilKlienController::class, 'tolakUpdatePenjaga'])->name('tolak.update.penjaga');

    // MODAL KEPULIHAN
    Route::get('/sejarah/modul-kepulihan/klien/{klien_id}', [ModalKepulihanController::class, 'sejarahSoalSelidik'])->name('sejarah.soal.selidik.klien');
    Route::get('/modul-kepulihan/senarai/maklum-balas', [ModalKepulihanController::class, 'maklumBalasKepulihan'])->middleware('auth')->name('maklum.balas.kepulihan');

});

// Pentadbir Sistem and Pegawai Ibu Pejabat AADK (levels 1 and 3)
Route::middleware(['auth', 'level:1,3'])->group(function () {

    // PENGURUSAN PROGRAM - PENRADBIR SISTEM
    Route::get('/pengurusan-program/pentadbir-sistem/daftar-prog',[PengurusanProgController::class, 'daftarProgPS'])->name('pengurusan_program.pentadbir_sistem.daftar_prog');
    Route::post('/pengurusan-program/pentadbir-sistem/post-daftar-prog',[PengurusanProgController::class, 'postDaftarProgPS'])->name('pengurusan_program.pentadbir_sistem.post_daftar_prog');
    Route::get('/pengurusan-program/pentadbir-sistem/kemaskini-prog/{id}',[PengurusanProgController::class, 'kemaskiniProgPS'])->name('pengurusan_program.pentadbir_sistem.kemaskini_prog');
    Route::post('/pengurusan-program/pentadbir-sistem/post-kemaskini-prog/{id}',[PengurusanProgController::class, 'postKemaskiniProgPS'])->name('pengurusan_program.pentadbir_sistem.post_kemaskini_prog');
    Route::get('/pengurusan-program/pentadbir-sistem/batal-prog/{id}',[PengurusanProgController::class, 'batalProgPS'])->name('pengurusan_program.pentadbir_sistem.batal_prog');
    Route::get('/pengurusan-program/pentadbir-sistem/maklumat-prog/{id}',[PengurusanProgController::class, 'maklumatProgPS'])->name('pengurusan_program.pentadbir_sistem.maklumat_prog');
    Route::get('/pengurusan-program/pentadbir-sistem/senarai-prog',[PengurusanProgController::class, 'senaraiProgPS'])->name('pengurusan_program.pentadbir_sistem.senarai_prog');
    Route::get('/pengurusan-program/pentadbir-sistem/tambah-kategori',[PengurusanProgController::class, 'tambahKategoriPS'])->name('pengurusan_program.pentadbir_sistem.tambah_kategori');
    Route::post('/pengurusan-program/pentadbir-sistem/post-tambah-kategori',[PengurusanProgController::class, 'postTambahKategoriPS'])->name('pengurusan_program.pentadbir_sistem.post_tambah_kategori');
    Route::post('/pengurusan-program/pentadbir-sistem/post-kemaskini-kategori',[PengurusanProgController::class, 'postKemaskiniKategoriPS'])->name('pengurusan_program.pentadbir_sistem.post_kemaskini_kategori');
    Route::get('/pengurusan-program/pentadbir-sistem/padam-kategori/{id}',[PengurusanProgController::class, 'padamKategoriPS'])->name('pengurusan_program.pentadbir_sistem.padam_kategori');

    // PELAPORAN - AKTIVITI - PENTADBIR & BRPP
    Route::get('/pelaporan/aktiviti/analisis', [PelaporanController::class, 'analisis'])->name('pelaporan.aktiviti.analisis');
    Route::get('/pelaporan/aktiviti/aktivitiPB/senarai-aktiviti', [PelaporanController::class, 'senaraiAktivitiPB'])->name('pelaporan.aktiviti.aktivitiPB.senarai_aktiviti');
    Route::post('/pelaporan/aktiviti/aktivitiPB/filter-senarai-aktiviti', [PelaporanController::class, 'filterSenaraiAktivitiPB'])->name('pelaporan.aktiviti.aktivitiPB.filter_senarai_aktiviti');
    Route::get('/pelaporan/aktiviti/aktivitiPB/json-filter-aktiviti/{id}', [PelaporanController::class, 'jsonFilterAktivitiPB'])->name('pelaporan.aktiviti.aktivitiPB.json_fIlter_aktiviti');

    // PELAPORAN - PENTADBIR & BRPP - MODAL KEPULIHAN
    Route::get('/pelaporan/analisis/modal-kepulihan', [PelaporanController::class, 'analisisModalKepulihan'])->name('pelaporan.analisis.modal_kepulihan');
    Route::get('/pelaporan/rekod/modal-kepulihan', [PelaporanController::class, 'rekodModalKepulihan'])->name('pelaporan.rekod.modal_kepulihan');

    // PELAPORAN - PENTADBIR & BRPP - MODAL KEPULIHAN - AJAX SELESAI MENJAWAB
    Route::get('/senarai-klien/selesai-menjawab', [PelaporanController::class, 'jsonSelesaiMenjawabPB'])->name('ajax-senarai-selesai-menjawab');
    Route::get('/pelaporan/excel/selesai-menjawab', [PelaporanController::class, 'MKselesaiMenjawabExcelPB'])->name('pelaporan.selesai-menjawab.excel');
    Route::get('/pelaporan/pdf/modal-kepulihan/selesai-menjawab', [PelaporanController::class, 'PDFselesaiMenjawabPB'])->name('pelaporan.selesai-menjawab.pdf');
    Route::get('/pelaporan/pdf/analisis/modal-kepulihan', [PelaporanController::class, 'PDFAnalisisMK'])->name('pelaporan.analisisMK.pdf');
    Route::get('/pelaporan/excel/analisis-mk', [PelaporanController::class, 'excelAnalisisMK'])->name('pelaporan.analisisMK.excel');

    // PELAPORAN - PENTADBIR & BRPP - MODAL KEPULIHAN - AJAX BELUM SELESAI MENJAWAB
    Route::get('/senarai-klien/belum-selesai-menjawab', [PelaporanController::class, 'jsonBelumSelesaiMenjawabPB'])->name('ajax-senarai-belum-selesai-menjawab');
    Route::get('/pelaporan/excel/belum-selesai-menjawab', [PelaporanController::class, 'MKBelumSelesaiMenjawabExcelPB'])->name('pelaporan.belum-selesai-menjawab.excel');
    Route::get('/pelaporan/pdf/modal-kepulihan/belum-selesai-menjawab', [PelaporanController::class, 'PDFBelumSelesaiMenjawabPB'])->name('pelaporan.belum-selesai-menjawab.pdf');

    // PELAPORAN - PENTADBIR & BRPP - MODAL KEPULIHAN - AJAX TIDAK MENJAWAB LEBIH 6 BULAN
    Route::get('/senarai-klien/tidak-menjawab-lebih-6Bulan', [PelaporanController::class, 'jsonTidakMenjawabLebih6BulanPB'])->name('ajax-senarai-tidak-menjawab-lebih-6Bulan');
    Route::get('/pelaporan/excel/tidak-menjawab-lebih-6Bulan', [PelaporanController::class, 'ExcelTidakMenjawabLebih6BulanPB'])->name('pelaporan.tidak-menjawab-lebih-6Bulan.excel');
    Route::get('/pelaporan/pdf/modal-kepulihan/tidak-menjawab-lebih-6Bulan', [PelaporanController::class, 'PDFtidakMenjawabLebih6BulanPB'])->name('pelaporan.tidak-menjawab-lebih-6Bulan.pdf');

    // PELAPORAN - PENTADBIR & BRPP - MODAL KEPULIHAN - AJAX TIDAK PERNAH MENJAWAB
    Route::get('/senarai-klien/tidak-pernah-menjawab', [PelaporanController::class, 'jsonTidakPernahMenjawabPB'])->name('ajax-senarai-tidak-pernah-menjawab');
    Route::get('/pelaporan/excel/tidak-pernah-menjawab', [PelaporanController::class, 'ExcelTidakPernahMenjawabPB'])->name('pelaporan.tidak-pernah-menjawab.excel');
    Route::get('/pelaporan/pdf/modal-kepulihan/tidak-pernah-menjawab', [PelaporanController::class, 'PDFtidakPernahMenjawabPB'])->name('pelaporan.tidak-pernah-menjawab.pdf');
});

// Pegawai AADK Negeri and Pegawai AADK Daerah (levels 4 and 5)
Route::middleware(['auth', 'level:4,5'])->group(function () {

    // PENGURUSAN PROGRAM - PEGAWAI AADK
    Route::get('/pengurusan-program/pegawai-aadk/daftar-prog',[PengurusanProgController::class, 'daftarProgPA'])->name('pengurusan_program.pegawai_aadk.daftar_prog');
    Route::post('/pengurusan-program/pegawai-aadk/post-daftar-prog',[PengurusanProgController::class, 'postDaftarProgPA'])->name('pengurusan_program.pegawai_aadk.post_daftar_prog');
    Route::get('/pengurusan-program/pegawai-aadk/kemaskini-prog/{id}',[PengurusanProgController::class, 'kemaskiniProgPA'])->name('pengurusan_program.pegawai_aadk.kemaskini_prog');
    Route::post('/pengurusan-program/pegawai-aadk/post-kemaskini-prog/{id}',[PengurusanProgController::class, 'postKemaskiniProgPA'])->name('pengurusan_program.pegawai_aadk.post_kemaskini_prog');
    Route::get('/pengurusan-program/pegawai-aadk/batal-prog/{id}',[PengurusanProgController::class, 'batalProgPA'])->name('pengurusan_program.pegawai_aadk.batal_prog');
    Route::get('/pengurusan-program/pegawai-aadk/maklumat-prog/{id}',[PengurusanProgController::class, 'maklumatProgPA'])->name('pengurusan_program.pegawai_aadk.maklumat_prog');
    Route::get('/pengurusan-program/pegawai-aadk/senarai-prog',[PengurusanProgController::class, 'senaraiProgPA'])->name('pengurusan_program.pegawai_aadk.senarai_prog');

    // PELAPORAN - AKTIVITI - PEGAWAI NEGERI & DAERAH
    Route::get('/pelaporan/aktiviti/aktivitiND/senarai-aktiviti', [PelaporanController::class, 'senaraiAktiviti'])->name('pelaporan.aktiviti.aktivitiND.senarai_aktiviti');
    Route::post('/pelaporan/aktiviti/aktivitiND/filter-senarai-aktiviti', [PelaporanController::class, 'filterSenaraiAktiviti'])->name('pelaporan.aktiviti.aktivitiND.filter_senarai_aktiviti');
    Route::get('/pelaporan/aktiviti/aktivitiND/json-filter-aktiviti/{id}', [PelaporanController::class, 'jsonFilterAktiviti'])->name('pelaporan.aktiviti.aktivitiND.json_fIlter_aktiviti');

});


require __DIR__.'/auth.php';
