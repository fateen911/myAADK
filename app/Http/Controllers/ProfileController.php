<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Klien;
use App\Models\Notifikasi;

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
            $notifications = Notifikasi::where('klien_id', $clientId)
                ->orderBy('created_at', 'desc')
                ->get();

            // Count unread notifications
            $unreadCount = Notifikasi::where('klien_id', $clientId)
                ->where('is_read', false)
                ->count();

            return view('profile.edit', compact('notifications', 'unreadCount'), [
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
        return view('profile.update_password', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = Auth::user();

        if ($request->hasFile('gambar_profil') && $request->file('gambar_profil')->isValid()) 
        {
            $filename = strval(Auth::user()->no_kp) . "_" . $request->gambar_profil->getClientOriginalName();
            $request->gambar_profil->move('assets/gambar_profil',$filename);

            if ($request->email !== $user->email) {
                // Validate email uniqueness
                $request->validate([
                    'email' => 'nullable|string',
                ]);
                
                User::where('no_kp',Auth::user()->no_kp)
                ->update([
                    'gambar_profil' => $filename,
                    $user->email => $request->email,
                ]);
            }
            else{
                User::where('no_kp',Auth::user()->no_kp)
                ->update([
                    'gambar_profil' => $filename,
                ]);
            }
        }
        else{
            if ($request->email !== $user->email) {
                // Validate email uniqueness
                $request->validate([
                    'email' => 'nullable|string',
                ]);
                
                User::where('no_kp',Auth::user()->no_kp)
                ->update([
                    'email' => $request->email,
                ]);
            }
        }

        if($user->tahap_pengguna == 2 && $request->email !== $user->email)
        {
            Klien::where('no_kp',Auth::user()->no_kp)
                ->update([
                    'emel' => $request->email,
                ]);
        }
        
        return Redirect::route('profile.edit')->with('success', 'Maklumat profil berjaya dikemaskini.');
    }

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
