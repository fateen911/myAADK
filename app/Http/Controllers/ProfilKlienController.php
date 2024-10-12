<?php

namespace App\Http\Controllers;

use App\Models\BidangPekerjaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use App\Models\User;
use App\Models\Daerah;
use App\Models\KeluargaKlien;
use App\Models\Negeri;
use App\Models\Klien;
use App\Models\PekerjaanKlien;
use App\Models\RawatanKlien;
use App\Models\WarisKlien;
use App\Models\KlienUpdateRequest;
use App\Models\KeluargaKlienUpdateRequest;
use App\Models\NamaMajikan;
use App\Models\NamaPekerjaan;
use App\Models\Pegawai;
use App\Models\PekerjaanKlienUpdateRequest;
use App\Models\Pendapatan;
use App\Models\Pendidikan;
use App\Models\Penyakit;
use App\Models\Notifikasi;
use App\Models\SejarahProfilKlien;
use App\Models\WarisKlienUpdateRequest;
use Illuminate\Support\Facades\Log;

class ProfilKlienController extends Controller
{
    public function getDaerah($idnegeri=0)
    {
        $daerahList['data'] = Daerah::orderby("daerah","asc")
         ->select('id','daerah','negeri_id')
         ->where('negeri_id',$idnegeri)
         ->get();

         return response()->json($daerahList);
    }

    // PENTADBIR
    public function senaraiKlien()
    {
        // Clients who have updated their profile either by client or pegawai
        $sedangKemaskini = Klien::select('klien.*', 'users.name as pengemaskini_name')
                                ->leftJoin('sejarah_profil_klien', function($join) {
                                    $join->on('klien.id', '=', 'sejarah_profil_klien.klien_id')
                                        ->whereRaw('sejarah_profil_klien.id = (SELECT MAX(id) FROM sejarah_profil_klien WHERE klien_id = klien.id)');
                                })
                                ->leftJoin('users', 'sejarah_profil_klien.pengemaskini', '=', 'users.id')
                                ->whereNotNull('sejarah_profil_klien.klien_id')
                                ->get();

        // Clients who have never updated their profile 
        $belumKemaskini = Klien::select('klien.*')
                                ->leftJoin('sejarah_profil_klien', 'klien.id', '=', 'sejarah_profil_klien.klien_id')
                                ->whereNull('sejarah_profil_klien.klien_id')
                                ->get();

        return view('profil_klien.pentadbir_pegawai.senarai', compact('sedangKemaskini', 'belumKemaskini'));
    }

    public function senaraiPermohonanKlien()
    {
        $permohonanBelumSelesai = Klien::leftJoin('klien_update_requests', 'klien.id', '=', 'klien_update_requests.klien_id')
                                        ->leftJoin('pekerjaan_klien_update_requests', 'klien.id', '=', 'pekerjaan_klien_update_requests.klien_id')
                                        ->leftJoin('keluarga_klien_update_requests', 'klien.id', '=', 'keluarga_klien_update_requests.klien_id')
                                        ->leftJoin('waris_klien_update_requests', 'klien.id', '=', 'waris_klien_update_requests.klien_id')
                                        ->select('klien.*') // Fetch all columns of the klien table
                                        ->where(function ($query) {
                                            $query->where('klien_update_requests.status', '=', 'Kemaskini')
                                                ->orWhere('pekerjaan_klien_update_requests.status', '=', 'Kemaskini')
                                                ->orWhere('keluarga_klien_update_requests.status', '=', 'Kemaskini')
                                                ->orWhere('waris_klien_update_requests.status', '=', 'Kemaskini');
                                        })
                                        ->distinct()
                                        ->get(); // Fetch the result as a collection

        // Find clients with status Kemaskini
        $clientsWithKemaskini = Klien::leftJoin('klien_update_requests', 'klien.id', '=', 'klien_update_requests.klien_id')
                                ->leftJoin('pekerjaan_klien_update_requests', 'klien.id', '=', 'pekerjaan_klien_update_requests.klien_id')
                                ->leftJoin('keluarga_klien_update_requests', 'klien.id', '=', 'keluarga_klien_update_requests.klien_id')
                                ->leftJoin('waris_klien_update_requests', 'klien.id', '=', 'waris_klien_update_requests.klien_id')
                                ->where(function ($query) {
                                    $query->where('klien_update_requests.status', 'Kemaskini')
                                        ->orWhere('pekerjaan_klien_update_requests.status', 'Kemaskini')
                                        ->orWhere('keluarga_klien_update_requests.status', 'Kemaskini')
                                        ->orWhere('waris_klien_update_requests.status', 'Kemaskini');
                                })
                                ->distinct()
                                ->pluck('klien.id');

        // Count clients who are not in the above list and meet the criteria for being 'selesai'
        $permohonanSelesai = Klien::join('sejarah_profil_klien', 'klien.id', '=', 'sejarah_profil_klien.klien_id') // Join the 'sejarah_profil_klien' table
                                    ->whereNotIn('klien.id', $clientsWithKemaskini) // Exclude clients with 'Kemaskini'
                                    ->where(function ($query) {
                                        $query->whereIn('klien.id', function ($subQuery) {
                                            $subQuery->select('klien_id')
                                            ->from('klien_update_requests')
                                            ->whereIn('status', ['Lulus', 'Ditolak'])
                                            ->unionAll(
                                                PekerjaanKlienUpdateRequest::select('klien_id')->whereIn('status', ['Lulus', 'Ditolak'])
                                            )
                                            ->unionAll(
                                                KeluargaKlienUpdateRequest::select('klien_id')->whereIn('status', ['Lulus', 'Ditolak'])
                                            )
                                            ->unionAll(
                                                WarisKlienUpdateRequest::select('klien_id')->whereIn('status', ['Lulus', 'Ditolak'])
                                            );
                                        });
                                    })
                                    ->distinct()
                                    ->get();
                                                        
        return view('profil_klien.pentadbir_pegawai.senarai_permohonan', compact('permohonanBelumSelesai', 'permohonanSelesai'));
    }

    // PEGAWAI BRPP
    public function senaraiKlienBrpp()
    {
        // Clients who have updated their profile (sedangKemaskini)
        $sedangKemaskini = Klien::select('klien.*', 'users.name as pengemaskini_name')
                                ->leftJoin('sejarah_profil_klien', function($join) {
                                    $join->on('klien.id', '=', 'sejarah_profil_klien.klien_id')
                                        ->whereRaw('sejarah_profil_klien.id = (SELECT MAX(id) FROM sejarah_profil_klien WHERE klien_id = klien.id)');
                                })
                                ->leftJoin('users', 'sejarah_profil_klien.pengemaskini', '=', 'users.id')
                                ->whereNotNull('sejarah_profil_klien.klien_id')
                                ->get();

        // Clients who have never updated their profile (belumKemaskini)
        $belumKemaskini = Klien::select('klien.*')
                                ->leftJoin('sejarah_profil_klien', 'klien.id', '=', 'sejarah_profil_klien.klien_id')
                                ->whereNull('sejarah_profil_klien.klien_id')
                                ->get();

        return view('profil_klien.pentadbir_pegawai.senarai', compact('sedangKemaskini', 'belumKemaskini'));
    }

    public function senaraiPermohonanKlienBrpp()
    {
        $permohonanBelumSelesai = Klien::leftJoin('klien_update_requests', 'klien.id', '=', 'klien_update_requests.klien_id')
                                        ->leftJoin('pekerjaan_klien_update_requests', 'klien.id', '=', 'pekerjaan_klien_update_requests.klien_id')
                                        ->leftJoin('keluarga_klien_update_requests', 'klien.id', '=', 'keluarga_klien_update_requests.klien_id')
                                        ->leftJoin('waris_klien_update_requests', 'klien.id', '=', 'waris_klien_update_requests.klien_id')
                                        ->select('klien.*') // Fetch all columns of the klien table
                                        ->where(function ($query) {
                                            $query->where('klien_update_requests.status', '=', 'Kemaskini')
                                                ->orWhere('pekerjaan_klien_update_requests.status', '=', 'Kemaskini')
                                                ->orWhere('keluarga_klien_update_requests.status', '=', 'Kemaskini')
                                                ->orWhere('waris_klien_update_requests.status', '=', 'Kemaskini');
                                        })
                                        ->distinct()
                                        ->get(); // Fetch the result as a collection

        // Find clients with status Kemaskini
        $clientsWithKemaskini = Klien::leftJoin('klien_update_requests', 'klien.id', '=', 'klien_update_requests.klien_id')
                                ->leftJoin('pekerjaan_klien_update_requests', 'klien.id', '=', 'pekerjaan_klien_update_requests.klien_id')
                                ->leftJoin('keluarga_klien_update_requests', 'klien.id', '=', 'keluarga_klien_update_requests.klien_id')
                                ->leftJoin('waris_klien_update_requests', 'klien.id', '=', 'waris_klien_update_requests.klien_id')
                                ->where(function ($query) {
                                    $query->where('klien_update_requests.status', 'Kemaskini')
                                        ->orWhere('pekerjaan_klien_update_requests.status', 'Kemaskini')
                                        ->orWhere('keluarga_klien_update_requests.status', 'Kemaskini')
                                        ->orWhere('waris_klien_update_requests.status', 'Kemaskini');
                                })
                                ->distinct()
                                ->pluck('klien.id');

        // Count clients who are not in the above list and meet the criteria for being 'selesai'
        $permohonanSelesai = Klien::join('sejarah_profil_klien', 'klien.id', '=', 'sejarah_profil_klien.klien_id') // Join the 'sejarah_profil_klien' table
                                    ->whereNotIn('klien.id', $clientsWithKemaskini) // Exclude clients with 'Kemaskini'
                                    ->where(function ($query) {
                                        $query->whereIn('klien.id', function ($subQuery) {
                                            $subQuery->select('klien_id')
                                            ->from('klien_update_requests')
                                            ->whereIn('status', ['Lulus', 'Ditolak'])
                                            ->unionAll(
                                                PekerjaanKlienUpdateRequest::select('klien_id')->whereIn('status', ['Lulus', 'Ditolak'])
                                            )
                                            ->unionAll(
                                                KeluargaKlienUpdateRequest::select('klien_id')->whereIn('status', ['Lulus', 'Ditolak'])
                                            )
                                            ->unionAll(
                                                WarisKlienUpdateRequest::select('klien_id')->whereIn('status', ['Lulus', 'Ditolak'])
                                            );
                                        });
                                    })
                                    ->distinct()
                                    ->get();
                            
        return view('profil_klien.pentadbir_pegawai.senarai_permohonan', compact('permohonanBelumSelesai', 'permohonanSelesai'));
    }

