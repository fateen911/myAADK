<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
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
                    'email' => 'required|email|unique:users,email',
                ]);
                
                User::where('no_kp',Auth::user()->no_kp)
                ->update([
                    'gambar_profil' => $filename,
                    'name' => $request->name,
                    'no_kp' => $request->no_kp,
                    $user->email => $request->email,
                ]);
            }
            else{
                User::where('no_kp',Auth::user()->no_kp)
                ->update([
                    'gambar_profil' => $filename,
                    'name' => $request->name,
                    'no_kp' => $request->no_kp,
                ]);
            }
        }
        else{
            if ($request->email !== $user->email) {
                // Validate email uniqueness
                $request->validate([
                    'email' => 'required|email|unique:users,email',
                ]);
                
                User::where('no_kp',Auth::user()->no_kp)
                ->update([
                    'name' => $request->name,
                    'no_kp' => $request->no_kp,
                    $user->email => $request->email,
                ]);
            }
            else{
                User::where('no_kp',Auth::user()->no_kp)
                ->update([
                    'name' => $request->name,
                    'no_kp' => $request->no_kp,
                ]);
            }
        }
        
        return Redirect::route('profile.edit')->with('success', 'Maklumat profil berjaya dikemaskini.');
    }
    // public function update(ProfileUpdateRequest $request): RedirectResponse
    // {
    //     $request->user()->fill($request->validated());

    //     if ($request->user()->isDirty('email')) {
    //         $request->user()->email_verified_at = null;
    //     }

    //     $request->user()->save();

    //     return Redirect::route('profile.edit')->with('status', 'profile-updated');
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
