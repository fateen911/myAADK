<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
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
        } else {
            $passwordRules[] = Password::min(12)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols();
        }
    
        // Validate the current password
        try {
            $request->validate([
                'current_password' => ['required', 'current_password'],
            ]);
        } catch (ValidationException $e) {
            return redirect()->back()->with('passwordError', 'Kata Laluan Semasa Salah.');
        }
    
        // Check if the current password is the same as the new password
        if (Hash::check($request->input('password'), $request->user()->password)) {
            return redirect()->back()->with('passwordSame', 'Kata Laluan Baharu tidak boleh sama dengan Kata Laluan Semasa.');
        }
    
        // Validate the new password
        try {
            $validated = $request->validateWithBag('updatePassword', [
                'password' => $passwordRules,
            ]);
        } catch (ValidationException $e) {
            return redirect()->back()->with('passwordError', 'Kata Laluan Baharu tidak memenuhi syarat yang ditetapkan.');
        }
    
        // Attempt to update the user's password
        $updateStatus = $request->user()->update([
            'password' => Hash::make($validated['password']),
            'status' => 1,
        ]);
    
        // Check if the password was updated successfully
        if ($updateStatus) {
            return redirect()->route('dashboard')->with('success', 'Kata Laluan Anda telah Berjaya Dikemaskini!');
        } else {
            return redirect()->back()->with('passwordError', 'Terdapat ralat semasa mengemaskini kata laluan anda. Sila cuba lagi.');
        }
    }
}