    // PEGAWAI NEGERI
    public function senaraiKlienNegeri()
    {
        $pegawai = Auth::user();
        $pegawaiNegeri = Pegawai::where('users_id', $pegawai->id)->first();

        // Clients who have updated their profile (sedangKemaskini)
        $sedangKemaskini = Klien::select('klien.*', 'users.name as pengemaskini_name')
                                ->leftJoin('sejarah_profil_klien', function($join) {
                                    $join->on('klien.id', '=', 'sejarah_profil_klien.klien_id')
                                        ->whereRaw('sejarah_profil_klien.id = (SELECT MAX(id) FROM sejarah_profil_klien WHERE klien_id = klien.id)');
                                })
                                ->leftJoin('users', 'sejarah_profil_klien.pengemaskini', '=', 'users.id')
                                ->whereNotNull('sejarah_profil_klien.klien_id')
                                ->where('klien.negeri_pejabat', $pegawaiNegeri->negeri_bertugas)
                                ->get();

        // Clients who have never updated their profile (belumKemaskini)
        $belumKemaskini = Klien::select('klien.*')
                                ->leftJoin('sejarah_profil_klien', 'klien.id', '=', 'sejarah_profil_klien.klien_id')
                                ->whereNull('sejarah_profil_klien.klien_id')
                                ->where('klien.negeri_pejabat', $pegawaiNegeri->negeri_bertugas)
                                ->get();

        return view('profil_klien.pentadbir_pegawai.senarai', compact('sedangKemaskini', 'belumKemaskini'));
    }

    public function senaraiPermohonanKlienNegeri()
    {
        // Fetch pegawai (user) info for the logged-in user
        $pegawaiNegeri = Pegawai::where('users_id', Auth::user()->id)->first();

        $permohonanBelumSelesai = Klien::join('klien_update_requests', 'klien.id', '=', 'klien_update_requests.klien_id')
                                        ->join('pekerjaan_klien_update_requests', 'klien.id', '=', 'pekerjaan_klien_update_requests.klien_id')
                                        ->join('keluarga_klien_update_requests', 'klien.id', '=', 'keluarga_klien_update_requests.klien_id')
                                        ->join('waris_klien_update_requests', 'klien.id', '=', 'waris_klien_update_requests.klien_id')
                                        ->select('klien.*') // Fetch all columns from the klien table
                                        ->where('klien.negeri_pejabat', $pegawaiNegeri->negeri_bertugas)
                                        ->where(function ($query) {
                                            $query->where('klien_update_requests.status', '=', 'Kemaskini')
                                                ->orWhere('pekerjaan_klien_update_requests.status', '=', 'Kemaskini')
                                                ->orWhere('keluarga_klien_update_requests.status', '=', 'Kemaskini')
                                                ->orWhere('waris_klien_update_requests.status', '=', 'Kemaskini');
                                        })
                                        ->distinct()
                                        ->get(); // Fetch the result as a collection
        
        // Find clients with status Kemaskini
        $clientsWithKemaskini = Klien::leftJoin('klien_update_requests', 'klien.id', '=', 'klien_update_requests.klien_id')
                                ->leftJoin('pekerjaan_klien_update_requests', 'klien.id', '=', 'pekerjaan_klien_update_requests.klien_id')
                                ->leftJoin('keluarga_klien_update_requests', 'klien.id', '=', 'keluarga_klien_update_requests.klien_id')
                                ->leftJoin('waris_klien_update_requests', 'klien.id', '=', 'waris_klien_update_requests.klien_id')
                                ->where('klien.negeri_pejabat', $pegawaiNegeri->negeri_bertugas)
                                ->where(function ($query) {
                                    $query->where('klien_update_requests.status', 'Kemaskini')
                                        ->orWhere('pekerjaan_klien_update_requests.status', 'Kemaskini')
                                        ->orWhere('keluarga_klien_update_requests.status', 'Kemaskini')
                                        ->orWhere('waris_klien_update_requests.status', 'Kemaskini');
                                })
                                ->distinct()
                                ->pluck('klien.id');

        // Count clients who are not in the above list and meet the criteria for being 'selesai'
        $permohonanSelesai = Klien::join('sejarah_profil_klien', 'klien.id', '=', 'sejarah_profil_klien.klien_id') // Join the 'sejarah_profil_klien' table
                                    ->whereNotIn('klien.id', $clientsWithKemaskini) // Exclude clients with 'Kemaskini'
                                    ->where('klien.negeri_pejabat', $pegawaiNegeri->negeri_bertugas)
                                    ->where(function ($query) {
                                        $query->whereIn('klien.id', function ($subQuery) {
                                            $subQuery->select('klien_id')
                                            ->from('klien_update_requests')
                                            ->whereIn('status', ['Lulus', 'Ditolak'])
                                            ->unionAll(
                                                PekerjaanKlienUpdateRequest::select('klien_id')->whereIn('status', ['Lulus', 'Ditolak'])
                                            )
                                            ->unionAll(
                                                KeluargaKlienUpdateRequest::select('klien_id')->whereIn('status', ['Lulus', 'Ditolak'])
                                            )
                                            ->unionAll(
                                                WarisKlienUpdateRequest::select('klien_id')->whereIn('status', ['Lulus', 'Ditolak'])
                                            );
                                        });
                                    })
                                    ->distinct()
                                    ->get();
                            
        return view('profil_klien.pentadbir_pegawai.senarai_permohonan', compact('permohonanBelumSelesai', 'permohonanSelesai'));
    }

    // PEGAWAI DAERAH
    public function senaraiKlienDaerah()
    {
        $pegawai = Auth::user();
        $pegawaiDaerah = Pegawai::where('users_id', $pegawai->id)->first();

        // Clients who have updated their profile (sedangKemaskini)
        $sedangKemaskini = Klien::select('klien.*', 'users.name as pengemaskini_name')
                                ->leftJoin('sejarah_profil_klien', function($join) {
                                    $join->on('klien.id', '=', 'sejarah_profil_klien.klien_id')
                                        ->whereRaw('sejarah_profil_klien.id = (SELECT MAX(id) FROM sejarah_profil_klien WHERE klien_id = klien.id)');
                                })
                                ->leftJoin('users', 'sejarah_profil_klien.pengemaskini', '=', 'users.id')
                                ->whereNotNull('sejarah_profil_klien.klien_id')
                                ->where('klien.negeri_pejabat', $pegawaiDaerah->negeri_bertugas)
                                ->where('klien.daerah_pejabat', $pegawaiDaerah->daerah_bertugas)
                                ->get();

        // Clients who have never updated their profile (belumKemaskini)
        $belumKemaskini = Klien::select('klien.*')
                                ->leftJoin('sejarah_profil_klien', 'klien.id', '=', 'sejarah_profil_klien.klien_id')
                                ->whereNull('sejarah_profil_klien.klien_id')
                                ->where('klien.negeri_pejabat', $pegawaiDaerah->negeri_bertugas)
                                ->where('klien.daerah_pejabat', $pegawaiDaerah->daerah_bertugas)
                                ->get();

        return view('profil_klien.pentadbir_pegawai.senarai', compact('sedangKemaskini', 'belumKemaskini'));
    }

    public function senaraiPermohonanKlienDaerah()
    {
        // Fetch pegawai (user) info for the logged-in user
        $pegawaiDaerah = Pegawai::where('users_id', Auth::user()->id)->first();

        $permohonanBelumSelesai = Klien::leftJoin('klien_update_requests', 'klien.id', '=', 'klien_update_requests.klien_id')
                                        ->leftJoin('pekerjaan_klien_update_requests', 'klien.id', '=', 'pekerjaan_klien_update_requests.klien_id')
                                        ->leftJoin('keluarga_klien_update_requests', 'klien.id', '=', 'keluarga_klien_update_requests.klien_id')
                                        ->leftJoin('waris_klien_update_requests', 'klien.id', '=', 'waris_klien_update_requests.klien_id')
                                        ->select('klien.*') // Fetch all columns from the klien table
                                        ->where('klien.negeri_pejabat', $pegawaiDaerah->negeri_bertugas)
                                        ->where('klien.daerah_pejabat', $pegawaiDaerah->daerah_bertugas)
                                        ->where(function ($query) {
                                            $query->where('klien_update_requests.status', '=', 'Kemaskini')
                                                ->orWhere('pekerjaan_klien_update_requests.status', '=', 'Kemaskini')
                                                ->orWhere('keluarga_klien_update_requests.status', '=', 'Kemaskini')
                                                ->orWhere('waris_klien_update_requests.status', '=', 'Kemaskini');
                                        })
                                        ->distinct()
                                        ->get(); // Fetch the result as a collection
        
        // Find clients with status Kemaskini
        $clientsWithKemaskini = Klien::leftJoin('klien_update_requests', 'klien.id', '=', 'klien_update_requests.klien_id')
                                ->leftJoin('pekerjaan_klien_update_requests', 'klien.id', '=', 'pekerjaan_klien_update_requests.klien_id')
                                ->leftJoin('keluarga_klien_update_requests', 'klien.id', '=', 'keluarga_klien_update_requests.klien_id')
                                ->leftJoin('waris_klien_update_requests', 'klien.id', '=', 'waris_klien_update_requests.klien_id')
                                ->where('klien.negeri_pejabat', $pegawaiDaerah->negeri_bertugas)
                                ->where('klien.daerah_pejabat', $pegawaiDaerah->daerah_bertugas)
                                ->where(function ($query) {
                                    $query->where('klien_update_requests.status', 'Kemaskini')
                                        ->orWhere('pekerjaan_klien_update_requests.status', 'Kemaskini')
                                        ->orWhere('keluarga_klien_update_requests.status', 'Kemaskini')
                                        ->orWhere('waris_klien_update_requests.status', 'Kemaskini');
                                })
                                ->distinct()
                                ->pluck('klien.id');

        // Count clients who are not in the above list and meet the criteria for being 'selesai'
        $permohonanSelesai = Klien::join('sejarah_profil_klien', 'klien.id', '=', 'sejarah_profil_klien.klien_id') // Join the 'sejarah_profil_klien' table
                                    ->whereNotIn('klien.id', $clientsWithKemaskini) // Exclude clients with 'Kemaskini'
                                    ->where('klien.negeri_pejabat', $pegawaiDaerah->negeri_bertugas)
                                    ->where('klien.daerah_pejabat', $pegawaiDaerah->daerah_bertugas)
                                    ->where(function ($query) {
                                        $query->whereIn('klien.id', function ($subQuery) {
                                            $subQuery->select('klien_id')
                                            ->from('klien_update_requests')
                                            ->whereIn('status', ['Lulus', 'Ditolak'])
                                            ->unionAll(
                                                PekerjaanKlienUpdateRequest::select('klien_id')->whereIn('status', ['Lulus', 'Ditolak'])
                                            )
                                            ->unionAll(
                                                KeluargaKlienUpdateRequest::select('klien_id')->whereIn('status', ['Lulus', 'Ditolak'])
                                            )
                                            ->unionAll(
                                                WarisKlienUpdateRequest::select('klien_id')->whereIn('status', ['Lulus', 'Ditolak'])
                                            );
                                        });
                                    })
                                    ->distinct()
                                    ->get();
                            
        return view('profil_klien.pentadbir_pegawai.senarai_permohonan', compact('permohonanBelumSelesai', 'permohonanSelesai'));
    }

    public function muatTurunProfilKlien($id)
    {
        $klien = Klien::where('id',$id)->first();
        $pekerjaan = PekerjaanKlien::where('klien_id',$id)->first();
        $waris = WarisKlien::where('klien_id',$id)->first();
        $pasangan = KeluargaKlien::where('klien_id',$id)->first();
        $rawatan = RawatanKlien::where('klien_id',$id)->first();

        $pdf = PDF::loadView('profil_klien.pentadbir_pegawai.export_profil', compact('klien', 'pekerjaan','waris','pasangan','rawatan'));

        $no_kp = $klien->no_kp;

        return $pdf->stream($no_kp . '-profil-peribadi.pdf');
    }

