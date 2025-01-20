<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Klien;
use App\Models\NotifikasiKlien;
use App\Models\NotifikasiPegawaiDaerah;
use App\Models\Pegawai;

class NotifikasiController extends Controller
{
    public function indexKlien()
    {
        $clientId = Klien::where('no_kp', Auth::user()->no_kp)->value('id');
        $unreadCount = 0;
        
        // Fetch notifications for the client
        $notifications = NotifikasiKlien::where('klien_id', $clientId)
            ->orderBy('created_at', 'desc')
            ->get();

        // Count unread notifications
        $unreadCount = NotifikasiKlien::where('klien_id', $clientId)
            ->where('is_read', false)
            ->count();
        
        // Pass both notifications and unread count to the view
        return view('notifikasi.klien', compact('notifications', 'unreadCount'));
    }

    public function markAsReadKlien($id)
    {
        $clientId = Klien::where('no_kp', Auth::user()->no_kp)->value('id');
        $notification = NotifikasiKlien::find($id);

        if ($notification && $notification->klien_id == $clientId) {
            $notification->update(['is_read' => true]);
        }
        
        return redirect()->route('pengurusan-profil');
    }

    public function fetchNotificationsPD()
    {
        $pegawai = Auth::user();
        $pegawaiDaerah = Pegawai::where('users_id',$pegawai->id)->first();

        // Fetch notifications where daerah_bertugas matches daerah_aadk_lama (for message1)
        $notificationsLama = NotifikasiPegawaiDaerah::where('daerah_aadk_lama', $pegawaiDaerah->daerah_bertugas)
        ->select('id', 'message1', 'created_at', 'is_read1')
        ->get();

        // Fetch notifications where daerah_bertugas matches daerah_aadk_baru (for message2)
        $notificationsBaru = NotifikasiPegawaiDaerah::where('daerah_aadk_baru', $pegawaiDaerah->daerah_bertugas)
                ->select('id','message2', 'created_at', 'is_read2')
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

        return view('notifikasi.pegawai_daerah', compact('unreadCountPD', 'notifications'));
    }

    public function senaraiTukarAADKDaerahPD()
    {
        // Get the authenticated pegawai daerah
        $pegawai = Auth::user();
        $pegawaiDaerah = Pegawai::where('users_id', $pegawai->id)->first();

        // Fetch Pindah Masuk (daerah_aadk_baru matches daerah_bertugas)
        $klienPindahMasuk = NotifikasiPegawaiDaerah::where('notifikasi_pegawai_daerah.daerah_aadk_baru', $pegawaiDaerah->daerah_bertugas)
            ->join('pejabat_pengawasan_klien', 'notifikasi_pegawai_daerah.klien_id', '=', 'pejabat_pengawasan_klien.klien_id')
            ->join('klien', 'notifikasi_pegawai_daerah.klien_id', '=', 'klien.id') // Join with klien table
            ->select(
                'klien.nama', // Fetch nama from klien
                'klien.no_kp', // Fetch no_kp from klien
                'pejabat_pengawasan_klien.alamat_rumah_asal',
                'pejabat_pengawasan_klien.poskod_rumah_asal',
                'pejabat_pengawasan_klien.negeri_rumah_asal',
                'pejabat_pengawasan_klien.daerah_rumah_asal',
                'pejabat_pengawasan_klien.alamat_rumah_baru',
                'pejabat_pengawasan_klien.poskod_rumah_baru',
                'pejabat_pengawasan_klien.daerah_rumah_baru',
                'pejabat_pengawasan_klien.negeri_rumah_baru',
                'pejabat_pengawasan_klien.daerah_aadk_asal',
            )
            ->get();

        // Fetch Pindah Keluar (daerah_aadk_lama matches daerah_bertugas)
        $klienPindahKeluar = NotifikasiPegawaiDaerah::where('notifikasi_pegawai_daerah.daerah_aadk_lama', $pegawaiDaerah->daerah_bertugas)
            ->join('pejabat_pengawasan_klien', 'notifikasi_pegawai_daerah.klien_id', '=', 'pejabat_pengawasan_klien.klien_id')
            ->join('klien', 'notifikasi_pegawai_daerah.klien_id', '=', 'klien.id') // Join with klien table
            ->select(
                'klien.nama', // Fetch nama from klien
                'klien.no_kp', // Fetch no_kp from klien
                'pejabat_pengawasan_klien.alamat_rumah_asal',
                'pejabat_pengawasan_klien.poskod_rumah_asal',
                'pejabat_pengawasan_klien.negeri_rumah_asal',
                'pejabat_pengawasan_klien.daerah_rumah_asal',
                'pejabat_pengawasan_klien.alamat_rumah_baru',
                'pejabat_pengawasan_klien.poskod_rumah_baru',
                'pejabat_pengawasan_klien.daerah_rumah_baru',
                'pejabat_pengawasan_klien.negeri_rumah_baru',
                'pejabat_pengawasan_klien.daerah_aadk_baru',
            )
            ->get();

        // Fetch notifications where daerah_bertugas matches daerah_aadk_lama (for message1)
        $notificationsLama = NotifikasiPegawaiDaerah::where('daerah_aadk_lama', $pegawaiDaerah->daerah_bertugas)
            ->select('id', 'message1', 'created_at', 'is_read1')
            ->get();

        // Fetch notifications where daerah_bertugas matches daerah_aadk_baru (for message2)
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

        // Pass the data to the view
        return view('notifikasi.senarai_tukar_daerah', compact('klienPindahMasuk', 'klienPindahKeluar', 'unreadCountPD', 'notifications'));
    }

    public function markAsReadPD($id, $message)
    {
        $notification = NotifikasiPegawaiDaerah::find($id);

        if ($notification) {
            if ($message === 'message1') {
                $notification->update(['is_read1' => true]);
            } elseif ($message === 'message2') {
                $notification->update(['is_read2' => true]);
            }
        }

        return redirect()->route('notifications.senaraiTukarDaerahPD');
    }

}
