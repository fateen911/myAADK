<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\DaftarPengguna;
use App\Models\User;
use App\Models\TahapPengguna;

class PentadbirController extends Controller
{
    public function senaraiPengguna()
    {
        $user = User::all();
        $tahap = TahapPengguna::all()->sortBy('id');

        return view ('pentadbir.pendaftaran.daftar_pengguna', compact('user', 'tahap'));
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
                'password' => Hash::make($request->no_kp),
            ]);

            return redirect()->route('senarai-pengguna')->with('message', 'Data pengguna ' . $request->name . ' telah ada dan telah dikemaskini.');
        } 
    }

    public function daftarPengguna(Request $request)
    {
        $userData = [
                        'name' => strtoupper($request->name),
                        'no_kp' => $request->no_kp,
                        'email' => $request->email,
                        'tahap_pengguna' => $request->tahap_pengguna,
                        'password' => Hash::make($request->no_kp),
                        'profil_pengguna' => null,
                        'status' => '0',
                    ];
        
        $user = User::create($userData);

        $email = $request->email;
        $password = $request->no_kp;
        Mail::to($email)->send(new DaftarPengguna($email, $password));

        // Redirect with a success message
        return redirect()->route('senarai-pengguna')->with('message', 'Emel notifikasi telah dihantar kepada ' . $request->name);
    }


    // public function daftarPengguna(Request $request)
    // {   
    //     $characters = 'abcdef12345!@#$%^&';
    //     $password_length = 12;

    //     // Generate the random password
    //     $password = '';
    //     for ($i = 0; $i < $password_length; $i++) {
    //         $password .= $characters[random_int(0, strlen($characters) - 1)];
    //     }
        
    //     $user = User::where('no_kp', '=', $request->no_kp)->first();

    //     if ($user == null) 
    //     {
    //         $userData = [
    //             'name' => strtoupper($request->name),
    //             'no_kp' => $request->no_kp,
    //             'email' => $request->email,
    //             'tahap_pengguna' => $request->tahap_pengguna,
    //             'password' => Hash::make($request->no_kp),
    //             'profil_pengguna' => null,
    //             'status' => '1',
    //         ];

    //         $user = User::create($userData);

    //         $email = $request->email;
    //         $password = $request->no_kp;
    //         Mail::to($email)->send(new DaftarPengguna($email, $password));
            
    //         return response()->json(['message' => 'Emel notifikasi telah dihantar kepada ' . $request->nama]);
    //     } 
    //     else{
    //         $user->update([
    //             'name' => strtoupper($request->name),
    //             'no_kp' => $request->no_kp,
    //             'email' => $request->email,
    //             'tahap_pengguna' => $request->jawatan,
    //             'password' => Hash::make($request->no_kp),
    //         ]);
            
    //         return response()->json(['message' => 'Data pengguna ' . $request->nama . ' telah ada dan telah dikemaskini.']);
    //     }

    //     return redirect()->route('senarai-pengguna');
    // }

}
