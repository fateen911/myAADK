<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\Klien;
use App\Models\User;
use App\Models\WarisKlien;

class PasswordResetChallengeFormController extends Controller
{
    public function showChallengeForm()
    {
        return view('auth.challenge-form');
    }

    public function checkChallengeAnswer(Request $request)
    {
        $request->validate([
            'no_kad_pengenalan' => 'required',
            'nama_waris' => 'required'
        ]);

        $klien = Klien::where('no_kp', $request->no_kad_pengenalan)->first();
        $waris = WarisKlien::where('klien_id', $klien->id)->first();

        if ($klien && $waris->nama_waris === $request->nama_waris) 
        {
            // Store the no_kad_pengenalan in the session
            session(['no_kad_pengenalan' => $request->no_kad_pengenalan]);
            return redirect()->route('reset.password.challenge');
        } 
        else 
        {
            return back()->withErrors(['nama_waris' => 'Jawapan tidak sepadan dengan data kami.']);
        }
    }

    public function viewResetPasswordChallenge(Request $request)
    {
        return view('auth.reset-password-challenge');
    }

    public function storeResetPasswordChallenge(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:6',
        ]);

        $no_kad_pengenalan = session('no_kad_pengenalan');

        if (!$no_kad_pengenalan) {
            return redirect()->route('password.challenge')->withErrors(['error' => 'Sesi telah tamat tempoh. Sila cuba sekali lagi.']);
        }

        $user = User::where('no_kp', $no_kad_pengenalan)->first();

        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();

            session()->forget('no_kad_pengenalan'); // Clear the session data

            return redirect()->route('login')->with('success', 'Set semula kata laluan berjaya. Anda kini boleh log masuk dengan kata laluan baru anda.');
        } else {
            return back()->withErrors(['error' => 'User not found.']);
        }
    }
}