    public function maklumatKlien($id)
    {
        $negeri = Negeri::all()->sortBy('negeri');
        $daerah = Daerah::all()->sortBy('daerah');
        $negeriKerja = Negeri::all()->sortBy('negeri');
        $daerahKerja = Daerah::all()->sortBy('daerah');
        $negeriWaris = Negeri::all()->sortBy('negeri');
        $daerahWaris = Daerah::all()->sortBy('daerah');
        $negeriPasangan = Negeri::all()->sortBy('negeri');
        $daerahPasangan = Daerah::all()->sortBy('daerah');
        $negeriKerjaPasangan = Negeri::all()->sortBy('negeri');
        $daerahKerjaPasangan = Daerah::all()->sortBy('daerah');
        $tahapPendidikan = Pendidikan::all();
        $pendapatan = Pendapatan::all();
        $penyakit = Penyakit::all();
        $bidangKerja = BidangPekerjaan::all();
        $namaKerja = NamaPekerjaan::all();
        $majikan = NamaMajikan::all();

        // PERIBADI
        $klien = Klien::where('id', $id)->first();
        $requestKlien = KlienUpdateRequest::where('klien_id', $id)->where('status', 'Kemaskini')->first();
        $updateRequestKlien = KlienUpdateRequest::where('klien_id', $id)->first();
        $requestedDataKlien = $updateRequestKlien ? json_decode($updateRequestKlien->requested_data, true) : [];  // Decode the requested data updates                  

        // PEKERJAAN  
        $pekerjaan = PekerjaanKlien::where('klien_id', $id)->first();
        $requestPekerjaan = PekerjaanKlienUpdateRequest::where('klien_id', $id)->where('status', 'Kemaskini')->first();
        $updateRequestPekerjaan = PekerjaanKlienUpdateRequest::where('klien_id', $id)->first();
        $requestedDataPekerjaan = $updateRequestPekerjaan ? json_decode($updateRequestPekerjaan->requested_data, true) : [];

        // WARIS
        $waris = WarisKlien::where('klien_id',$id)->first();
        $requestWaris = WarisKlienUpdateRequest::where('klien_id', $id)->where('status', 'Kemaskini')->first();

        $updateRequestBapa = WarisKlienUpdateRequest::where('klien_id', $id)->where('waris', 1)->first();
        $requestedDataBapa = $updateRequestBapa ? json_decode($updateRequestBapa->requested_data, true) : [];
        $statusBapa = $updateRequestBapa ? $updateRequestBapa->status : null;

        $updateRequestIbu = WarisKlienUpdateRequest::where('klien_id', $id)->where('waris', 2)->first();
        $requestedDataIbu = $updateRequestIbu ? json_decode($updateRequestIbu->requested_data, true) : [];
        $statusIbu = $updateRequestIbu ? $updateRequestIbu->status : null;

        $updateRequestPenjaga = WarisKlienUpdateRequest::where('klien_id', $id)->where('waris', 3)->first();
        $requestedDataPenjaga = $updateRequestPenjaga ? json_decode($updateRequestPenjaga->requested_data, true) : [];
        $statusPenjaga = $updateRequestPenjaga ? $updateRequestPenjaga->status : null;

        // PASANGAN
        $pasangan = KeluargaKlien::where('klien_id',$id)->first();
        $requestPasangan = KeluargaKlienUpdateRequest::where('klien_id', $id)->where('status', 'Kemaskini')->first();
        $updateRequestPasangan = KeluargaKlienUpdateRequest::where('klien_id', $id)->first();
        $requestedDataPasangan = $updateRequestPasangan ? json_decode($updateRequestPasangan->requested_data, true) : [];

        // RAWATAN
        $rawatan = RawatanKlien::where('klien_id',$id)->first();

        return view('profil_klien.pentadbir_pegawai.kemaskini', compact('daerah','negeri','daerahKerja','negeriKerja','negeriWaris','daerahWaris','negeriPasangan','daerahPasangan','negeriKerjaPasangan','daerahKerjaPasangan',
                                                                        'klien', 'requestKlien', 'updateRequestKlien','requestedDataKlien',
                                                                        'pekerjaan','requestPekerjaan', 'updateRequestPekerjaan','requestedDataPekerjaan', 
                                                                        'waris', 'requestWaris', 'updateRequestBapa','requestedDataBapa','statusBapa','updateRequestIbu','requestedDataIbu','statusIbu','updateRequestPenjaga','requestedDataPenjaga','statusPenjaga',
                                                                        'pasangan', 'requestPasangan', 'updateRequestPasangan','requestedDataPasangan',
                                                                        'rawatan','pendapatan','tahapPendidikan','penyakit','bidangKerja','namaKerja','majikan'));
    }

    // PEGAWAI/PENTADBIR : APPROVAL CLIENT'S REQUEST
    public function approveUpdateKlien(Request $request, $id)
    {
        $updateRequest = KlienUpdateRequest::where('klien_id', $id)->first();
        $klien = Klien::where('id', $id)->first();
        $sejarahProfil = SejarahProfilKlien::where('klien_id', $klien->id)->first();

        if ($request->status == 'Lulus') 
        {
            $requestedDataKlien = json_decode($updateRequest->requested_data, true);

            // Update the _klien with the requested data
            $klien->update($requestedDataKlien);

            // Explicitly update the status and updated_at fields
            $updateRequest->update([
                'status' => $request->status,
                'updated_at' => now(),
            ]);

            // Also update the warisKlien status
            $klien->update([
                'status_kemaskini' => $request->status,
                'updated_at' => now(), 
            ]);

            if (!$sejarahProfil) {
                SejarahProfilKlien::create([
                    'klien_id' => $klien->id,
                    'status_kemaskini' => 'Lulus',
                    'bahagian_kemaskini' => 'Klien',
                    'pengemaskini' => Auth::id(),
                    'updated_at' => now(),
                ]);
            }
            else{
                $sejarahProfil->update([
                    'status_kemaskini' => 'Lulus',
                    'bahagian_kemaskini' => 'Klien',
                    'pengemaskini' => Auth::id(),
                    'updated_at' => now(),
                ]);
            }

            // Add notification for approval
            Notifikasi::create([
                'klien_id' => $klien->id,
                'status' => 'Kemaskini Maklumat Peribadi Diluluskan',
                'message' => 'Permohonan kemaskini maklumat peribadi anda telah diluluskan.',
                'is_read' => false,
            ]);

            return redirect()->back()->with('success', 'Permohonan kemaskini maklumat peribadi klien telah berjaya diluluskan.');
        } 
    }

    public function tolakUpdateKlien(Request $request, $id)
    {
        $updateRequest = KlienUpdateRequest::where('klien_id', $id)->first();
        $klien = Klien::where('id', $id)->first();
        $sejarahProfil = SejarahProfilKlien::where('klien_id', $klien->id)->first();

        // Split the input by commas and trim any spaces
        $alasanDitolak = explode(',', $request->input('alasan_ditolak'));
        $alasanDitolak = array_map('trim', $alasanDitolak); // Trim spaces from each reason

        // Encode the alasan_ditolak array as JSON before saving
        $updateRequest->alasan_ditolak = json_encode($alasanDitolak);

        // Explicitly update the status and updated_at fields
        $updateRequest->update([
            'status' => $request->status,
            'updated_at' => now(),
        ]);

        // Also update the warisKlien status
        $klien->update([
            'status_kemaskini' => $request->status,
            'updated_at' => now(), 
        ]);

        if (!$sejarahProfil) {
            SejarahProfilKlien::create([
                'klien_id' => $klien->id,
                'status_kemaskini' => 'Ditolak',
                'bahagian_kemaskini' => 'Klien',
                'pengemaskini' => Auth::id(),
                'updated_at' => now(),
            ]);
        }
        else{
            $sejarahProfil->update([
                'status_kemaskini' => 'Ditolak',
                'bahagian_kemaskini' => 'Klien',
                'pengemaskini' => Auth::id(),
                'updated_at' => now(),
            ]);
        }

        // Add notification for rejection
        Notifikasi::create([
            'klien_id' => $klien->id,
            'status' => 'Kemaskini Maklumat Peribadi Ditolak',
            'message' => 'Permohonan kemaskini maklumat peribadi anda telah ditolak. Alasan: ' . implode(', ', $alasanDitolak),
            'is_read' => false,
        ]);

        return redirect()->back()->with('errorPermohonan', 'Permohonan kemaskini maklumat peribadi klien ditolak.');
    }

    public function approveUpdatePekerjaan(Request $request, $id)
    {
        $updateRequestPekerjaan = PekerjaanKlienUpdateRequest::where('klien_id', $id)->first();
        $pekerjaanKlien = PekerjaanKlien::where('klien_id', $id)->first();
        $sejarahProfil = SejarahProfilKlien::where('klien_id', $pekerjaanKlien->klien_id)->first();

        if ($request->status == 'Lulus') 
        {
            $requestedData = json_decode($updateRequestPekerjaan->requested_data, true);

            // Update the pekerjaan_klien with the requested data
            $pekerjaanKlien->update($requestedData);

            // Explicitly update the status and updated_at fields
            $updateRequestPekerjaan->update([
                'status' => $request->status,
                'updated_at' => now(),
            ]);

            // Also update the warisKlien status
            $pekerjaanKlien->update([
                'status_kemaskini' => $request->status,
                'updated_at' => now(), 
            ]);
            
            if (!$sejarahProfil) {
                SejarahProfilKlien::create([
                    'klien_id' => $pekerjaanKlien->klien_id,
                    'status_kemaskini' => 'Lulus',
                    'bahagian_kemaskini' => 'Pekerjaan',
                    'pengemaskini' => Auth::id(),
                    'updated_at' => now(),
                ]);
            }
            else{
                $sejarahProfil->update([
                    'status_kemaskini' => 'Lulus',
                    'bahagian_kemaskini' => 'Pekerjaan',
                    'pengemaskini' => Auth::id(),
                    'updated_at' => now(),
                ]);
            }

            // Add notification for approval
            Notifikasi::create([
                'klien_id' => $pekerjaanKlien->klien_id,
                'status' => 'Kemaskini Maklumat Pekerjaan Diluluskan',
                'message' => 'Permohonan kemaskini maklumat pekerjaan anda telah diluluskan.',
                'is_read' => false,
            ]);

            return redirect()->back()->with('success', 'Permohonan kemaskini maklumat pekerjaan klien telah berjaya diluluskan.');
        }  
    }

