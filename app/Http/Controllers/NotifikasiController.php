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

        // dd($klienPindahKeluar);

        // Count unread notifications
        $unreadCountPD = NotifikasiPegawaiDaerah::where('is_read', false)
            ->where(function ($query) use ($pegawaiDaerah) {
                $query->where('daerah_aadk_lama', $pegawaiDaerah->daerah_bertugas)
                    ->orWhere('daerah_aadk_baru', $pegawaiDaerah->daerah_bertugas);
            })
            ->count();

        // Fetch notifications where daerah_bertugas matches daerah_aadk_lama (for message1)
        $notificationsLama = NotifikasiPegawaiDaerah::where('daerah_aadk_lama', $pegawaiDaerah->daerah_bertugas)
            ->select('message1', 'created_at')
            ->get();

        // Fetch notifications where daerah_bertugas matches daerah_aadk_baru (for message2)
        $notificationsBaru = NotifikasiPegawaiDaerah::where('daerah_aadk_baru', $pegawaiDaerah->daerah_bertugas)
            ->select('message2', 'created_at')
            ->get();

        // Combine and sort notifications by created_at descending
        $notifications = $notificationsLama->merge($notificationsBaru)->sortByDesc('created_at');

        // Pass the data to the view
        return view('notifikasi.pegawai_daerah', compact('klienPindahMasuk', 'klienPindahKeluar', 'unreadCountPD', 'notifications'));
    }

    // public function fetchNotificationsPD()
    // {
    //     // Get the authenticated pegawai daerah
    //     $pegawai = Auth::user();
    //     $pegawaiDaerah = Pegawai::where('users_id',$pegawai->id)->first();

    //     // Fetch Pindah Masuk (daerah_aadk_baru matches daerah_bertugas)
    //     $klienPindahMasuk = NotifikasiPegawaiDaerah::where('notifikasi_pegawai_daerah.daerah_aadk_baru', $pegawaiDaerah->daerah_bertugas)
    //         ->join('pejabat_pengawasan_klien', 'notifikasi_pegawai_daerah.klien_id', '=', 'pejabat_pengawasan_klien.klien_id')
    //         ->select(
    //             'pejabat_pengawasan_klien.klien_id',
    //             'pejabat_pengawasan_klien.alamat_rumah_asal',
    //             'pejabat_pengawasan_klien.alamat_rumah_baru',
    //             'pejabat_pengawasan_klien.daerah_aadk_baru',
    //             'notifikasi_pegawai_daerah.message1',
    //             'notifikasi_pegawai_daerah.created_at'
    //         )
    //         ->get();

    //     // Fetch Pindah Keluar (daerah_aadk_lama matches daerah_bertugas)
    //     $klienPindahKeluar = NotifikasiPegawaiDaerah::where('notifikasi_pegawai_daerah.daerah_aadk_lama', $pegawaiDaerah->daerah_bertugas)
    //         ->join('pejabat_pengawasan_klien', 'notifikasi_pegawai_daerah.klien_id', '=', 'pejabat_pengawasan_klien.klien_id')
    //         ->select(
    //             'pejabat_pengawasan_klien.klien_id',
    //             'pejabat_pengawasan_klien.alamat_rumah_asal',
    //             'pejabat_pengawasan_klien.alamat_rumah_baru',
    //             'pejabat_pengawasan_klien.daerah_aadk_asal',
    //             'notifikasi_pegawai_daerah.message2',
    //             'notifikasi_pegawai_daerah.created_at'
    //         )
    //         ->get();
        
    //     // dd($klienPindahKeluar);

    //     // Fetch notifications where daerah_bertugas matches daerah_aadk_lama (for message1)
    //     $notificationsLama = NotifikasiPegawaiDaerah::where('daerah_aadk_lama', $pegawaiDaerah->daerah_bertugas)
    //         ->select('message1', 'created_at')
    //         ->get();

    //     // Fetch notifications where daerah_bertugas matches daerah_aadk_baru (for message2)
    //     $notificationsBaru = NotifikasiPegawaiDaerah::where('daerah_aadk_baru', $pegawaiDaerah->daerah_bertugas)
    //         ->select('message2', 'created_at')
    //         ->get();

    //     // Combine and sort notifications by created_at descending
    //     $notifications = $notificationsLama->merge($notificationsBaru)->sortByDesc('created_at');

    //     // Count unread notifications where is_read = false
    //     $unreadCountPD = $notifications->where('is_read', false)->count();

    //     // Pass the data to the view
    //     return view('notifikasi.pegawai_daerah', compact('klienPindahMasuk', 'klienPindahKeluar', 'notifications', 'unreadCountPD'));
    // }
}
