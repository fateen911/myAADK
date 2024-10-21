<?php

use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\PelaporanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DaftarPenggunaController;
use App\Http\Controllers\ProfilKlienController;
use App\Http\Controllers\PengurusanProgController;
use App\Http\Controllers\ModalKepulihanController;
use App\Http\Controllers\TelegramBotController;
use App\Http\Controllers\PejabatPengawasanController;
use App\Http\Controllers\NotifikasiController;
use Illuminate\Support\Facades\Route;

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', function () {
    return view('landing_page.version_3');
});

// DASHBOARD
Route::get('/dashboard',[HomeController::class, 'index'])->middleware('auth')->name('dashboard');

//TRY
Route::get('/pengurusan-program/tryQR',[PengurusanProgController::class, 'tryQR'])->name('pengurusan_program.tryQR');
Route::get('/pengurusan-program/try',[PengurusanProgController::class, 'try'])->name('pengurusan_program.try');

//LANDING PAGE
Route::get('/landing-page/version-1', [LandingPageController::class, 'landingV1'])->name('landing_page.version_1');
Route::get('/landing-page/version-2', [LandingPageController::class, 'landingV2'])->name('landing_page.version_2');
Route::get('/landing-page/version-3', [LandingPageController::class, 'landingV3'])->name('landing_page.version_3');

// PENGURUSAN PROGRAM - QR CODE
Route::get('/pengurusan-program/qr-code/{id}',[PengurusanProgController::class, 'qrCode'])->name('pengurusan_program.qr_code');
Route::get('/pengurusan_program/share', [PengurusanProgController::class, 'share']);

// PENGURUSAN PROGRAM - PEGAWAI AADK
Route::get('/pengurusan-program/pegawai-aadk/daftar-prog',[PengurusanProgController::class, 'daftarProgPA'])->name('pengurusan_program.pegawai_aadk.daftar_prog');
Route::post('/pengurusan-program/pegawai-aadk/post-daftar-prog',[PengurusanProgController::class, 'postDaftarProgPA'])->name('pengurusan_program.pegawai_aadk.post_daftar_prog');
Route::get('/pengurusan-program/pegawai-aadk/kemaskini-prog/{id}',[PengurusanProgController::class, 'kemaskiniProgPA'])->name('pengurusan_program.pegawai_aadk.kemaskini_prog');
Route::post('/pengurusan-program/pegawai-aadk/post-kemaskini-prog/{id}',[PengurusanProgController::class, 'postKemaskiniProgPA'])->name('pengurusan_program.pegawai_aadk.post_kemaskini_prog');
Route::get('/pengurusan-program/pegawai-aadk/padam-prog/{id}',[PengurusanProgController::class, 'padamProgPA'])->name('pengurusan_program.pegawai_aadk.padam_prog');
Route::get('/pengurusan-program/pegawai-aadk/maklumat-prog/{id}',[PengurusanProgController::class, 'maklumatProgPA'])->name('pengurusan_program.pegawai_aadk.maklumat_prog');
Route::get('/pengurusan-program/pegawai-aadk/senarai-prog',[PengurusanProgController::class, 'senaraiProgPA'])->name('pengurusan_program.pegawai_aadk.senarai_prog');