    public function tolakUpdatePekerjaan(Request $request, $id)
    {
        $updateRequestPekerjaan = PekerjaanKlienUpdateRequest::where('klien_id', $id)->first();
        $pekerjaanKlien = PekerjaanKlien::where('klien_id', $id)->first();
        $sejarahProfil = SejarahProfilKlien::where('klien_id', $pekerjaanKlien->klien_id)->first();

        // Split the input by commas and trim any spaces
        $alasanDitolak = explode(',', $request->input('alasan_ditolak'));
        $alasanDitolak = array_map('trim', $alasanDitolak); // Trim spaces from each reason

        // Encode the alasan_ditolak array as JSON before saving
        $updateRequestPekerjaan->alasan_ditolak = json_encode($alasanDitolak);

        // Explicitly update the status and updated_at fields
        $updateRequestPekerjaan->update([
            'status' => $request->status,
            'updated_at' => now(),
        ]);

        // Also update the warisKlien status
        $pekerjaanKlien->update([
            'status_kemaskini' => $request->status,
            'updated_at' => now(), 
        ]);

        if (!$sejarahProfil) {
            SejarahProfilKlien::create([
                'klien_id' => $pekerjaanKlien->klien_id,
                'status_kemaskini' => 'Ditolak',
                'bahagian_kemaskini' => 'Pekerjaan',
                'pengemaskini' => Auth::id(),
                'updated_at' => now(),
            ]);
        }
        else{
            $sejarahProfil->update([
                'status_kemaskini' => 'Ditolak',
                'bahagian_kemaskini' => 'Pekerjaan',
                'pengemaskini' => Auth::id(),
                'updated_at' => now(),
            ]);
        }

        // Add notification for rejection
        Notifikasi::create([
            'klien_id' => $pekerjaanKlien->klien_id,
            'status' => 'Kemaskini Maklumat Pekerjaan Ditolak',
            'message' => 'Permohonan kemaskini maklumat pekerjaan anda telah ditolak. Alasan: ' . implode(', ', $alasanDitolak),
            'is_read' => false,
        ]);

        return redirect()->back()->with('errorPermohonan', 'Permohonan kemaskini maklumat pekerjaan klien ditolak.');
    }

    public function approveUpdateKeluarga(Request $request, $id)
    {
        $updateRequestPasangan = KeluargaKlienUpdateRequest::where('klien_id', $id)->first();
        $pasanganKlien = KeluargaKlien::where('klien_id', $id)->first();
        $sejarahProfil = SejarahProfilKlien::where('klien_id', $pasanganKlien->klien_id)->first();

        if ($request->status == 'Lulus') 
        {
            $requestedDataPasangan = json_decode($updateRequestPasangan->requested_data, true);

            // Update the keluarga_klien with the requested data
            $pasanganKlien->update($requestedDataPasangan);

            // Explicitly update the status and updated_at fields
            $updateRequestPasangan->update([
                'status' => $request->status,
                'updated_at' => now(),
            ]);

            // Also update the warisKlien status
            $pasanganKlien->update([
                'status_kemaskini' => $request->status,
                'updated_at' => now(), 
            ]);

            if (!$sejarahProfil) {
                SejarahProfilKlien::create([
                    'klien_id' => $pasanganKlien->klien_id,
                    'status_kemaskini' => 'Lulus',
                    'bahagian_kemaskini' => 'Keluarga',
                    'pengemaskini' => Auth::id(),
                    'updated_at' => now(),
                ]);
            }
            else{
                $sejarahProfil->update([
                    'status_kemaskini' => 'Lulus',
                    'bahagian_kemaskini' => 'Keluarga',
                    'pengemaskini' => Auth::id(),
                    'updated_at' => now(),
                ]);
            }

            // Add notification for approval
            Notifikasi::create([
                'klien_id' => $pasanganKlien->klien_id,
                'status' => 'Kemaskini Maklumat Keluarga Diluluskan',
                'message' => 'Permohonan kemaskini maklumat keluarga anda telah diluluskan.',
                'is_read' => false,
            ]);

            return redirect()->back()->with('success', 'Permohonan kemaskini maklumat keluarga klien telah berjaya diluluskan.');
        }  
    }

    public function tolakUpdateKeluarga(Request $request, $id)
    {
        $updateRequestPasangan = KeluargaKlienUpdateRequest::where('klien_id', $id)->first();
        $pasanganKlien = KeluargaKlien::where('klien_id', $id)->first();
        $sejarahProfil = SejarahProfilKlien::where('klien_id', $pasanganKlien->klien_id)->first();

        // Split the input by commas and trim any spaces
        $alasanDitolak = explode(',', $request->input('alasan_ditolak'));
        $alasanDitolak = array_map('trim', $alasanDitolak); // Trim spaces from each reason

        // Encode the alasan_ditolak array as JSON before saving
        $updateRequestPasangan->alasan_ditolak = json_encode($alasanDitolak);

        // Explicitly update the status and updated_at fields
        $updateRequestPasangan->update([
            'status' => $request->status,
            'updated_at' => now(),
        ]);

        // Also update the warisKlien status
        $pasanganKlien->update([
            'status_kemaskini' => $request->status,
            'updated_at' => now(), 
        ]);

        if (!$sejarahProfil) {
            SejarahProfilKlien::create([
                'klien_id' => $pasanganKlien->klien_id,
                'status_kemaskini' => 'Ditolak',
                'bahagian_kemaskini' => 'Keluarga',
                'pengemaskini' => Auth::id(),
                'updated_at' => now(),
            ]);
        }
        else{
            $sejarahProfil->update([
                'status_kemaskini' => 'Ditolak',
                'bahagian_kemaskini' => 'Keluarga',
                'pengemaskini' => Auth::id(),
                'updated_at' => now(),
            ]);
        }

        // Add notification for rejection
        Notifikasi::create([
            'klien_id' => $pasanganKlien->klien_id,
            'status' => 'Kemaskini Maklumat Keluarga Ditolak',
            'message' => 'Permohonan kemaskini maklumat keluarga anda telah ditolak. Alasan: ' . implode(', ', $alasanDitolak),
            'is_read' => false,
        ]);

        return redirect()->back()->with('errorPermohonan', 'Permohonan kemaskini maklumat keluarga klien ditolak.');
    }

    public function approveUpdateBapa(Request $request, $id)
    {
        $updateRequestBapa = WarisKlienUpdateRequest::where('klien_id', $id)->where('waris', 1)->first();
        $warisKlien = WarisKlien::where('klien_id', $id)->first();
        $sejarahProfil = SejarahProfilKlien::where('klien_id', $warisKlien->klien_id)->first();

        if ($request->status == 'Lulus') 
        {
            $requestedDataWaris = json_decode($updateRequestBapa->requested_data, true);

            // Update the Waris_klien with the requested data
            $warisKlien->update($requestedDataWaris);

            // Explicitly update the status and updated_at fields
            $updateRequestBapa->update([
                'status' => $request->status,
                'updated_at' => now(),
            ]);

            // Also update the warisKlien status
            $warisKlien->update([
                'status_kemaskini' => $request->status,
                'updated_at' => now(), 
            ]);

            if (!$sejarahProfil) {
                SejarahProfilKlien::create([
                    'klien_id' => $warisKlien->klien_id,
                    'status_kemaskini' => 'Lulus',
                    'bahagian_kemaskini' => 'Waris',
                    'pengemaskini' => Auth::id(),
                    'updated_at' => now(),
                ]);
            }
            else{
                $sejarahProfil->update([
                    'status_kemaskini' => 'Lulus',
                    'bahagian_kemaskini' => 'Waris',
                    'pengemaskini' => Auth::id(),
                    'updated_at' => now(),
                ]);
            }

            // Add notification for approval
            Notifikasi::create([
                'klien_id' => $warisKlien->klien_id,
                'status' => 'Kemaskini Maklumat Bapa Diluluskan',
                'message' => 'Permohonan kemaskini maklumat bapa anda telah diluluskan.',
                'is_read' => false,
            ]);

            return redirect()->back()->with('success', 'Permohonan kemaskini maklumat bapa klien telah berjaya diluluskan.');
        }  
    }

    public function tolakUpdateBapa(Request $request, $id)
    {
        $updateRequestBapa = WarisKlienUpdateRequest::where('klien_id', $id)->where('waris', 1)->first();
        $warisKlien = WarisKlien::where('klien_id', $id)->first();
        $sejarahProfil = SejarahProfilKlien::where('klien_id', $warisKlien->klien_id)->first();
        
        // Split the input by commas and trim any spaces
        $alasanDitolak = explode(',', $request->input('alasan_ditolak'));
        $alasanDitolak = array_map('trim', $alasanDitolak); // Trim spaces from each reason

        // Encode the alasan_ditolak array as JSON before saving
        $updateRequestBapa->alasan_ditolak = json_encode($alasanDitolak);

        // Explicitly update the status and updated_at fields
        $updateRequestBapa->update([
            'status' => $request->status,
            'updated_at' => now(),
        ]);

        // Also update the warisKlien status
        $warisKlien->update([
            'status_kemaskini' => $request->status,
            'updated_at' => now(), 
        ]);

        if (!$sejarahProfil) {
            SejarahProfilKlien::create([
                'klien_id' => $warisKlien->klien_id,
                'status_kemaskini' => 'Ditolak',
                'bahagian_kemaskini' => 'Waris',
                'pengemaskini' => Auth::id(),
                'updated_at' => now(),
            ]);
        }
        else{
            $sejarahProfil->update([
                'status_kemaskini' => 'Ditolak',
                'bahagian_kemaskini' => 'Waris',
                'pengemaskini' => Auth::id(),
                'updated_at' => now(),
            ]);
        }

        // Add notification for rejection
        Notifikasi::create([
            'klien_id' => $warisKlien->klien_id,
            'status' => 'Kemaskini Maklumat Bapa Ditolak',
            'message' => 'Permohonan kemaskini maklumat bapa anda telah ditolak. Alasan: ' . implode(', ', $alasanDitolak),
            'is_read' => false,
        ]);

        return redirect()->back()->with('errorPermohonan', 'Permohonan kemaskini maklumat bapa klien ditolak.');       
    }

    public function approveUpdateIbu(Request $request, $id)
    {
        $updateRequestIbu = WarisKlienUpdateRequest::where('klien_id', $id)->where('waris', 2)->first();
        $warisKlien = WarisKlien::where('klien_id', $id)->first();
        $sejarahProfil = SejarahProfilKlien::where('klien_id', $warisKlien->klien_id)->first();

        if ($request->status == 'Lulus') 
        {
            $requestedDataWaris = json_decode($updateRequestIbu->requested_data, true);

            // Update the Waris_klien with the requested data
            $warisKlien->update($requestedDataWaris);

            // Explicitly update the status and updated_at fields
            $updateRequestIbu->update([
                'status' => $request->status,
                'updated_at' => now(),
            ]);

            // Also update the warisKlien status
            $warisKlien->update([
                'status_kemaskini' => $request->status,
                'updated_at' => now(), 
            ]);

            if (!$sejarahProfil) {
                SejarahProfilKlien::create([
                    'klien_id' => $warisKlien->klien_id,
                    'status_kemaskini' => 'Lulus',
                    'bahagian_kemaskini' => 'Waris',
                    'pengemaskini' => Auth::id(),
                    'updated_at' => now(),
                ]);
            }
            else{
                $sejarahProfil->update([
                    'status_kemaskini' => 'Lulus',
                    'bahagian_kemaskini' => 'Waris',
                    'pengemaskini' => Auth::id(),
                    'updated_at' => now(),
                ]);
            }

            // Add notification for approval
            Notifikasi::create([
                'klien_id' => $warisKlien->klien_id,
                'status' => 'Kemaskini Maklumat Ibu Diluluskan',
                'message' => 'Permohonan kemaskini maklumat ibu anda telah diluluskan.',
                'is_read' => false,
            ]);

            return redirect()->back()->with('success', 'Permohonan kemaskini maklumat ibu klien telah berjaya diluluskan.');
        }   
    }

