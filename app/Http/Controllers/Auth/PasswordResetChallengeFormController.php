<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\Klien;
use App\Models\User;
use App\Models\Negeri;
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
            'negeri_lahir' => 'required',
            'nama_ibu' => 'required'
        ]);

        // Retrieve user's details
        $klien = Klien::where('no_kp', session('no_kp'))->first();
        $waris = WarisKlien::where('klien_id', $klien->id)->first();

        if ($klien) {
            // Extract state code from IC number
            $state_code = substr($klien->no_kp, 6, 2);

            // Find the state from the database
            $state = Negeri::where('kod_negeri', $state_code)->first();

            // Validate the inputs
            $isNegeriLahirValid = strtoupper($state->negeri) === strtoupper($request->negeri_lahir);
            $isNamaWarisValid = strtoupper($waris->nama_ibu) === strtoupper($request->nama_ibu);

            if ($isNegeriLahirValid && $isNamaWarisValid) {
                // Store the no_kad_pengenalan in the session
                session(['no_kp' => $klien->no_kp]);
                return redirect()->route('reset.password.challenge');
            }
            else {
                return back()->withErrors([
                    'negeri_lahir' => 'Jawapan tidak sepadan dengan data kami.',
                    'nama_ibu' => 'Jawapan tidak sepadan dengan data kami.'
                ]);
            }
        } else {
            return back()->withErrors(['no_kp' => 'No kad pengenalan tidak wujud.']);
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
            return redirect()->route('password.challenge')->withErrors(['errors' => 'Sesi telah tamat tempoh. Sila cuba sekali lagi.']);
        }

        $user = User::where('no_kp', $no_kad_pengenalan)->first();

        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();

            session()->forget('no_kad_pengenalan'); // Clear the session data

            return redirect()->route('login')->with('success', 'Set semula kata laluan berjaya. Anda kini boleh log masuk dengan kata laluan baru anda.');
        } else {
            return back()->withErrors(['errors' => 'User not found.']);
        }
    }
}
