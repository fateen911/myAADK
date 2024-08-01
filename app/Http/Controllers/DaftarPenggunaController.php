<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\URL;
use App\Mail\DaftarPengguna;
use App\Mail\PegawaiApproved;
use App\Mail\PegawaiRejected;
use App\Models\User;
use App\Models\Pegawai;
use App\Models\Negeri;
use App\Models\Daerah;
use App\Models\JawatanAADK;
use App\Models\PegawaiMohonDaftar;
use App\Models\TahapPengguna;

class DaftarPenggunaController extends Controller
{
    public function senaraiPengguna()
    {
        $klien = User::where('tahap_pengguna', '=' ,'2')->get();
        $pegawai = User::leftJoin('pegawai', 'users.no_kp', '=', 'pegawai.no_kp')
                        ->whereIn('tahap_pengguna', [3, 4, 5])->get();
        $permohonan_pegawai = PegawaiMohonDaftar::where('status','Baharu')->get();

        $negeri = Negeri::all()->sortBy('negeri');
        $daerah = Daerah::all()->sortBy('daerah');

        $tahap = TahapPengguna::whereIn('id', [3, 4, 5])->get()->sortBy('id');
        $jawatan = JawatanAADK::all();

        return view ('pendaftaran.daftar_pengguna', compact('klien', 'pegawai', 'permohonan_pegawai', 'tahap', 'daerah', 'negeri','jawatan'));
    }

    public function kemaskiniKlien(Request $request)
    {
        // Retrieve the user by their ID
        $user = User::find($request->id);

        if ($user) 
        {
            // Prepare the data for update
            $updateData = [
                'name' => strtoupper($request->name),
                'no_kp' => $request->no_kp,
                'email' => $request->email,
            ];

            // Check if a new password has been provided
            if ($request->filled('password')) {
                $updateData['password'] = Hash::make($request->password);
            }

            // Update user details
            $user->update($updateData);

            return redirect()->route('senarai-pengguna')->with('message', 'Data pengguna ' . $request->name . ' telah dikemaskini.');
        } 

        return redirect()->route('senarai-pengguna')->with('error', 'Pengguna tidak wujud.');
    }

    public function kemaskiniPegawai(Request $request)
    {
        // Combine email name and domain
        $email = $request->emel . '@adk.gov.my';

        // Retrieve pegawai info
        $pegawai = Pegawai::find($request->id);
        $user = User::where('id', $pegawai->users_id)->first();

        if ($user && $pegawai) 
        {
            // Prepare the data for update in table users
            $updateDataUsers = [
                'name' => strtoupper($request->nama),
                'no_kp' => $request->no_kp,
                'email' => $email,
                'tahap_pengguna' => $request->tahap_pengguna,
            ];

            // Check if a new password has been provided
            if ($request->filled('password')) {
                $updateDataUsers['password'] = Hash::make($request->password);
            }

            // Update user details
            $user->update($updateDataUsers);

            // Prepare the data for update in table pegawai
            $updateDataPegawai = [
                'nama' => strtoupper($request->nama),
                'no_kp' => $request->no_kp,
                'emel' => $email,
                'no_tel' => $request->no_tel,
                'jawatan' => $request->jawatan,
                'peranan' => $request->tahap_pengguna,
                'negeri_bertugas' => $request->negeri_bertugas,
                'daerah_bertugas' => $request->daerah_bertugas,
            ];

            // Update pegawai details
            $pegawai->update($updateDataPegawai);

            return redirect()->route('senarai-pengguna')->with('message', 'Data pengguna ' . $request->nama . ' telah dikemaskini.');
        } 

        return redirect()->route('senarai-pengguna')->with('error', 'Pengguna tidak wujud.');
    }