    public function tolakUpdateIbu(Request $request, $id)
    {
        $updateRequestIbu = WarisKlienUpdateRequest::where('klien_id', $id)->where('waris', 2)->first();
        $warisKlien = WarisKlien::where('klien_id', $id)->first();
        $sejarahProfil = SejarahProfilKlien::where('klien_id', $warisKlien->klien_id)->first();

        // Split the input by commas and trim any spaces
        $alasanDitolak = explode(',', $request->input('alasan_ditolak'));
        $alasanDitolak = array_map('trim', $alasanDitolak); // Trim spaces from each reason

        // Encode the alasan_ditolak array as JSON before saving
        $updateRequestIbu->alasan_ditolak = json_encode($alasanDitolak);

        // Explicitly update the status and updated_at fields
        $updateRequestIbu->update([
            'status' => $request->status,
            'updated_at' => now(),
        ]);

        // Also update the warisKlien status
        $warisKlien->update([
            'status_kemaskini' => $request->status,
            'updated_at' => now(), 
        ]);

        if (!$sejarahProfil) {
            SejarahProfilKlien::create([
                'klien_id' => $warisKlien->klien_id,
                'status_kemaskini' => 'Ditolak',
                'bahagian_kemaskini' => 'Waris',
                'pengemaskini' => Auth::id(),
                'updated_at' => now(),
            ]);
        }
        else{
            $sejarahProfil->update([
                'status_kemaskini' => 'Ditolak',
                'bahagian_kemaskini' => 'Waris',
                'pengemaskini' => Auth::id(),
                'updated_at' => now(),
            ]);
        }

        // Add notification for rejection
        Notifikasi::create([
            'klien_id' => $warisKlien->klien_id,
            'status' => 'Kemaskini Maklumat Ibu Ditolak',
            'message' => 'Permohonan kemaskini maklumat ibu anda telah ditolak. Alasan: ' . implode(', ', $alasanDitolak),
            'is_read' => false,
        ]);

        return redirect()->back()->with('errorPermohonan', 'Permohonan kemaskini maklumat ibu klien ditolak.');
    }

    public function approveUpdatePenjaga(Request $request, $id)
    {
        $updateRequestPenjaga = WarisKlienUpdateRequest::where('klien_id', $id)->where('waris', 3)->first();
        $warisKlien = WarisKlien::where('klien_id', $id)->first();
        $sejarahProfil = SejarahProfilKlien::where('klien_id', $warisKlien->klien_id)->first();

        if ($request->status == 'Lulus') 
        {
            $requestedDataWaris = json_decode($updateRequestPenjaga->requested_data, true);

            // Update the Waris_klien with the requested data
            $warisKlien->update($requestedDataWaris);

            // Explicitly update the status and updated_at fields
            $updateRequestPenjaga->update([
                'status' => $request->status,
                'updated_at' => now(),
            ]);

            // Also update the warisKlien status
            $warisKlien->update([
                'status_kemaskini' => $request->status,
                'updated_at' => now(), 
            ]);

            if (!$sejarahProfil) {
                SejarahProfilKlien::create([
                    'klien_id' => $warisKlien->klien_id,
                    'status_kemaskini' => 'Lulus',
                    'bahagian_kemaskini' => 'Waris',
                    'pengemaskini' => Auth::id(),
                    'updated_at' => now(),
                ]);
            }
            else{
                $sejarahProfil->update([
                    'status_kemaskini' => 'Lulus',
                    'bahagian_kemaskini' => 'Waris',
                    'pengemaskini' => Auth::id(),
                    'updated_at' => now(),
                ]);
            }

            // Add notification for approval
            Notifikasi::create([
                'klien_id' => $warisKlien->klien_id,
                'status' => 'Kemaskini Maklumat Penjaga Diluluskan',
                'message' => 'Permohonan kemaskini maklumat penjaga anda telah diluluskan.',
                'is_read' => false,
            ]);

            return redirect()->back()->with('success', 'Permohonan kemaskini maklumat penjaga klien telah berjaya diluluskan.');
        } 
    }

    public function tolakUpdatePenjaga(Request $request, $id)
    {
        $updateRequestPenjaga = WarisKlienUpdateRequest::where('klien_id', $id)->where('waris', 3)->first();
        $warisKlien = WarisKlien::where('klien_id', $id)->first();
        $sejarahProfil = SejarahProfilKlien::where('klien_id', $warisKlien->klien_id)->first();

        // Split the input by commas and trim any spaces
        $alasanDitolak = explode(',', $request->input('alasan_ditolak'));
        $alasanDitolak = array_map('trim', $alasanDitolak); // Trim spaces from each reason

        // Encode the alasan_ditolak array as JSON before saving
        $updateRequestPenjaga->alasan_ditolak = json_encode($alasanDitolak);
        
        // Explicitly update the status and updated_at fields
        $updateRequestPenjaga->update([
            'status' => $request->status,
            'updated_at' => now(),
        ]);

        // Also update the warisKlien status
        $warisKlien->update([
            'status_kemaskini' => $request->status,
            'updated_at' => now(), 
        ]);

        if (!$sejarahProfil) {
            SejarahProfilKlien::create([
                'klien_id' => $warisKlien->klien_id,
                'status_kemaskini' => 'Ditolak',
                'bahagian_kemaskini' => 'Waris',
                'pengemaskini' => Auth::id(),
                'updated_at' => now(),
            ]);
        }
        else{
            $sejarahProfil->update([
                'status_kemaskini' => 'Ditolak',
                'bahagian_kemaskini' => 'Waris',
                'pengemaskini' => Auth::id(),
                'updated_at' => now(),
            ]);
        }

        // Add notification for rejection
        Notifikasi::create([
            'klien_id' => $warisKlien->klien_id,
            'status' => 'Kemaskini Maklumat Penjaga Ditolak',
            'message' => 'Permohonan kemaskini maklumat penjaga anda telah ditolak. Alasan: ' . implode(', ', $alasanDitolak),
            'is_read' => false,
        ]);

        return redirect()->back()->with('errorPermohonan', 'Permohonan kemaskini maklumat penjaga klien ditolak.');
    }