// PENGURUSAN PROGRAM - PENRADBIR SISTEM
Route::get('/pengurusan-program/pentadbir-sistem/daftar-prog',[PengurusanProgController::class, 'daftarProgPS'])->name('pengurusan_program.pentadbir_sistem.daftar_prog');
Route::post('/pengurusan-program/pentadbir-sistem/post-daftar-prog',[PengurusanProgController::class, 'postDaftarProgPS'])->name('pengurusan_program.pentadbir_sistem.post_daftar_prog');
Route::get('/pengurusan-program/pentadbir-sistem/kemaskini-prog/{id}',[PengurusanProgController::class, 'kemaskiniProgPS'])->name('pengurusan_program.pentadbir_sistem.kemaskini_prog');
Route::post('/pengurusan-program/pentadbir-sistem/post-kemaskini-prog/{id}',[PengurusanProgController::class, 'postKemaskiniProgPS'])->name('pengurusan_program.pentadbir_sistem.post_kemaskini_prog');
Route::get('/pengurusan-program/pentadbir-sistem/padam-prog/{id}',[PengurusanProgController::class, 'padamProgPS'])->name('pengurusan_program.pentadbir_sistem.padam_prog');
Route::get('/pengurusan-program/pentadbir-sistem/maklumat-prog/{id}',[PengurusanProgController::class, 'maklumatProgPS'])->name('pengurusan_program.pentadbir_sistem.maklumat_prog');
Route::get('/pengurusan-program/pentadbir-sistem/senarai-prog',[PengurusanProgController::class, 'senaraiProgPS'])->name('pengurusan_program.pentadbir_sistem.senarai_prog');
Route::get('/pengurusan-program/pentadbir-sistem/tambah-kategori',[PengurusanProgController::class, 'tambahKategoriPS'])->name('pengurusan_program.pentadbir_sistem.tambah_kategori');
Route::post('/pengurusan-program/pentadbir-sistem/post-tambah-kategori',[PengurusanProgController::class, 'postTambahKategoriPS'])->name('pengurusan_program.pentadbir_sistem.post_tambah_kategori');
Route::post('/pengurusan-program/pentadbir-sistem/post-kemaskini-kategori',[PengurusanProgController::class, 'postKemaskiniKategoriPS'])->name('pengurusan_program.pentadbir_sistem.post_kemaskini_kategori');
Route::get('/pengurusan-program/pentadbir-sistem/padam-kategori/{id}',[PengurusanProgController::class, 'padamKategoriPS'])->name('pengurusan_program.pentadbir_sistem.padam_kategori');

// PENGURUSAN PROGRAM - KLIEN
Route::get('/pengurusan-program/klien/daftar-kehadiran/{id}',[PengurusanProgController::class, 'daftarKehadiran'])->name('pengurusan_program.klien.daftar_kehadiran');
Route::post('/pengurusan-program/klien/post-daftar-kehadiran/{id}',[PengurusanProgController::class, 'postDaftarKehadiran'])->name('pengurusan_program.klien.post_daftar_kehadiran');
Route::post('/pengurusan-program/klien/post-daftar-kehadiran-2/{id}',[PengurusanProgController::class, 'postDaftarKehadiran2'])->name('pengurusan_program.klien.post_daftar_kehadiran2');
Route::get('/pengurusan-program/klien/pengesahan-kehadiran/{id}',[PengurusanProgController::class, 'pengesahanKehadiran'])->name('pengurusan_program.klien.pengesahan_kehadiran');
Route::post('/pengurusan-program/klien/post-pengesahan-kehadiran/{id}',[PengurusanProgController::class, 'postPengesahanKehadiran'])->name('pengurusan_program.klien.post_pengesahan_kehadiran');

// PENGURUSAN PROGRAM - HEBAHAN
Route::get('/pengurusan-program/hebahan/papar-hebahan/{id}', [PengurusanProgController::class, 'paparHebahan'])->name('pengurusan_program.papar_hebahan');
Route::get('/pengurusan-program/hebahan/papar-sms/{id}', [PengurusanProgController::class, 'paparSms'])->name('pengurusan_program.papar_sms');
Route::get('/pengurusan-program/hebahan/papar-emel/{id}', [PengurusanProgController::class, 'paparEmel'])->name('pengurusan_program.papar_emel');
Route::get('/pengurusan-program/hebahan/papar-telegram/{id}', [PengurusanProgController::class, 'paparTelegram'])->name('pengurusan_program.papar_telegram');
Route::get('/pengurusan-program/hebahan/filter-hebahan', [PengurusanProgController::class, 'filterHebahan'])->name('pengurusan_program.filter_hebahan');
Route::post('/pengurusan-program/hebahan/jenis-hebahan/{id}', [PengurusanProgController::class, 'jenisHebahan'])->name('pengurusan_program.jenis_hebahan');
Route::post('/pengurusan-program/hebahan/jenis-hebahan-2/{id}', [PengurusanProgController::class, 'jenisHebahan2'])->name('pengurusan_program.jenis_hebahan_2');
Route::post('/pengurusan-program/hebahan/sms/{id}', [PengurusanProgController::class, 'hebahanSMS'])->name('pengurusan_program.hebahan_sms');
Route::post('/pengurusan-program/hebahan/telegram/{id}', [PengurusanProgController::class, 'hebahanTelegram'])->name('pengurusan_program.hebahan_telegram');
Route::post('/pengurusan-program/hebahan/telegram/webhook', [PengurusanProgController::class, 'handleWebhook']);