    public function daftarPengguna(Request $request)
    {
        // Combine email name and domain
        $email = $request->emailPegawai . '@adk.gov.my';
        
        // Check if the user already exists
        $user = User::where('no_kp', '=', $request->no_kp)->first();
        $pegawai = Pegawai::where('no_kp', '=', $request->no_kp)->first();

        $password_length = 12;
        $password = $this->generatePassword($password_length);

        if ($user === null || $pegawai === null) {
            $userData = [
                'name' => strtoupper($request->name),
                'no_kp' => $request->no_kp,
                'email' => $email,
                'tahap_pengguna' => $request->peranan_pegawai,
                'password' => Hash::make($password),
                'profil_pengguna' => null,
                'status' => '0',
            ];

            $user = User::create($userData);

            $pegawaiData = [
                'users_id' => $user->id,
                'nama' => strtoupper($request->name),
                'no_kp' => $request->no_kp,
                'emel' => $email,
                'no_tel' => $request->no_tel,
                'jawatan' => $request->jawatan,
                'peranan' => $request->peranan_pegawai,
                'negeri_bertugas' => $request->daftar_negeri_bertugas,
                'daerah_bertugas' => $request->daftar_daerah_bertugas,
            ];

            $pegawai = Pegawai::create($pegawaiData);

            // Generate the email verification URL
            event(new Registered($user));
            $verificationUrl = URL::temporarySignedRoute(
                'verification.verify',
                now()->addMinutes(60),
                ['id' => $user->id, 'hash' => sha1($user->email)]
            );

            $defaultEmail = 'fateenashuha2000@gmail.com';

            Mail::to($defaultEmail)->send(new DaftarPengguna($defaultEmail, $password, $request->no_kp, $verificationUrl));
            // Mail::to($email)->send(new DaftarPengguna($email, $password, $request->no_kp));

            return redirect()->route('senarai-pengguna')->with('message', 'Emel notifikasi maklumat akaun pengguna telah dihantar kepada ' . $request->name);
        } 
        else {
            return redirect()->route('senarai-pengguna')->with('error', 'Pengguna ' . $request->name . ' telah didaftarkan dalam sistem ini.');
        }
    }

    public function permohonanPegawai(Request $request, $id)
    {
        // Combine email name and domain
        $email = $request->emailPegawai . '@adk.gov.my';

        // Fetch keputusan permohonan
        $keputusan = $request->input('status');

        // Fetch the staff request data
        $pegawaiBaharu = PegawaiMohonDaftar::where('id', $id)->firstOrFail();

        if ($keputusan == 'Lulus') {
            // Generate a random password
            $password_length = 12;
            $password = $this->generatePassword($password_length);

            // Store user information in users table
            $user = new User();
            $user->name = $pegawaiBaharu->nama;
            $user->no_kp = $pegawaiBaharu->no_kp;
            $user->email = $email;
            $user->password = bcrypt($password);
            $user->tahap_pengguna = $pegawaiBaharu->peranan;
            $user->status = '0';
            $user->save();

            // Store additional staff information in pegawai table
            $pegawai = new Pegawai();
            $pegawai->users_id = $user->id;
            $pegawai->no_kp = $pegawaiBaharu->no_kp;
            $pegawai->nama = $pegawaiBaharu->nama;
            $pegawai->emel = $email;
            $pegawai->no_tel = $pegawaiBaharu->no_tel;
            $pegawai->jawatan = $pegawaiBaharu->jawatan;
            $pegawai->peranan = $pegawaiBaharu->peranan;
            $pegawai->negeri_bertugas = $pegawaiBaharu->negeri_bertugas;
            $pegawai->daerah_bertugas = $pegawaiBaharu->daerah_bertugas;
            $pegawai->save();

            // Update the status in pegawai_mohon_daftar table
            $pegawaiBaharu->status = 'Lulus';
            $pegawaiBaharu->save();

            // Generate the email verification URL
            event(new Registered($user));
            $verificationUrl = URL::temporarySignedRoute(
                'verification.verify',
                now()->addMinutes(60),
                ['id' => $user->id, 'hash' => sha1($user->email)]
            );

            // Send notification email to the staff
            Mail::to($email)->send(new PegawaiApproved($pegawaiBaharu, $password, $verificationUrl));
            return redirect()->back()->with('message', 'Pegawai ' . $pegawaiBaharu->nama . ' telah berjaya didaftarkan sebagai pengguna sistem ini.');
        } 
        elseif ($keputusan == 'Ditolak') {
            // Update the status in pegawai_mohon_daftar table
            $pegawaiBaharu->status = 'Ditolak';
            $pegawaiBaharu->save();

            // Send rejection email to the staff
            Mail::to($email)->send(new PegawaiRejected($pegawaiBaharu));
            return redirect()->route('senarai-pengguna')->with('error', 'Pengguna ' . $pegawaiBaharu->nama . ' gagal untuk didaftarkan sebagai pengguna sistem ini.');
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
