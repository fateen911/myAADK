<?php

namespace App\Http\Controllers;

use App\Models\KategoriProgram;
use App\Models\Program;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pegawai;
use App\Models\NotifikasiPegawaiDaerah;

class PelaporanController extends Controller
{
    public function modalKepulihan()
    {
        // Notifications and unread count for tahap_pengguna == 5
        $notifications = null;
        $unreadCountPD = 0;

        if (Auth::user()->tahap_pengguna == 5) {
            $pegawaiDaerah = Pegawai::where('users_id', Auth::user()->id)->first();

            // Fetch notifications where daerah_bertugas matches daerah_aadk_lama (message1)
            $notificationsLama = NotifikasiPegawaiDaerah::where('daerah_aadk_lama', $pegawaiDaerah->daerah_bertugas)
                ->select('id', 'message1', 'created_at', 'is_read1')
                ->get();

            // Fetch notifications where daerah_bertugas matches daerah_aadk_baru (message2)
            $notificationsBaru = NotifikasiPegawaiDaerah::where('daerah_aadk_baru', $pegawaiDaerah->daerah_bertugas)
                ->select('id', 'message2', 'created_at', 'is_read2')
                ->get();

            // Combine and sort notifications by created_at descending
            $notifications = $notificationsLama->merge($notificationsBaru)->sortByDesc('created_at');

            // Correct unread count calculation for logged-in user's daerah_bertugas
            $unreadCountPD = NotifikasiPegawaiDaerah::where(function ($query) use ($pegawaiDaerah) {
                                $query->where(function ($subQuery) use ($pegawaiDaerah) {
                                    $subQuery->where('daerah_aadk_lama', $pegawaiDaerah->daerah_bertugas)
                                        ->where('is_read1', false);
                                })->orWhere(function ($subQuery) use ($pegawaiDaerah) {
                                    $subQuery->where('daerah_aadk_baru', $pegawaiDaerah->daerah_bertugas)
                                        ->where('is_read2', false);
                                });
                            })->count();
        }

        return view('pelaporan.modal_kepulihan', compact('notifications', 'unreadCountPD'));
    }

    public function aktiviti()
    {
        // Notifications and unread count for tahap_pengguna == 5
        $notifications = null;
        $unreadCountPD = 0;

        if (Auth::user()->tahap_pengguna == 5) {
            $pegawaiDaerah = Pegawai::where('users_id', Auth::user()->id)->first();

            // Fetch notifications where daerah_bertugas matches daerah_aadk_lama (message1)
            $notificationsLama = NotifikasiPegawaiDaerah::where('daerah_aadk_lama', $pegawaiDaerah->daerah_bertugas)
                ->select('id', 'message1', 'created_at', 'is_read1')
                ->get();

            // Fetch notifications where daerah_bertugas matches daerah_aadk_baru (message2)
            $notificationsBaru = NotifikasiPegawaiDaerah::where('daerah_aadk_baru', $pegawaiDaerah->daerah_bertugas)
                ->select('id', 'message2', 'created_at', 'is_read2')
                ->get();

            // Combine and sort notifications by created_at descending
            $notifications = $notificationsLama->merge($notificationsBaru)->sortByDesc('created_at');

            // Correct unread count calculation for logged-in user's daerah_bertugas
            $unreadCountPD = NotifikasiPegawaiDaerah::where(function ($query) use ($pegawaiDaerah) {
                                $query->where(function ($subQuery) use ($pegawaiDaerah) {
                                    $subQuery->where('daerah_aadk_lama', $pegawaiDaerah->daerah_bertugas)
                                        ->where('is_read1', false);
                                })->orWhere(function ($subQuery) use ($pegawaiDaerah) {
                                    $subQuery->where('daerah_aadk_baru', $pegawaiDaerah->daerah_bertugas)
                                        ->where('is_read2', false);
                                });
                            })->count();
        }

        return view('pelaporan.aktiviti', compact('notifications', 'unreadCountPD'));
    }