Route::post('/telegram-webhook', [TelegramBotController::class, 'handle']);

// PENGURUSAN PROGRAM - PDF/EXCEL
Route::get('/pengurusan-program/pdf-pengesahan/{id}',[PengurusanProgController::class, 'pdfPengesahan'])->name('pengurusan_program.pdf_pengesahan');
Route::get('/pengurusan-program/excel-pengesahan/{id}',[PengurusanProgController::class, 'excelPengesahan'])->name('pengurusan_program.excel_pengesahan');
Route::get('/pengurusan-program/pdf-perekodan/{id}',[PengurusanProgController::class, 'pdfPerekodan'])->name('pengurusan_program.pdf_perekodan');
Route::get('/pengurusan-program/excel-perekodan/{id}',[PengurusanProgController::class, 'excelPerekodan'])->name('pengurusan_program.excel_perekodan');

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

// KEMASKINI PROFIL AKAUN PENGGUNA
Route::middleware('auth')->group(function () {
    Route::get('/kemaskini/kata-laluan', [ProfileController::class, 'updatePassword'])->name('update.password');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// PENTADBIR - DAFTAR PENGGUNA
Route::get('/pentadbir/senarai-pengguna',[DaftarPenggunaController::class, 'senaraiPengguna'])->middleware('auth')->name('senarai-pengguna');
Route::post('pentadbir/kemaskini/klien', [DaftarPenggunaController::class, 'pentadbirKemaskiniKlien'])->name('pentadbir-kemaskini-klien');
Route::post('pentadbir/daftar/klien', [DaftarPenggunaController::class, 'pentadbirDaftarKlien'])->name('pentadbir-daftar-klien');
Route::post('pentadbir/kemaskini/pegawai', [DaftarPenggunaController::class, 'kemaskiniPegawai'])->name('kemaskini-pegawai');
Route::post('pentadbir/daftar/pegawai', [DaftarPenggunaController::class, 'daftarPegawai'])->name('daftar-pegawai');
Route::post('/pentadbir/kelulusan/permohonan/pendaftaran-pegawai/{id}', [DaftarPenggunaController::class, 'permohonanPegawaiLulus'])->middleware('auth')->name('kelulusan-permohonan-pegawai');
Route::post('/pentadbir/permohonan/pendaftaran-pegawai/ditolak/{id}', [DaftarPenggunaController::class, 'permohonanPegawaiDitolak'])->middleware('auth')->name('permohonan-pegawai-ditolak');

// AJAX PENDAFTARAN
Route::get('/pentadbir/ajax/senarai-klien', [DaftarPenggunaController::class, 'getDataKlien'])->name('ajax-senarai-klien');
Route::get('/modal/kemaskini-klien/{id}', [DaftarPenggunaController::class, 'modalKemaskiniKlien'])->name('modal-kemaskini-klien');
Route::get('/modal/daftar-klien/{id}', [DaftarPenggunaController::class, 'modalDaftarKlien'])->name('modal-daftar-klien');
Route::get('/pentadbir/ajax/senarai-pegawai', [DaftarPenggunaController::class, 'getDataPegawai'])->name('ajax-senarai-pegawai');
Route::get('/modal/kemaskini-pegawai/{id}', [DaftarPenggunaController::class, 'modalKemaskiniPegawai'])->name('modal-kemaskini-pegawai');
Route::get('/pentadbir/ajax/senarai-permohonan-pegawai', [DaftarPenggunaController::class, 'getDataPermohonanPegawai'])->name('ajax-senarai-permohonan-pegawai');
Route::get('/modal/luluskan-pegawai/{id}', [DaftarPenggunaController::class, 'modalPermohonanPegawai'])->name('modal-luluskan-pegawai');
Route::get('/modal/alasan-ditolak/pegawai/{id}', [DaftarPenggunaController::class, 'modalPermohonanPegawaiDitolak'])->name('modal-permohonan-pegawai-ditolak');

// PEGAWAI DAERAH - DAFTAR or KEMASKINI KLIEN
Route::get('/pegawai-daerah/senarai-daftar/klien',[DaftarPenggunaController::class, 'senaraiDaftarKlien'])->middleware('auth')->name('daftar-klien');
Route::post('/pegawai-daerah/kemaskini/klien', [DaftarPenggunaController::class, 'pegawaiKemaskiniKlien'])->name('pegawai-kemaskini-klien');
Route::post('/pegawai-daerah/daftar/klien', [DaftarPenggunaController::class, 'pegawaiDaftarKlien'])->name('pegawai-daftar-klien');

// PENTADBIR - PENGURUSAN PROFIL KLIEN
Route::get('/pentadbir/senarai-klien',[ProfilKlienController::class, 'senaraiKlien'])->middleware('auth')->name('senarai-klien');
Route::get('/pegawai-brpp/senarai-klien',[ProfilKlienController::class, 'senaraiKlienBrpp'])->middleware('auth')->name('senarai-klien-brpp');
Route::get('/pegawai-negeri/senarai-klien',[ProfilKlienController::class, 'senaraiKlienNegeri'])->middleware('auth')->name('senarai-klien-negeri');
Route::get('/pegawai-daerah/senarai-klien',[ProfilKlienController::class, 'senaraiKlienDaerah'])->middleware('auth')->name('senarai-klien-daerah');
Route::get('/pentadbir-pegawai/maklumat-klien/{id}', [ProfilKlienController::class, 'maklumatKlien'])->middleware('auth')->name('maklumat-klien');

// PENTADBIR - PENGURUSAN PERMOHONAN KEMASKINI PROFIL KLIEN
Route::get('/pentadbir/senarai-permohonan-klien',[ProfilKlienController::class, 'senaraiPermohonanKlien'])->middleware('auth')->name('senarai-permohonan-klien');
Route::get('/pegawai-brpp/senarai-permohonan-klien',[ProfilKlienController::class, 'senaraiPermohonanKlienBrpp'])->middleware('auth')->name('senarai-permohonan-klien-brpp');
Route::get('/pegawai-negeri/senarai-permohonan-klien',[ProfilKlienController::class, 'senaraiPermohonanKlienNegeri'])->middleware('auth')->name('senarai-permohonan-klien-negeri');
Route::get('/pegawai-daerah/senarai-permohonan-klien',[ProfilKlienController::class, 'senaraiPermohonanKlienDaerah'])->middleware('auth')->name('senarai-permohonan-klien-daerah');

// PENTADBIR UPDATE CLIENT'S PROFILE WITHOUT NEED TO APPROVE THE REQUEST
Route::post('/kemaskini/maklumat/peribadi-klien/{id}', [ProfilKlienController::class, 'kemaskiniMaklumatPeribadiKlien'])->middleware('auth')->name('kemaskini.maklumat.peribadi.klien');
Route::post('/kemaskini/maklumat/pekerjaan-klien/{id}', [ProfilKlienController::class, 'kemaskiniMaklumatPekerjaanKlien'])->middleware('auth')->name('kemaskini.maklumat.pekerjaan.klien');
Route::post('/kemaskini/maklumat/pasangan-klien/{id}', [ProfilKlienController::class, 'kemaskiniMaklumatKeluargaKlien'])->middleware('auth')->name('kemaskini.maklumat.pasangan.klien');
Route::post('/kemaskini/maklumat/rawatan-klien/{id}', [ProfilKlienController::class, 'kemaskiniMaklumatRawatanKlien'])->middleware('auth')->name('kemaskini.maklumat.rawatan.klien');
Route::post('/kemaskini/maklumat/bapa-klien/{id}', [ProfilKlienController::class, 'kemaskiniMaklumatBapaKlien'])->middleware('auth')->name('kemaskini.bapa.klien');
Route::post('/kemaskini/maklumat/ibu-klien/{id}', [ProfilKlienController::class, 'kemaskiniMaklumatIbuKlien'])->middleware('auth')->name('kemaskini.ibu.klien');
Route::post('/kemaskini/maklumat/penjaga-klien/{id}', [ProfilKlienController::class, 'kemaskiniMaklumatPenjagaKlien'])->middleware('auth')->name('kemaskini.penjaga.klien');

// PENTADBIR & PEGAWAI - APPROVE REQUEST TO UPDATE PROFILE
Route::patch('/approve-update/peribadi-klien/{id}', [ProfilKlienController::class, 'approveUpdateKlien'])->name('approve.update.klien');
Route::patch('/approve-update/pekerjaan-klien/{id}', [ProfilKlienController::class, 'approveUpdatePekerjaan'])->name('approve.update.pekerjaan');
Route::patch('/approve-update/pasangan-klien/{id}', [ProfilKlienController::class, 'approveUpdateKeluarga'])->name('approve.update.pasangan');
Route::patch('/approve-update/rawatan-klien/{id}', [ProfilKlienController::class, 'approveUpdateRawatan'])->name('approve.update.rawatan');
Route::patch('/approve-update/bapa-klien/{id}', [ProfilKlienController::class, 'approveUpdateBapa'])->name('approve.update.bapa');
Route::patch('/approve-update/ibu-klien/{id}', [ProfilKlienController::class, 'approveUpdateIbu'])->name('approve.update.ibu');
Route::patch('/approve-update/penjaga-klien/{id}', [ProfilKlienController::class, 'approveUpdatePenjaga'])->name('approve.update.penjaga');

// PENTADBIR & PEGAWAI - REJECT REQUEST TO UPDATE PROFILE
Route::post('/tolak-update/peribadi-klien/{id}', [ProfilKlienController::class, 'tolakUpdateKlien'])->name('tolak.update.klien');
Route::post('/tolak-update/pekerjaan-klien/{id}', [ProfilKlienController::class, 'tolakUpdatePekerjaan'])->name('tolak.update.pekerjaan');
Route::post('/tolak-update/pasangan-klien/{id}', [ProfilKlienController::class, 'tolakUpdateKeluarga'])->name('tolak.update.pasangan');
Route::post('/tolak-update/rawatan-klien/{id}', [ProfilKlienController::class, 'tolakUpdateRawatan'])->name('tolak.update.rawatan');
Route::post('/tolak-update/bapa-klien/{id}', [ProfilKlienController::class, 'tolakUpdateBapa'])->name('tolak.update.bapa');
Route::post('/tolak-update/ibu-klien/{id}', [ProfilKlienController::class, 'tolakUpdateIbu'])->name('tolak.update.ibu');
Route::post('/tolak-update/penjaga-klien/{id}', [ProfilKlienController::class, 'tolakUpdatePenjaga'])->name('tolak.update.penjaga');

// KLIEN - PENGURUSAN PROFIL
Route::get('/pengurusan/profil-peribadi', [ProfilKlienController::class, 'pengurusanProfil'])->middleware('auth')->name('pengurusan-profil');
Route::get('muat-turun/PDF/profil-diri', [ProfilKlienController::class, 'muatTurunProfilDiri'])->name('export.profil.diri');
Route::get('muat-turun/PDF/profil-klien/{id}', [ProfilKlienController::class, 'muatTurunProfilKlien'])->name('export.profil.klien');
Route::get('/get-daerah/{id}', [ProfilKlienController::class, 'getDaerah'])->name('getDaerah');

// KLIEN - SEND REQUEST TO UPDATE PROFILE
Route::post('/klien/profil-peribadi/request-update', [ProfilKlienController::class, 'klienRequestUpdate'])->name('klien.requestUpdate');
Route::post('/klien/maklumat-perkerjaan/request-update', [ProfilKlienController::class, 'pekerjaanKlienRequestUpdate'])->name('pekerjaanKlien.requestUpdate');
Route::post('/klien/maklumat-pasangan/request-update', [ProfilKlienController::class, 'keluargaKlienRequestUpdate'])->name('pasanganKlien.requestUpdate');
Route::post('/klien/maklumat-bapa/request-update', [ProfilKlienController::class, 'bapaKlienRequestUpdate'])->name('bapaKlien.requestUpdate');
Route::post('/klien/maklumat-ibu/request-update', [ProfilKlienController::class, 'ibuKlienRequestUpdate'])->name('ibuKlien.requestUpdate');
Route::post('/klien/maklumat-penjaga/request-update', [ProfilKlienController::class, 'penjagaKlienRequestUpdate'])->name('penjagaKlien.requestUpdate');

// KLIEN - MODUL KEPULIHAN
Route::get('/klien/modul-kepulihan/soal-selidik', [ModalKepulihanController::class, 'soalSelidik'])->middleware('auth')->name('klien.soalSelidik');
Route::get('/klien/modul-kepulihan/soalan-demografi', [ModalKepulihanController::class, 'soalanDemografi'])->middleware('auth')->name('klien.soalanDemografi');
Route::post('/klien/autosave/demografi', [ModalKepulihanController::class, 'autosaveResponSoalanDemografi'])->name('klien.autosave.demografi');
Route::post('/simpan/jawapan-demografi', [ModalKepulihanController::class, 'storeResponSoalanDemografi'])->name('klien.submit.demografi');
Route::get('/klien/modul-kepulihan/soalan-kepulihan', [ModalKepulihanController::class, 'soalanKepulihan'])->middleware('auth')->name('klien.soalanKepulihan');
Route::post('/klien/autosave/kepulihan',  [ModalKepulihanController::class, 'autosaveResponSoalanKepulihan'])->name('klien.autosave.kepulihan');
Route::post('/klien/hantar/jawapan/soalan-kepulihan', [ModalKepulihanController::class, 'storeResponSoalanKepulihan'])->name('klien.submit.kepulihan');

// PENTADBIR - MODUL KEPULIHAN
Route::get('/pentadbir/modul-kepulihan/maklum-balas', [ModalKepulihanController::class, 'maklumBalasKepulihan'])->middleware('auth')->name('maklum.balas.kepulihan');
Route::get('/sejarah/modul-kepulihan/klien/{klien_id}', [ModalKepulihanController::class, 'sejarahSoalSelidik'])->name('sejarah.soal.selidik.klien');

// PEGAWAI - MODUL KEPULIHAN
Route::get('/pegawai-brpp/modul-kepulihan/maklum-balas', [ModalKepulihanController::class, 'maklumBalasKepulihanBrpp'])->middleware('auth')->name('maklum.balas.kepulihan.brpp');
Route::get('/pegawai-negeri/modul-kepulihan/maklum-balas', [ModalKepulihanController::class, 'maklumBalasKepulihanNegeri'])->middleware('auth')->name('maklum.balas.kepulihan.negeri');
Route::get('/pegawai-daerah/modul-kepulihan/maklum-balas', [ModalKepulihanController::class, 'maklumBalasKepulihanDaerah'])->middleware('auth')->name('maklum.balas.kepulihan.daerah');

// KLIEN - PERTUKARAN PEJABAT
Route::get('/klien/kemaskini/pejabat-pengawasan', [PejabatPengawasanController::class, 'view'])->middleware('auth')->name('pejabat-pengawasan');
Route::post('/klien/hantar/kemaskini/pejabat-pengawasan', [PejabatPengawasanController::class, 'update'])->name('kemaskini.pejabat-pengawasan');

// PELAPORAN
Route::get('/pelaporan/modal-kepulihan', [PelaporanController::class, 'modalKepulihan'])->name('pelaporan.modal_kepulihan');
Route::get('/pelaporan/aktiviti', [PelaporanController::class, 'aktiviti'])->name('pelaporan.aktiviti');

// KLIEN - NOTIFIKASI
Route::middleware(['auth'])->group(function () {
    Route::get('/notifications', [NotifikasiController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/read/{id}', [NotifikasiController::class, 'markAsRead'])->name('notifications.markRead');
});

require __DIR__.'/auth.php';