    // PENTADBIR/PEGAWAI : UPDATE WITHOUT REQUEST
    public function kemaskiniMaklumatPeribadiKlien(Request $request, $id)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'no_tel'                    => 'nullable|string|max:11',
                'emel'                      => 'nullable|email',
                'alamat_rumah_klien'        => 'required|string|max:255',
                'poskod_klien'              => 'required|string|max:5',
                'daerah_klien'              => 'required|string|max:255',
                'negeri_klien'              => 'required|string|max:255',
                'tahap_pendidikan'          => 'required|string|max:255',
                'penyakit'   => 'required|string|max:255',
                'status_oku'                => 'required|string|max:255',
            ]);
        } 
        catch (\Illuminate\Validation\ValidationException $e) {
            // Redirect back with custom error message when validation fails
            return redirect()->back()->with('errorProfil', 'Sila pastikan semua medan bertanda * telah diisi dan format data adalah betul');
        }

        // Map the validated data to the original field names
        $updateData = [
            'no_tel'            => $validatedData['no_tel'],
            'emel'              => $validatedData['emel'],
            'alamat_rumah'      => $validatedData['alamat_rumah_klien'],
            'poskod'            => $validatedData['poskod_klien'],
            'daerah'            => $validatedData['daerah_klien'],
            'negeri'            => $validatedData['negeri_klien'],
            'tahap_pendidikan'  => $validatedData['tahap_pendidikan'],
            'penyakit'          => $validatedData['penyakit'],
            'status_oku'        => $validatedData['status_oku'],
        ];

        // Find the client
        $klien = Klien::find($id);
        $sejarahProfil = SejarahProfilKlien::where('klien_id', $klien->id)->first();

        if ($klien) {
            // Update the client with the mapped data
            $klien->update($updateData);
            $klien->update(['status_kemaskini' => 'Lulus','updated_at' => now()]);

            if (!$sejarahProfil) {
                SejarahProfilKlien::create([
                    'klien_id' => $klien->id,
                    'status_kemaskini' => 'Lulus',
                    'bahagian_kemaskini' => 'Klien',
                    'pengemaskini' => Auth::id(),
                    'updated_at' => now(),
                ]);
            }
            else{
                $sejarahProfil->update([
                    'status_kemaskini' => 'Lulus',
                    'bahagian_kemaskini' => 'Klien',
                    'pengemaskini' => Auth::id(),
                    'updated_at' => now(),
                ]);
            }

            return redirect()->back()->with('success', 'Maklumat profil klien telah berjaya dikemaskini.');
        } 
        else {
            return redirect()->back()->with('error', 'Klien tidak dijumpai.');
        }
    }

    public function kemaskiniMaklumatPekerjaanKlien(Request $request, $id)
    {
        try {
            // Validate the input with conditional rules based on status_kerja
            $validatedData = $request->validate([
                'status_kerja'      => 'required|string|max:255',
                'alasan_tidak_kerja'=> 'nullable|string|max:255',
                'bidang_kerja'      => 'nullable|string|max:255',
                'nama_kerja'        => 'nullable|string|max:255',
                'pendapatan'        => 'nullable|string|max:255',
                'kategori_majikan'  => 'nullable|string|max:255',
                'nama_majikan'      => 'nullable|string|max:255',
                'no_tel_majikan'    => 'nullable|string|max:11',
                'alamat_kerja'      => 'nullable|string|max:255',
                'poskod_kerja'      => 'nullable|integer',
                'daerah_kerja'      => 'nullable|string|max:255',
                'negeri_kerja'      => 'nullable|string|max:255',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Redirect back with custom error message when validation fails
            return redirect()->back()->with('errorProfil', 'Sila pastikan semua medan bertanda * telah diisi dan format data adalah betul');
        }

        // Set default values to null if they match "Pilih Daerah" or "Pilih Negeri"
        $validatedData['daerah_kerja'] = $validatedData['daerah_kerja'] === 'Pilih Daerah' ? null : $validatedData['daerah_kerja'];
        $validatedData['negeri_kerja'] = $validatedData['negeri_kerja'] === 'Pilih Negeri' ? null : $validatedData['negeri_kerja'];

        // Check if status_kerja is "TIDAK BEKERJA" and set other fields to null
        if ($validatedData['status_kerja'] === 'TIDAK BEKERJA') {
            $validatedData = array_merge($validatedData, [
                'bidang_kerja' => null,
                'nama_kerja' => null,
                'pendapatan' => null,
                'kategori_majikan' => null,
                'nama_majikan' => null,
                'no_tel_majikan' => null,
                'alamat_kerja' => null,
                'poskod_kerja' => null,
                'daerah_kerja' => null,
                'negeri_kerja' => null,
            ]);
        } else {
            // Set alasan_tidak_kerja to null if status_kerja is BEKERJA
            $validatedData['alasan_tidak_kerja'] = null;
        }

        // Find PekerjaanKlien record
        $pekerjaanKlien = PekerjaanKlien::where('klien_id', $id)->first();
        $sejarahProfil = SejarahProfilKlien::where('klien_id', $pekerjaanKlien->klien_id)->first();

        if ($pekerjaanKlien) 
        {
            $pekerjaanKlien->update($validatedData);
            $pekerjaanKlien->update(['status_kemaskini' => 'Lulus','updated_at' => now()]);

            if (!$sejarahProfil) {
                SejarahProfilKlien::create([
                    'klien_id' => $pekerjaanKlien->id,
                    'status_kemaskini' => 'Lulus',
                    'bahagian_kemaskini' => 'Pekerjaan',
                    'pengemaskini' => Auth::id(),
                    'updated_at' => now(),
                ]);
            }
            else{
                $sejarahProfil->update([
                    'status_kemaskini' => 'Lulus',
                    'bahagian_kemaskini' => 'Pekerjaan',
                    'pengemaskini' => Auth::id(),
                    'updated_at' => now(),
                ]);
            }
    
            return redirect()->back()->with('success', 'Maklumat pekerjaan klien berjaya dikemaskini.');
        } 
        else {
            return redirect()->back()->with('error', 'Klien tidak dijumpai.');
        }
    }

    public function kemaskiniMaklumatKeluargaKlien(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'status_perkahwinan'    => 'required|string|max:255',
                'nama_pasangan'         => 'nullable|string|max:255',
                'no_tel_pasangan'       => 'nullable|string|max:11',
                'bilangan_anak'         => 'nullable|integer',
                'alamat_pasangan'       => 'nullable|string|max:255',
                'poskod_pasangan'       => 'nullable|string|max:5',
                'daerah_pasangan'       => 'nullable|string|max:255',
                'negeri_pasangan'       => 'nullable|string|max:255',
                'alamat_kerja_pasangan' => 'nullable|string|max:255',
                'poskod_kerja_pasangan' => 'nullable|string|max:5',
                'daerah_kerja_pasangan' => 'nullable|string|max:255',
                'negeri_kerja_pasangan' => 'nullable|string|max:255',
            ]);
        }
        catch (\Illuminate\Validation\ValidationException $e) {
            // Redirect back with custom error message when validation fails
            return redirect()->back()->with('errorProfil', 'Sila pastikan semua medan bertanda * telah diisi dan format data adalah betul');
        }

        // Set default values to null if they match "Pilih Daerah" or "Pilih Negeri"
        if ($validatedData['daerah_pasangan'] === 'Pilih Daerah') {
            $validatedData['daerah_pasangan'] = null;
        }
        if ($validatedData['negeri_pasangan'] === 'Pilih Negeri') {
            $validatedData['negeri_pasangan'] = null;
        }
        if ($validatedData['daerah_kerja_pasangan'] === 'Pilih Daerah') {
            $validatedData['daerah_kerja_pasangan'] = null;
        }
        if ($validatedData['negeri_kerja_pasangan'] === 'Pilih Negeri') {
            $validatedData['negeri_kerja_pasangan'] = null;
        }

        $pasangan = KeluargaKlien::where('id', $id)->first();
        $sejarahProfil = SejarahProfilKlien::where('klien_id', $pasangan->klien_id)->first();

        if ($pasangan) {
            $pasangan->update($validatedData);
            $pasangan->update(['status_kemaskini' => 'Lulus','updated_at' => now()]);

            if (!$sejarahProfil) {
                SejarahProfilKlien::create([
                    'klien_id' => $pasangan->klien_id,
                    'status_kemaskini' => 'Lulus',
                    'bahagian_kemaskini' => 'Keluarga',
                    'pengemaskini' => Auth::id(),
                    'updated_at' => now(),
                ]);
            }
            else{
                $sejarahProfil->update([
                    'status_kemaskini' => 'Lulus',
                    'bahagian_kemaskini' => 'Keluarga',
                    'pengemaskini' => Auth::id(),
                    'updated_at' => now(),
                ]);
            }

            return redirect()->back()->with('success', 'Maklumat keluarga klien berjaya dikemaskini.');
        } 
        else {
            return redirect()->back()->with('error', 'Klien tidak dijumpai.');
        }
    }

    public function kemaskiniMaklumatBapaKlien(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'nama_bapa' => 'nullable|string|max:255',
                'no_kp_bapa'  => 'nullable|string|max:255',
                'no_tel_bapa' => 'nullable|string|max:11',
                'status_bapa' => 'nullable|string|max:255',
                'alamat_bapa' => 'nullable|string|max:255',
                'poskod_bapa' => 'nullable|string|max:5',
                'daerah_bapa' => 'nullable|string|max:255',
                'negeri_bapa' => 'nullable|string|max:255',
            ]);
        }
        catch (\Illuminate\Validation\ValidationException $e) {
            // Redirect back with custom error message when validation fails
            return redirect()->back()->with('errorProfil', 'Sila pastikan semua medan bertanda * telah diisi dan format data adalah betul');
        }

        // Set default values to null if they match "Pilih Daerah" or "Pilih Negeri" or Pilih Status
        if ($validatedData['daerah_bapa'] === 'Pilih Daerah') {
            $validatedData['daerah_bapa'] = null;
        }
        if ($validatedData['negeri_bapa'] === 'Pilih Negeri') {
            $validatedData['negeri_bapa'] = null;
        }
        if ($validatedData['status_bapa'] === 'Pilih Status Bapa') {
            $validatedData['status_bapa'] = null;
        }

        $waris = WarisKlien::where('id', $id)->first();
        $sejarahProfil = SejarahProfilKlien::where('klien_id', $waris->klien_id)->first();

        if ($waris) {
            $waris->update($validatedData);
            $waris->update(['status_kemaskini' => 'Lulus','updated_at' => now()]);

            if (!$sejarahProfil) {
                SejarahProfilKlien::create([
                    'klien_id' => $waris->klien_id,
                    'status_kemaskini' => 'Lulus',
                    'bahagian_kemaskini' => 'Waris',
                    'pengemaskini' => Auth::id(),
                    'updated_at' => now(),
                ]);
            }
            else{
                $sejarahProfil->update([
                    'status_kemaskini' => 'Lulus',
                    'bahagian_kemaskini' => 'Waris',
                    'pengemaskini' => Auth::id(),
                    'updated_at' => now(),
                ]);
            }

            return redirect()->back()->with('success', 'Maklumat bapa klien berjaya dikemaskini.');
        } 
        else {
            return redirect()->back()->with('error', 'Klien tidak dijumpai.');
        }
    }

    public function kemaskiniMaklumatIbuKlien(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'nama_ibu'  => 'nullable|string|max:255',
                'no_kp_ibu' => 'nullable|string|max:255',
                'no_tel_ibu' => 'nullable|string|max:11',
                'status_ibu' => 'nullable|string|max:255',
                'alamat_ibu' => 'nullable|string|max:255',
                'poskod_ibu' => 'nullable|string|max:5',
                'daerah_ibu' => 'nullable|string|max:255',
                'negeri_ibu' => 'nullable|string|max:255',
            ]);
        }
        catch (\Illuminate\Validation\ValidationException $e) {
            // Redirect back with custom error message when validation fails
            return redirect()->back()->with('errorProfil', 'Sila pastikan semua medan bertanda * telah diisi dan format data adalah betul');
        }

        // Set default values to null if they match "Pilih Daerah" or "Pilih Negeri" or Pilih Status
        if ($validatedData['daerah_ibu'] === 'Pilih Daerah') {
            $validatedData['daerah_ibu'] = null;
        }
        if ($validatedData['negeri_ibu'] === 'Pilih Negeri') {
            $validatedData['negeri_ibu'] = null;
        }
        if ($validatedData['status_ibu'] === 'Pilih Status Ibu') {
            $validatedData['status_ibu'] = null;
        }

        $waris = WarisKlien::where('id', $id)->first();
        $sejarahProfil = SejarahProfilKlien::where('klien_id', $waris->klien_id)->first();

        if ($waris) {
            $waris->update($validatedData);
            $waris->update(['status_kemaskini' => 'Lulus', 'updated_at' => now()]);

            if (!$sejarahProfil) {
                SejarahProfilKlien::create([
                    'klien_id' => $waris->klien_id,
                    'status_kemaskini' => 'Lulus',
                    'bahagian_kemaskini' => 'Waris',
                    'pengemaskini' => Auth::id(),
                    'updated_at' => now(),
                ]);
            }
            else{
                $sejarahProfil->update([
                    'status_kemaskini' => 'Lulus',
                    'bahagian_kemaskini' => 'Waris',
                    'pengemaskini' => Auth::id(),
                    'updated_at' => now(),
                ]);
            }

            return redirect()->back()->with('success', 'Maklumat ibu klien berjaya dikemaskini.');
        } 
        else {
            return redirect()->back()->with('error', 'Klien tidak dijumpai.');
        }
    }

    public function kemaskiniMaklumatPenjagaKlien(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'hubungan_penjaga' => 'nullable|string|max:255',
                'nama_penjaga' => 'nullable|string|max:255',
                'no_kp_penjaga' => 'nullable|string|max:255',
                'no_tel_penjaga' => 'nullable|string|max:11',
                'status_penjaga' => 'nullable|string|max:255',
                'alamat_penjaga' => 'nullable|string|max:255',
                'poskod_penjaga' => 'nullable|string|max:5',
                'daerah_penjaga' => 'nullable|string|max:255',
                'negeri_penjaga' => 'nullable|string|max:255',
            ]);
        }
        catch (\Illuminate\Validation\ValidationException $e) {
            // Redirect back with custom error message when validation fails
            return redirect()->back()->with('errorProfil', 'Sila pastikan semua medan bertanda * telah diisi dan format data adalah betul');
        }

        // Set default values to null if they match "Pilih Daerah" or "Pilih Negeri" or Pilih Status
        if ($validatedData['daerah_penjaga'] === 'Pilih Daerah') {
            $validatedData['daerah_penjaga'] = null;
        }
        if ($validatedData['negeri_penjaga'] === 'Pilih Negeri') {
            $validatedData['negeri_penjaga'] = null;
        }
        if ($validatedData['status_penjaga'] === 'Pilih Status Penjaga') {
            $validatedData['status_penjaga'] = null;
        }

        $waris = WarisKlien::where('id', $id)->first();
        $sejarahProfil = SejarahProfilKlien::where('klien_id', $waris->klien_id)->first();

        if ($waris) {
            $waris->update($validatedData);
            $waris->update(['status_kemaskini' => 'Lulus', 'updated_at' => now()]);

            if (!$sejarahProfil) {
                SejarahProfilKlien::create([
                    'klien_id' => $waris->klien_id,
                    'status_kemaskini' => 'Lulus',
                    'bahagian_kemaskini' => 'Waris',
                    'pengemaskini' => Auth::id(),
                    'updated_at' => now(),
                ]);
            }
            else{
                $sejarahProfil->update([
                    'status_kemaskini' => 'Lulus',
                    'bahagian_kemaskini' => 'Waris',
                    'pengemaskini' => Auth::id(),
                    'updated_at' => now(),
                ]);
            }

            return redirect()->back()->with('success', 'Maklumat penjaga klien berjaya dikemaskini.');
        } 
        else {
            return redirect()->back()->with('error', 'Klien tidak dijumpai.');
        }
    }

    // KLIEN
    public function pengurusanProfil()
    {
        $negeri = Negeri::all()->sortBy('negeri');
        $daerah = Daerah::all()->sortBy('daerah');
        $negeriKerja = Negeri::all()->sortBy('negeri');
        $daerahKerja = Daerah::all()->sortBy('daerah');
        $negeriWaris = Negeri::all()->sortBy('negeri');
        $daerahWaris = Daerah::all()->sortBy('daerah');
        $negeriPasangan = Negeri::all()->sortBy('negeri');
        $daerahPasangan = Daerah::all()->sortBy('daerah');
        $negeriKerjaPasangan = Negeri::all()->sortBy('negeri');
        $daerahKerjaPasangan = Daerah::all()->sortBy('daerah');
        $tahapPendidikan = Pendidikan::all();
        $pendapatan = Pendapatan::all();
        $penyakit = Penyakit::all();
        $bidangKerja = BidangPekerjaan::all();
        $namaKerja = NamaPekerjaan::all();
        $majikan = NamaMajikan::all();

        // Retrieve the client's id based on their no_kp
        $clientId = Klien::where('no_kp', Auth::user()->no_kp)->value('id');
        $unreadCount = 0;

        // Join tables and get the client's details
        $butiranKlien = Klien::leftJoin('pekerjaan_klien', 'klien.id', '=', 'pekerjaan_klien.klien_id')
                            ->leftJoin('waris_klien', 'klien.id', '=', 'waris_klien.klien_id')
                            ->leftJoin('keluarga_klien', 'klien.id', '=', 'keluarga_klien.klien_id')
                            ->leftJoin('rawatan_klien', 'klien.id', '=', 'rawatan_klien.klien_id')
                            ->where('klien.id', $clientId)
                            ->first();
                
        $resultRequestPasangan = KeluargaKlienUpdateRequest::where('klien_id', $clientId)->first();
        $resultRequestPekerjaan = PekerjaanKlienUpdateRequest::where('klien_id', $clientId)->first();
        $resultRequestKlien = KlienUpdateRequest::where('klien_id', $clientId)->first();
        $resultRequestBapa = WarisKlienUpdateRequest::where('klien_id', $clientId)->where('waris', 1)->first();
        $resultRequestIbu = WarisKlienUpdateRequest::where('klien_id', $clientId)->where('waris', 2)->first();
        $resultRequestPenjaga = WarisKlienUpdateRequest::where('klien_id', $clientId)->where('waris', 3)->first();

        // Fetch notifications for the client
        $notifications = Notifikasi::where('klien_id', $clientId)
            ->orderBy('created_at', 'desc')
            ->get();

        // Count unread notifications
        $unreadCount = Notifikasi::where('klien_id', $clientId)
            ->where('is_read', false)
            ->count();

        return view('profil_klien.klien.view',compact   ('daerah','negeri','daerahKerja','negeriKerja','negeriWaris','daerahWaris','negeriPasangan','daerahPasangan','negeriKerjaPasangan','daerahKerjaPasangan',
                                                        'butiranKlien','resultRequestPasangan','resultRequestPekerjaan','resultRequestKlien','resultRequestBapa','resultRequestIbu','resultRequestPenjaga',
                                                        'tahapPendidikan','pendapatan','majikan','namaKerja','bidangKerja','penyakit','notifications','unreadCount'));
    }

    public function muatTurunProfilDiri()
    {
        $klien_id = Klien::where('no_kp', Auth::user()->no_kp)->value('id');

        $klien = Klien::where('id',$klien_id)->first();
        $pekerjaan = PekerjaanKlien::where('klien_id',$klien_id)->first();
        $waris = WarisKlien::where('klien_id',$klien_id)->first();
        $pasangan = KeluargaKlien::where('klien_id',$klien_id)->first();
        $rawatan = RawatanKlien::where('klien_id',$klien_id)->first();

        $pdf = PDF::loadView('profil_klien.klien.export_profil', compact('klien', 'pekerjaan','waris','pasangan','rawatan'));

        $no_kp = Auth::user()->no_kp;

        return $pdf->stream($no_kp . '-profil-peribadi.pdf');
    }

    public function KlienRequestUpdate(Request $request)
    {
        try {
            // Validation rules for fields that users can update
            $validatedData = $request->validate([
                'no_tel'           => 'nullable|string|max:11',
                'emel'             => 'nullable|email',
                'alamat_rumah'     => 'required|string|max:255',
                'daerah'           => 'required|string|max:255',
                'negeri'           => 'required|string|max:255',
                'poskod'           => 'required|string|max:5',
                'tahap_pendidikan' => 'required|string|max:255',
            ]);
        } 
        catch (\Illuminate\Validation\ValidationException $e) {
            // Redirect back with custom error message when validation fails
            return redirect()->back()->with('errorProfil', 'Sila pastikan semua medan bertanda * telah diisi dan format data adalah betul');
        }

        // Retrieve the existing data that cannot be updated by the user
        $klienId = Klien::where('no_kp', Auth::user()->no_kp)->value('id');
        $existingData = Klien::where('id', $klienId)->first([
            'nama', 
            'no_kp', 
            'jantina', 
            'agama', 
            'bangsa', 
            'penyakit', 
            'status_oku', 
            'skor_ccri'
        ])->toArray();

        // Check if no_tel and emel are null, if so, remove them from validatedData
        if (is_null($request->input('no_tel'))) {
            unset($validatedData['no_tel']);
        }

        if (is_null($request->input('emel'))) {
            unset($validatedData['emel']);
        }

        // Merge the existing data with the validated data from the request
        $mergedData = array_merge($existingData, $validatedData);

        // Check if there is an existing update request
        $updateRequest = KlienUpdateRequest::where('klien_id', $klienId)->first();
        $sejarahProfil = SejarahProfilKlien::where('klien_id', $klienId)->first();

        // Handle the update logic
        if ($updateRequest && $sejarahProfil) 
        {
            // Both $updateRequest and $sejarahProfil exist, update them
            $updateRequest->update([
                'requested_data' => json_encode($mergedData),
                'status' => 'Kemaskini',
                'updated_at' => now(),
            ]);

            Klien::where('id', $klienId)->update(['status_kemaskini' => 'Kemaskini']);

            $sejarahProfil->update([
                'status_kemaskini' => 'Kemaskini',
                'bahagian_kemaskini' => 'Klien',
                'updated_at' => now(),
            ]);
        } 
        else {
            // If one or both do not exist, create new records
            KlienUpdateRequest::create([
                'klien_id' => $klienId,
                'requested_data' => json_encode($mergedData),
                'status' => 'Kemaskini',
            ]);

            Klien::where('id', $klienId)->update(['status_kemaskini' => 'Kemaskini']);

            if (!$sejarahProfil) {
                SejarahProfilKlien::create([
                    'klien_id' => $klienId,
                    'status_kemaskini' => 'Kemaskini',
                    'bahagian_kemaskini' => 'Klien',
                    'pengemaskini' => null, 
                ]);
            }
        }

        return redirect()->back()->with('success', 'Permohonan kemaskini profil diri telah dihantar untuk semakan.');
    }

    public function pekerjaanKlienRequestUpdate(Request $request)
    {
        try {
            // Validation rules for fields that users can update
            $validatedData = $request->validate([
                'status_kerja'      => 'required|string|max:255',
                'alasan_tidak_kerja'=> 'nullable|string|max:255',
                'bidang_kerja'      => 'nullable|string|max:255',
                'nama_kerja'        => 'nullable|string|max:255',
                'pendapatan'        => 'nullable|string|max:255',
                'kategori_majikan'  => 'nullable|string|max:255',
                'nama_majikan'      => 'nullable|string|max:255',
                'no_tel_majikan'    => 'nullable|string|max:11',
                'alamat_kerja'      => 'nullable|string|max:255',
                'poskod_kerja'      => 'nullable|integer',
                'daerah_kerja'      => 'nullable|string|max:255',
                'negeri_kerja'      => 'nullable|string|max:255',
            ]); 
        } 
        catch (\Illuminate\Validation\ValidationException $e) {
            // Redirect back with custom error message when validation fails
            return redirect()->back()->with('errorProfil', 'Sila pastikan semua medan bertanda * telah diisi dan format data adalah betul');
        }  

        // Check if status_kerja is "TIDAK BEKERJA" and set other fields to null
        if ($validatedData['status_kerja'] === 'TIDAK BEKERJA') {
            $validatedData['bidang_kerja'] = null;
            $validatedData['nama_kerja'] = null;
            $validatedData['pendapatan'] = null;
            $validatedData['kategori_majikan'] = null;
            $validatedData['nama_majikan'] = null;
            $validatedData['no_tel_majikan'] = null;
            $validatedData['alamat_kerja'] = null;
            $validatedData['poskod_kerja'] = null;
            $validatedData['daerah_kerja'] = null;
            $validatedData['negeri_kerja'] = null;
        }

        // dd($validatedData);

        // Set default values to null if they match "Pilih Daerah" or "Pilih Negeri"
        function checkAssignNull($array, $key, $default) {
            return isset($array[$key]) && $array[$key] === $default ? null : ($array[$key] ?? null);
        }

        // Apply the function to each field
        $validatedData['daerah_kerja'] = checkAssignNull($validatedData, 'daerah_kerja', 'Pilih Daerah');
        $validatedData['negeri_kerja'] = checkAssignNull($validatedData, 'negeri_kerja', 'Pilih Negeri');
        $validatedData['alasan_tidak_kerja'] = checkAssignNull($validatedData, 'alasan_tidak_kerja', 'Pilih Alasan');
        
        $klienId = Klien::where('no_kp',Auth::user()->no_kp)->value('id');
        $updateRequest = PekerjaanKlienUpdateRequest::where('klien_id', $klienId)->first();
        $sejarahProfil = SejarahProfilKlien::where('klien_id', $klienId)->first();

        if ($updateRequest && $sejarahProfil) 
        {
            // Update existing request
            $updateRequest->update([
                'requested_data' => json_encode($validatedData),
                'status' => 'Kemaskini', 
                'updated_at' => now(),
            ]);

            PekerjaanKlien::where('klien_id', $klienId)->update(['status_kemaskini' => 'Kemaskini']);

            $sejarahProfil->update([
                'status_kemaskini' => 'Kemaskini',
                'bahagian_kemaskini' => 'Pekerjaan',
                'updated_at' => now(),
            ]);
        } 
        else {
            // Create new request
            PekerjaanKlienUpdateRequest::create([
                'klien_id' => $klienId,
                'requested_data' => json_encode($validatedData),
                'status' => 'Kemaskini',
            ]);

            PekerjaanKlien::where('klien_id', $klienId)->update(['status_kemaskini' => 'Kemaskini']);

            if (!$sejarahProfil) {
                SejarahProfilKlien::create([
                    'klien_id' => $klienId,
                    'status_kemaskini' => 'Kemaskini',
                    'bahagian_kemaskini' => 'Pekerjaan',
                    'pengemaskini' => null, 
                ]);
            }
        }

        return redirect()->back()->with('success', 'Permohonan kemaskini maklumat pekerjaan telah dihantar untuk semakan.');
    }

    public function keluargaKlienRequestUpdate(Request $request)
    {
        try {
            // Validation rules for fields that users can update
            $validatedData = $request->validate([
                'status_perkahwinan'    => 'required|string|max:255',
                'nama_pasangan'         => 'nullable|string|max:255',
                'no_tel_pasangan'       => 'nullable|string|max:11',
                'bilangan_anak'         => 'nullable|string|max:255',
                'alamat_pasangan'       => 'nullable|string|max:255',
                'poskod_pasangan'       => 'nullable|string|max:5',
                'daerah_pasangan'       => 'nullable|string|max:255',
                'negeri_pasangan'       => 'nullable|string|max:255',
                'alamat_kerja_pasangan' => 'nullable|string|max:255',
                'poskod_kerja_pasangan' => 'nullable|string|max:5',
                'daerah_kerja_pasangan' => 'nullable|string|max:255',
                'negeri_kerja_pasangan' => 'nullable|string|max:255',
            ]);
        } 
        catch (\Illuminate\Validation\ValidationException $e) {
            // Redirect back with custom error message when validation fails
            return redirect()->back()->with('errorProfil', 'Sila pastikan semua medan bertanda * telah diisi dan format data adalah betul');
        }  

        // Reusable function to check and assign null if the value is not selected
        function checkAndAssignNull($array, $key, $default) {
            return isset($array[$key]) && $array[$key] === $default ? null : ($array[$key] ?? null);
        }

        // Apply the function to each field
        $validatedData['daerah_pasangan'] = checkAndAssignNull($validatedData, 'daerah_pasangan', 'Pilih Daerah');
        $validatedData['negeri_pasangan'] = checkAndAssignNull($validatedData, 'negeri_pasangan', 'Pilih Negeri');
        $validatedData['daerah_kerja_pasangan'] = checkAndAssignNull($validatedData, 'daerah_kerja_pasangan', 'Pilih Daerah');
        $validatedData['negeri_kerja_pasangan'] = checkAndAssignNull($validatedData, 'negeri_kerja_pasangan', 'Pilih Negeri');

        // dd($validatedData);

        // Proceed with the existing logic
        $klienId = Klien::where('no_kp', Auth::user()->no_kp)->value('id');
        $updateRequest = KeluargaKlienUpdateRequest::where('klien_id', $klienId)->first();
        $sejarahProfil = SejarahProfilKlien::where('klien_id', $klienId)->first();

        if ($updateRequest && $sejarahProfil) {
            // Update existing request
            $updateRequest->update([
                'requested_data' => json_encode($validatedData, JSON_FORCE_OBJECT), // Ensure NULL values are handled
                'status' => 'Kemaskini', 
                'updated_at' => now(),
            ]);

            KeluargaKlien::where('klien_id', $klienId)->update(['status_kemaskini' => 'Kemaskini']);

            $sejarahProfil->update([
                'status_kemaskini' => 'Kemaskini',
                'bahagian_kemaskini' => 'Keluarga',
                'updated_at' => now(),
            ]);
        } 
        else {
            // Create new request
           KeluargaKlienUpdateRequest::create([
                'klien_id' => $klienId,
                'requested_data' => json_encode($validatedData, JSON_FORCE_OBJECT), // Ensure NULL values are handled
                'status' => 'Kemaskini',
            ]);

            KeluargaKlien::where('klien_id', $klienId)->update(['status_kemaskini' => 'Kemaskini']);

            if (!$sejarahProfil) {
                SejarahProfilKlien::create([
                    'klien_id' => $klienId,
                    'status_kemaskini' => 'Kemaskini',
                    'bahagian_kemaskini' => 'Keluarga',
                    'pengemaskini' => null, 
                ]);
            }
        }

        return redirect()->back()->with('success', 'Permohonan kemaskini maklumat keluarga telah dihantar untuk semakan.');
    }

    public function bapaKlienRequestUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'nama_bapa'     => 'nullable|string|max:255',
            'no_kp_bapa'    => 'nullable|string|max:255',
            'no_tel_bapa'   => 'nullable|string|max:11',
            'status_bapa'   => 'nullable|string|max:255',
            'alamat_bapa'   => 'nullable|string|max:255',
            'poskod_bapa'   => 'nullable|string|max:5',
            'daerah_bapa'   => 'nullable|string|max:255',
            'negeri_bapa'   => 'nullable|string|max:255',
        ]);

        function assignNull($array, $key, $default) {
            return isset($array[$key]) && $array[$key] === $default ? null : ($array[$key] ?? null);
        }

        // Apply the function to each field
        $validatedData['daerah_bapa'] = assignNull($validatedData, 'daerah_bapa', 'Pilih Daerah');
        $validatedData['negeri_bapa'] = assignNull($validatedData, 'negeri_bapa', 'Pilih Negeri');

        // dd($validatedData);
        
        $klienId = Klien::where('no_kp', Auth::user()->no_kp)->value('id');
        $updateRequestBapa = WarisKlienUpdateRequest::where('klien_id', $klienId)->where('waris','1')->first();
        $sejarahProfil = SejarahProfilKlien::where('klien_id', $klienId)->first();

        if ($updateRequestBapa && $sejarahProfil) {
            // Update existing request
            $updateRequestBapa->update([
                'requested_data' => json_encode($validatedData),
                'status' => 'Kemaskini', 
                'updated_at' => now(),
            ]);

            WarisKlien::where('klien_id', $klienId)->update(['status_kemaskini' => 'Kemaskini']);

            $sejarahProfil->update([
                'status_kemaskini' => 'Kemaskini',
                'bahagian_kemaskini' => 'Waris',
                'updated_at' => now(),
            ]);
        } 
        else {
            // Create new request
            WarisKlienUpdateRequest::create([
                'klien_id' => $klienId,
                'waris' => 1,
                'requested_data' => json_encode($validatedData),
                'status' => 'Kemaskini',
            ]);

            WarisKlien::where('klien_id', $klienId)->update(['status_kemaskini' => 'Kemaskini']);

            if (!$sejarahProfil) {
                SejarahProfilKlien::create([
                    'klien_id' => $klienId,
                    'status_kemaskini' => 'Kemaskini',
                    'bahagian_kemaskini' => 'Waris',
                    'pengemaskini' => null, 
                ]);
            }
        }

        return redirect()->back()->with('success', 'Permohonan kemaskini maklumat bapa telah dihantar untuk semakan.');
    }

    public function ibuKlienRequestUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'nama_ibu'   => 'nullable|string|max:255',
            'no_kp_ibu'  => 'nullable|string|max:255',
            'no_tel_ibu' => 'nullable|string|max:11',
            'status_ibu' => 'nullable|string|max:255',
            'alamat_ibu' => 'nullable|string|max:255',
            'poskod_ibu' => 'nullable|string|max:5',
            'daerah_ibu' => 'nullable|string|max:255',
            'negeri_ibu' => 'nullable|string|max:255',
        ]);

        function assignNull2($array, $key, $default) {
            return isset($array[$key]) && $array[$key] === $default ? null : ($array[$key] ?? null);
        }

        // Apply the function to each field
        $validatedData['daerah_ibu'] = assignNull2($validatedData, 'daerah_ibu', 'Pilih Daerah');
        $validatedData['negeri_ibu'] = assignNull2($validatedData, 'negeri_ibu', 'Pilih Negeri');
        
        $klienId = Klien::where('no_kp',Auth::user()->no_kp)->value('id');
        $updateRequestIbu = WarisKlienUpdateRequest::where('klien_id', $klienId)->where('waris','2')->first();
        $sejarahProfil = SejarahProfilKlien::where('klien_id', $klienId)->first();

        if ($updateRequestIbu && $sejarahProfil) {
            // Update existing request
            $updateRequestIbu->update([
                'requested_data' => json_encode($validatedData),
                'status' => 'Kemaskini', 
                'updated_at' => now(),
            ]);

            WarisKlien::where('klien_id', $klienId)->update(['status_kemaskini' => 'Kemaskini']);

            $sejarahProfil->update([
                'status_kemaskini' => 'Kemaskini',
                'bahagian_kemaskini' => 'Waris',
                'updated_at' => now(),
            ]);
        } 
        else {
            // Create new request
            WarisKlienUpdateRequest::create([
                'klien_id' => $klienId,
                'waris' => 2, 
                'requested_data' => json_encode($validatedData),
                'status' => 'Kemaskini',
            ]);

            WarisKlien::where('klien_id', $klienId)->update(['status_kemaskini' => 'Kemaskini']);

            if (!$sejarahProfil) {
                SejarahProfilKlien::create([
                    'klien_id' => $klienId,
                    'status_kemaskini' => 'Kemaskini',
                    'bahagian_kemaskini' => 'Waris',
                    'pengemaskini' => null, 
                ]);
            }
        }

        return redirect()->back()->with('success', 'Permohonan kemaskini maklumat ibu telah dihantar untuk semakan.');
    }

    public function penjagaKlienRequestUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'hubungan_penjaga'  => 'nullable|string|max:255',
            'nama_penjaga'      => 'nullable|string|max:255',
            'no_kp_penjaga'     => 'nullable|string|max:255',
            'no_tel_penjaga'    => 'nullable|string|max:11',
            'status_penjaga'    => 'nullable|string|max:255',
            'alamat_penjaga'    => 'nullable|string|max:255',
            'poskod_penjaga'    => 'nullable|string|max:5',
            'daerah_penjaga'    => 'nullable|string|max:255',
            'negeri_penjaga'    => 'nullable|string|max:255',
        ]);

        function assignNull3($array, $key, $default) {
            return isset($array[$key]) && $array[$key] === $default ? null : ($array[$key] ?? null);
        }

        // Apply the function to each field
        $validatedData['daerah_penjaga'] = assignNull3($validatedData, 'daerah_penjaga', 'Pilih Daerah');
        $validatedData['negeri_penjaga'] = assignNull3($validatedData, 'negeri_penjaga', 'Pilih Negeri');

        $klienId = Klien::where('no_kp', Auth::user()->no_kp)->value('id');
        $updateRequestPenjaga = WarisKlienUpdateRequest::where('klien_id', $klienId)->where('waris','3')->first();
        $sejarahProfil = SejarahProfilKlien::where('klien_id', $klienId)->first();

        if ($updateRequestPenjaga && $sejarahProfil) {
            // Update existing request
            $updateRequestPenjaga->update([
                'requested_data' => json_encode($validatedData),
                'status' => 'Kemaskini', 
                'updated_at' => now(),
            ]);

            WarisKlien::where('klien_id', $klienId)->update(['status_kemaskini' => 'Kemaskini']);

            $sejarahProfil->update([
                'status_kemaskini' => 'Kemaskini',
                'bahagian_kemaskini' => 'Waris',
                'updated_at' => now(),
            ]);
        } 
        else {
            // Create new request
            WarisKlienUpdateRequest::create([
                'klien_id' => $klienId,
                'waris' => 3,
                'requested_data' => json_encode($validatedData),
                'status' => 'Kemaskini',
            ]);

            WarisKlien::where('klien_id', $klienId)->update(['status_kemaskini' => 'Kemaskini']);

            if (!$sejarahProfil) {
                SejarahProfilKlien::create([
                    'klien_id' => $klienId,
                    'status_kemaskini' => 'Kemaskini',
                    'bahagian_kemaskini' => 'Waris',
                    'pengemaskini' => null, 
                ]);
            }
        }

        return redirect()->back()->with('success', 'Permohonan kemaskini maklumat penjaga telah dihantar untuk semakan.');
    }

}
