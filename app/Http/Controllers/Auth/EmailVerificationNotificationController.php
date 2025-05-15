<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    // public function verify(Request $request, $id, $hash)
    // {
    //     //$user = User::find($id);
    //     $user = User::where('no_kp', '=', $id)->first();
    //     // $test=sha1($user->email);

    //     if (!$user || sha1($user->email) !== $hash) {
    //         // Invalid verification link
    //         return redirect('/login')->with('errors', 'Link pengesahan tidak sah.');
    //     }

    //     // Mark the user's email as verified
    //     $user->email_verified_at = now();
    //     $user->save();

    //     // Optionally, show a success message
    //     return redirect('/login')->with('success', 'Emel berjaya disahkan. Anda boleh log masuk sekarang.');
    // }

    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute: false));
        }

        // $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