    public function senaraiAktiviti(){
        $user_id = Auth::id();

        // Notifications and unread count for tahap_pengguna == 5
        $notifications = null;
        $unreadCountPD = 0;

        if (Auth::user()->tahap_pengguna == 5) {
            $pegawaiDaerah = Pegawai::where('users_id', Auth::user()->id)->first();

            // Fetch notifications where daerah_bertugas matches daerah_aadk_lama (message1)
            $notificationsLama = NotifikasiPegawaiDaerah::where('daerah_aadk_lama', $pegawaiDaerah->daerah_bertugas)
                ->select('id', 'message1', 'created_at', 'is_read1')
                ->get();

            // Fetch notifications where daerah_bertugas matches daerah_aadk_baru (message2)
            $notificationsBaru = NotifikasiPegawaiDaerah::where('daerah_aadk_baru', $pegawaiDaerah->daerah_bertugas)
                ->select('id', 'message2', 'created_at', 'is_read2')
                ->get();

            // Combine and sort notifications by created_at descending
            $notifications = $notificationsLama->merge($notificationsBaru)->sortByDesc('created_at');

            // Correct unread count calculation for logged-in user's daerah_bertugas
            $unreadCountPD = NotifikasiPegawaiDaerah::where(function ($query) use ($pegawaiDaerah) {
                $query->where(function ($subQuery) use ($pegawaiDaerah) {
                    $subQuery->where('daerah_aadk_lama', $pegawaiDaerah->daerah_bertugas)
                        ->where('is_read1', false);
                })->orWhere(function ($subQuery) use ($pegawaiDaerah) {
                    $subQuery->where('daerah_aadk_baru', $pegawaiDaerah->daerah_bertugas)
                        ->where('is_read2', false);
                });
            })->count();
        }
        //available years
        // Get available years from the database
        $years = Program::selectRaw('YEAR(tarikh_mula) as year')
                ->distinct()
                ->orderBy('year', 'desc')
                ->pluck('year');
        // Get all category
        $kategori = KategoriProgram::all();

        return view('pelaporan.aktivitiND.senarai_aktiviti',compact('user_id', 'notifications', 'unreadCountPD', 'years','kategori'));
    }

    public function filterSenaraiAktiviti(Request $request)
    {
        $user_id = Auth::id();

        // Notifications and unread count for tahap_pengguna == 5
        $notifications = null;
        $unreadCountPD = 0;

        if (Auth::user()->tahap_pengguna == 5) {
            $pegawaiDaerah = Pegawai::where('users_id', Auth::user()->id)->first();

            // Fetch notifications where daerah_bertugas matches daerah_aadk_lama (message1)
            $notificationsLama = NotifikasiPegawaiDaerah::where('daerah_aadk_lama', $pegawaiDaerah->daerah_bertugas)
                ->select('id', 'message1', 'created_at', 'is_read1')
                ->get();

            // Fetch notifications where daerah_bertugas matches daerah_aadk_baru (message2)
            $notificationsBaru = NotifikasiPegawaiDaerah::where('daerah_aadk_baru', $pegawaiDaerah->daerah_bertugas)
                ->select('id', 'message2', 'created_at', 'is_read2')
                ->get();

            // Combine and sort notifications by created_at descending
            $notifications = $notificationsLama->merge($notificationsBaru)->sortByDesc('created_at');

            // Correct unread count calculation for logged-in user's daerah_bertugas
            $unreadCountPD = NotifikasiPegawaiDaerah::where(function ($query) use ($pegawaiDaerah) {
                $query->where(function ($subQuery) use ($pegawaiDaerah) {
                    $subQuery->where('daerah_aadk_lama', $pegawaiDaerah->daerah_bertugas)
                        ->where('is_read1', false);
                })->orWhere(function ($subQuery) use ($pegawaiDaerah) {
                    $subQuery->where('daerah_aadk_baru', $pegawaiDaerah->daerah_bertugas)
                        ->where('is_read2', false);
                });
            })->count();
        }

        // Get filters from the request
        $tahun = $request->input('tahun', null);
        $bulan = $request->input('bulan', null);
        $pKategori = $request->input('kategori', null);
        $status = $request->input('status', null);

        //available years
        // Get available years from the database
        $years = Program::selectRaw('YEAR(tarikh_mula) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');
        // Get all category
        $kategori = KategoriProgram::all();

        return view('pelaporan.aktivitiND.filter_senarai_aktiviti', compact('user_id', 'notifications', 'unreadCountPD','tahun','bulan','pKategori','status','years','kategori'));
    }

    public function jsonFIlterAktiviti(Request $request,$id)
    {
        $user = User::find($id);
        $pegawai = Pegawai::where('users_id',$id)->first();
        $query = Program::query();

        // Apply filters
        if ($request->tahun) {
            $query->whereYear('tarikh_mula', $request->tahun);
        }
        if ($request->tahun) {
            $query->whereMonth('tarikh_mula', $request->bulan);
        }
        if ($request->kategori) {
            $query->where('kategori_id', $request->kategori);
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }

        if($user){
            if ($user->tahap_pengguna == '1' || $user->tahap_pengguna == '3') {//pentadbir or pegawai brpp
                $program = $query->with('kategori')->orderBy('created_at', 'desc')->get();
                return response()->json($program);
            }
            else if ($user->tahap_pengguna == '4') {//pegawai negeri
                $program = $query->with('kategori')
                    ->where('negeri_pejabat',$pegawai->negeri_bertugas)
                    ->orderBy('created_at', 'desc')
                    ->get();
                return response()->json($program);
            }
            else if ($user->tahap_pengguna == '5') {//pegawai daerah
                $program = $query->with('kategori')
                    ->where('negeri_pejabat',$pegawai->negeri_bertugas)
                    ->where('daerah_pejabat',$pegawai->daerah_bertugas)
                    ->orderBy('created_at', 'desc')
                    ->get();
                return response()->json($program);
            }
        }
        return redirect()->back()->with('error', 'User tidak dijumpai');
    }
}
