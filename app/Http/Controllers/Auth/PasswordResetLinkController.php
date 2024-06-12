<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\SetSemulaKataLaluan;
use App\Models\User;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    public function getEmail($no_kp)
    {
        // Retrieve the user by 'no_kp'
        $user = User::where('no_kp', $no_kp)->first();

        // Check if user exists and get the email
        if ($user) {
            $email = $user->email;
            $success = true;
        } else {
            $email = null;
            $success = false;
        }
        
        // Return JSON response with success flag and email data
        return response()->json(['success' => $success, 'email' => $email]);
    }


    public function store(Request $request)
    {
        $user = User::where('no_kp', $request->no_kp)->first();
        $jenis_pengguna = $user->tahap_pengguna;

        if ($jenis_pengguna != 2) {
            $emel = $user->email;

            if ($emel) {
                $token = Str::random(64); // Generate a unique token
                DB::table('password_resets')->insert([
                    'email' => $emel,
                    'token' => $token,
                    'created_at' => now(),
                ]);

                $resetLink = route('password.reset', ['token' => $token]);

                // Send the email with the reset link and token
                Mail::to($emel)->send(new SetSemulaKataLaluan($token));
                return redirect()->back()->with('success', 'E-mel tetapan semula kata laluan telah berjaya dihantar.');
            } else {
                return redirect()->back()->with('failed', 'E-mel pengguna tersebut tidak dijumpai dalam sistem.');
            }
        } else {
            return view('auth.challenge-form');
        }
    }
}
