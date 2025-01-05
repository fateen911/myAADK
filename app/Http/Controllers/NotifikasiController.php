<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Klien;
use App\Models\NotifikasiKlien;
use App\Models\NotifikasiPegawaiDaerah;

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

    public function fetchNotificationsPegawaiDaerah()
    {
        // Declare unread count
        $unreadCountPD = 0;

        // Get the authenticated pegawai daerah
        $pegawai = Auth::user();
        
        // Ensure the user is pegawai daerah
        if ($pegawai->tahap_pengguna != 5) {
            return redirect()->back()->with('error', 'Anda bukan pegawai daerah.');
        }

        // Fetch notifications where daerah_bertugas matches daerah_aadk_lama (for message1)
        $notificationsLama = NotifikasiPegawaiDaerah::where('daerah_aadk_lama', $pegawai->daerah_bertugas)
            ->select('message1', 'created_at')
            ->get();

        // Fetch notifications where daerah_bertugas matches daerah_aadk_baru (for message2)
        $notificationsBaru = NotifikasiPegawaiDaerah::where('daerah_aadk_baru', $pegawai->daerah_bertugas)
            ->select('message2', 'created_at')
            ->get();

        // Combine and sort notifications by created_at descending
        $notifications = $notificationsLama->merge($notificationsBaru)->sortByDesc('created_at');

        // Count unread notifications where is_read = false
        $unreadCountPD = $notifications->where('is_read', false)->count();

        // Pass notifications to the view
        return view('notifications.pegawai_daerah', compact('notifications', 'unreadCountPD'));
    }

}
