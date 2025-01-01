<?php

namespace App\Http\Controllers;

use App\Models\NotifikasiKlien;
use Illuminate\Http\Request;
use App\Models\Klien;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    public function index()
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
        return view('notifikasi.index', compact('notifications', 'unreadCount'));
    }

    public function markAsRead($id)
    {
        $clientId = Klien::where('no_kp', Auth::user()->no_kp)->value('id');
        $notification = NotifikasiKlien::find($id);

        if ($notification && $notification->klien_id == $clientId) {
            $notification->update(['is_read' => true]);
        }
        
        return redirect()->route('pengurusan-profil');
    }
}
