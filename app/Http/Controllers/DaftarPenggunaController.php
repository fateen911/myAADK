<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\DaftarPengguna;
use App\Models\User;
use App\Models\Pegawai;
use App\Models\Negeri;
use App\Models\Daerah;
use App\Models\JawatanAADK;
use App\Models\TahapPengguna;

class DaftarPenggunaController extends Controller
{
    public function senaraiPengguna()
    {
        $klien = User::where('tahap_pengguna', '=' ,'2')->get();
        $pegawai = User::leftJoin('pegawai', 'users.no_kp', '=', 'pegawai.no_kp')
                        ->whereIn('tahap_pengguna', [3, 4, 5])->get();

        $negeri = Negeri::all()->sortBy('negeri');
        $daerah = Daerah::all()->sortBy('daerah');

        $tahap = TahapPengguna::whereIn('id', [3, 4, 5])->get()->sortBy('id');
        $jawatan = JawatanAADK::all();

        return view ('pendaftaran.daftar_pengguna', compact('klien', 'pegawai', 'tahap', 'daerah', 'negeri','jawatan'));
    }

    public function kemaskiniPengguna(Request $request)
    {   
        // Retrieve the user by their ID
        $user = User::find($request->id);

        // Check if the user exists
        if ($user->id) 
        {
            // User exists, update their details
            $user->update([
                'name' => strtoupper($request->name),
                'no_kp' => $request->no_kp,
                'email' => $request->email,
                'tahap_pengguna' => $request->tahap_pengguna,
                'password' => Hash::make($request->password),
            ]);

            return redirect()->route('senarai-pengguna')->with('message', 'Data pengguna ' . $request->name . ' telah ada dan telah dikemaskini.');
        } 
    }

    public function daftarPengguna(Request $request)
    {
        $user = User::where('no_kp', '=', $request->no_kp)->first();

        $password_length = 12;
        $password = $this->generatePassword($password_length);

        if ($user === null) {
            $userData = [
                'name' => strtoupper($request->name),
                'no_kp' => $request->no_kp,
                'email' => $request->email,
                'tahap_pengguna' => $request->tahap_pengguna,
                'password' => Hash::make($password),
                'profil_pengguna' => null,
                'status' => '0',
            ];

            $pegawaiData = [
                'nama' => strtoupper($request->name),
                'no_kp' => $request->no_kp,
                'emel' => $request->email,
                'bahagian' => $request->tahap_pengguna,
                'negeri' => $request->negeri_bertugas,
                'daerah' => $request->daerah_bertugas,
                'jawatan' => $request->jawatan,
            ];

            $user = User::create($userData);
            $pegawai = Pegawai::create($pegawaiData);

            $email = $request->email;
            $no_kp = $request->no_kp;
            Mail::to($email)->send(new DaftarPengguna($email, $password, $no_kp));

            return redirect()->route('senarai-pengguna')->with('message', 'Emel notifikasi telah dihantar kepada ' . $request->name);
        } 
        else {
            return redirect()->route('senarai-pengguna')->with('error', 'Pengguna ' . $request->name . ' telah didaftarkan dalam sistem ini.');
        }
    }

    private function generatePassword($length)
    {
        $lowercase = 'abcdefghijklmnopqrstuvwxyz';
        $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $numbers = '0123456789';
        $symbols = '!@#$%^&*()-_+=<>?';

        $allCharacters = $lowercase . $uppercase . $numbers . $symbols;
        $password = '';

        // Ensure the password contains at least one character from each category
        $password .= $lowercase[random_int(0, strlen($lowercase) - 1)];
        $password .= $uppercase[random_int(0, strlen($uppercase) - 1)];
        $password .= $numbers[random_int(0, strlen($numbers) - 1)];
        $password .= $symbols[random_int(0, strlen($symbols) - 1)];

        // Fill the remaining length of the password with random characters from all categories
        for ($i = 4; $i < $length; $i++) {
            $password .= $allCharacters[random_int(0, strlen($allCharacters) - 1)];
        }

        // Shuffle the password to ensure random order
        return str_shuffle($password);
    }

}
