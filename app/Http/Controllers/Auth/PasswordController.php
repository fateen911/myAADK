<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $tahapPengguna = $request->user()->tahap_pengguna;

        // Define password validation rules based on tahap pengguna
        $passwordRules = ['required', 'confirmed'];

        if ($tahapPengguna == 2) {
            $passwordRules[] = Password::min(6)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols();
        } 
        else {
            $passwordRules[] = Password::min(12)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols();
        }

        // dd($passwordRules);

        // Validate the request
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => $passwordRules,
        ]);

        // dd($passwordRules);

        // Attempt to update the user's password
        $updateStatus = $request->user()->update([
            'password' => Hash::make($validated['password']),
            'status' => 1,
        ]);

        // Check if the password was updated successfully
        if ($updateStatus) {
            return redirect()->route('dashboard')->with('success', 'Kata Laluan Anda telah Berjaya Dikemaskini!');
        } 
        else {
            return view('profile.update_password')->with('passwordUpdateError', 'Terdapat ralat semasa mengemaskini kata laluan anda. Sila cuba lagi.');
        }
    }

    // public function update(Request $request): RedirectResponse
    // {
    //     $validated = $request->validateWithBag('updatePassword', [
    //         'current_password' => ['required', 'current_password'],
    //         'password' => ['required', Password::defaults(), 'confirmed'],
    //     ]);

    //     $request->user()->update([
    //         'password' => Hash::make($validated['password']),
    //         'status' => 1,
    //     ]);

    //     return back()->with('success', 'Kata Laluan Anda telah Berjaya Dikemaskini!');
    // }
}
