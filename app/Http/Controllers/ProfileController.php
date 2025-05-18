<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Klien;
use App\Models\Pegawai;
use App\Models\NotifikasiPegawaiDaerah;
use App\Models\NotifikasiKlien;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        if(Auth::user()->tahap_pengguna == 2)
        {
            $clientId = Klien::where('no_kp', Auth::user()->no_kp)->value('id');

            // Fetch notifications for the client
            $notifications = NotifikasiKlien::where('klien_id', $clientId)
                ->orderBy('created_at', 'desc')
                ->get();

            // Count unread notifications
            $unreadCount = NotifikasiKlien::where('klien_id', $clientId)
                ->where('is_read', false)
                ->count();

            return view('profile.edit', compact('notifications', 'unreadCount'), [
                'user' => $request->user(),
            ]);
        }
        elseif (Auth::user()->tahap_pengguna == 5) 
        {
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

            // Count unread notifications where is_read = false
            $unreadCountPD = NotifikasiPegawaiDaerah::where(function ($query) {
                $query->where('is_read1', false)
                    ->orWhere('is_read2', false);
            })->count();

            return view('profile.edit', compact('notifications', 'unreadCountPD'), [
                'user' => $request->user(),
            ]);
        }
        else
        {
            return view('profile.edit', [
                'user' => $request->user(),
            ]);
        }
    }

    public function updatePassword(Request $request): View
    {
        $clientId = Klien::where('no_kp', Auth::user()->no_kp)->value('id');
        $unreadCount = 0;

        if(Auth::user()->tahap_pengguna == 2)
        {
            // Fetch notifications for the client
            $notifications = NotifikasiKlien::where('klien_id', $clientId)
                ->orderBy('created_at', 'desc')
                ->get();

            // Ensure $unreadCount is defined even when there are no notifications
            $unreadCount = NotifikasiKlien::where('klien_id', $clientId)
            ->where('is_read', false)
            ->count();

            return view('profile.update_password', ['user' => $request->user(),], compact('notifications','unreadCount'));
        }
        elseif (Auth::user()->tahap_pengguna == 5) 
        {
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

            // Count unread notifications where is_read = false
            $unreadCountPD = NotifikasiPegawaiDaerah::where(function ($query) {
                $query->where('is_read1', false)
                    ->orWhere('is_read2', false);
            })->count();

            return view('profile.update_password', ['user' => $request->user(),], compact('notifications','unreadCountPD'));
        }
        else{
            return view('profile.update_password', ['user' => $request->user(),]);
        }

    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Tahap 2: Klien - handle email update only
        if ($user->tahap_pengguna == 2) {
            if ($request->email !== $user->email) {
                User::where('no_kp', $user->no_kp)->update([
                    'email' => $request->email,
                ]);

                Klien::where('no_kp', $user->no_kp)->update([
                    'emel' => $request->email,
                ]);
            }

            return Redirect::route('profile.edit')->with('success', 'Emel klien telah berjaya dikemaskini.');
        }

        // Handle image removal
        if ($request->remove_gambar_profil == 1) {
            $existingImage = $user->gambar_profil;
            if ($existingImage && file_exists(public_path('assets/gambar_profil/' . $existingImage))) {
                unlink(public_path('assets/gambar_profil/' . $existingImage));
                User::where('no_kp', $user->no_kp)->update(['gambar_profil' => null]);
            }
        } 
        // Handle image upload with sanitization
        else if ($request->hasFile('gambar_profil') && $request->file('gambar_profil')->isValid()) {
            $request->validate([
                'gambar_profil' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            ]);

            $originalName = $request->file('gambar_profil')->getClientOriginalName();
            $extension = strtolower($request->file('gambar_profil')->getClientOriginalExtension());

            // Sanitize: remove all non-alphanumeric characters from name (keep 1 dot for extension)
            $nameOnly = pathinfo($originalName, PATHINFO_FILENAME);
            $nameOnly = preg_replace("/[^a-zA-Z0-9]/", "", $nameOnly); // Remove anything not alphanumeric

            // Ensure name and extension are not empty
            if (empty($nameOnly) || empty($extension)) {
                return Redirect::back()->withErrors(['gambar_profil' => 'Nama fail tidak sah.']);
            }

            // Generate secure hashed filename (based on name + current date)
            $date = date('YmdHis');
            $hashedName = hash('sha256', $nameOnly . $date);

            // Final filename (e.g., abcd123... .jpg)
            $filename = substr($hashedName, 0, 200) . '.' . substr($extension, 0, 10);

            // Limit length strictly < 255
            if (strlen($filename) >= 255) {
                return Redirect::back()->withErrors(['gambar_profil' => 'Nama fail terlalu panjang.']);
            }

            // Move file to public/assets/gambar_profil
            $request->file('gambar_profil')->move(public_path('assets/gambar_profil'), $filename);

            // Update database
            User::where('no_kp', $user->no_kp)->update([
                'gambar_profil' => $filename,
            ]);
        }

        return Redirect::route('profile.edit')->with('success', 'Gambar profil pengguna telah berjaya dikemaskini.');
    }
    
    // public function update(Request $request)
    // {
    //     $user = Auth::user();

    //     // Update email if it is changed
    //     if($user->tahap_pengguna == 2)
    //     {
    //         if($request->email !== $user->email)
    //         {
    //             User::where('no_kp', Auth::user()->no_kp)
    //                 ->update([
    //                     'email' => $request->email,
    //                 ]);

    //             Klien::where('no_kp',Auth::user()->no_kp)
    //                 ->update([
    //                     'emel' => $request->email,
    //                 ]);
    //         }
    //     }
    //     else if ($user->tahap_pengguna == 1 || $user->tahap_pengguna == 3 || $user->tahap_pengguna == 4 || $user->tahap_pengguna == 5) 
    //     {
    //         // The existing file upload logic
    //         if ($request->remove_gambar_profil == 1) {
    //             if ($user->gambar_profil && file_exists(public_path('assets/gambar_profil/' . $user->gambar_profil))) {
    //                 // Delete the old photo from the server
    //                 unlink(public_path('assets/gambar_profil/' . $user->gambar_profil));
        
    //                 // Set the gambar_profil to null in the database
    //                 User::where('no_kp', Auth::user()->no_kp)->update([
    //                     'gambar_profil' => null,
    //                 ]);
    //             }
    //         } 
    //         else if ($request->hasFile('gambar_profil') && $request->file('gambar_profil')->isValid()) {
    //             $request->validate([
    //                 'gambar_profil' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
    //             ]);

    //             // Delete old file
    //             if ($user->gambar_profil && Storage::exists('public/gambar_profil/' . $user->gambar_profil)) {
    //                 Storage::delete('public/gambar_profil/' . $user->gambar_profil);
    //             }

    //             // Rename and store securely
    //             $filename = strval(Auth::user()->no_kp) . '_' . time() . '.' . $request->gambar_profil->extension();
    //             $request->file('gambar_profil')->storeAs('public/gambar_profil', $filename);

    //             // Update DB
    //             User::where('no_kp', Auth::user()->no_kp)->update([
    //                 'gambar_profil' => $filename,
    //             ]);
    //         }
    //     }
        
    //     return Redirect::route('profile.edit')->with('success', 'Maklumat profil berjaya dikemaskini.');
    // }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
