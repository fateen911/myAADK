<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Http\Request;
use App\Models\Klien;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    // public function view()
    // {
    //     $clientId = Klien::where('no_kp', Auth::user()->no_kp)->value('id');

    //     // Fetch notifications for the client
    //     $notifications = Notifikasi::where('klien_id', $clientId)
    //         ->orderBy('created_at', 'desc')
    //         ->get();

    //     // Count unread notifications
    //     $unreadCount = Notifikasi::where('klien_id', $clientId)
    //         ->where('is_read', false)
    //         ->count();
        
    //     return view('layouts.header.main', compact('notifications','unreadCount'));
    // }

    public function index()
    {
        $clientId = Klien::where('no_kp', Auth::user()->no_kp)->value('id');
        $unreadCount = 0;
        
        // Fetch notifications for the client
        $notifications = Notifikasi::where('klien_id', $clientId)
            ->orderBy('created_at', 'desc')
            ->get();

        // Count unread notifications
        $unreadCount = Notifikasi::where('klien_id', $clientId)
            ->where('is_read', false)
            ->count();
        
        // Pass both notifications and unread count to the view
        return view('notifikasi.index', compact('notifications', 'unreadCount'));
    }

    public function markAsRead($id)
    {
        $clientId = Klien::where('no_kp', Auth::user()->no_kp)->value('id');
        $notification = Notifikasi::find($id);

        if ($notification && $notification->klien_id == $clientId) {
            $notification->update(['is_read' => true]);
        }
        
        return redirect()->route('pengurusan-profil');
    }
}
