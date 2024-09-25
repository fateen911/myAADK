<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Pegawai;
use App\Models\PegawaiMohonDaftar;
use App\Models\Negeri;
use App\Models\Daerah;
use App\Models\DaerahPejabat;
use App\Models\TahapPengguna;
use App\Models\JawatanAADK;
use App\Models\NegeriPejabat;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $negeri = NegeriPejabat::all()->sortBy('negeri');
        $daerah = DaerahPejabat::all()->sortBy('daerah');

        $tahap = TahapPengguna::whereIn('id', [3, 4, 5])->get()->sortBy('id');
        $jawatan = JawatanAADK::all();

        return view('auth.register', compact('tahap', 'daerah', 'negeri','jawatan'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    // public function store(Request $request): RedirectResponse
    // {
    //     try {
    //         // Validate the incoming request
    //         $validatedData = $request->validate([
    //             'nama'          => 'required|string|max:255',
    //             'no_kp'         => 'required|string|max:12',
    //             'emelPegawai'   => 'required|string|email|max:255',
    //             'no_tel'        => 'required|string|max:11',
    //             'jawatan'       => 'required|string',
    //             'peranan'       => 'required|string',
    //             'negeri_bertugas' => 'required_if:peranan,4,5|string', // Required for peranan 4 and 5
    //             'daerah_bertugas' => 'required_if:peranan,5|string', // Required only if peranan is 5
    //         ]);
    //     } 
    //     catch (\Illuminate\Validation\ValidationException $e) {
    //         // Redirect back with custom error message when validation fails
    //         return redirect()->back()->with('error', 'Sila pastikan semua medan bertanda * telah diisi dan format data adalah betul');
    //     }

    //     // Combine email name and domain
    //     $email = $validatedData['emelPegawai'] . '@adk.gov.my';

    //     // Check if the user already exists
    //     $user = User::where('no_kp', $validatedData['no_kp'])->first();
    //     $pegawai = Pegawai::where('no_kp', $validatedData['no_kp'])->first();
    //     $permohonan_pegawai = PegawaiMohonDaftar::where('no_kp', $validatedData['no_kp'])->first();

    //     if ($user === null && $pegawai === null) 
    //     {
    //         // Create the new PegawaiMohonDaftar using the validated data
    //         $pegawaiData = [
    //             'nama' => strtoupper($validatedData['nama']),
    //             'no_kp' => $validatedData['no_kp'],
    //             'emel' => $email,
    //             'no_tel' => $validatedData['no_tel'],
    //             'jawatan' => $validatedData['jawatan'],
    //             'peranan' => $validatedData['peranan'],
    //             'negeri_bertugas' => $validatedData['negeri_bertugas'] ?? null, // Set to null if not provided
    //             'daerah_bertugas' => $validatedData['daerah_bertugas'] ?? null, // Set to null if not provided
    //             'status' => 'Baharu',
    //         ];

    //         $pegawai = PegawaiMohonDaftar::create($pegawaiData);

    //         return redirect()->route('login')->with('success', 'Permohonan mendaftar sebagai pengguna sistem telah dihantar untuk semakan dan keputusan permohonan akan dihantar melalui notifikasi emel.');
    //     } 
    //     else {
    //         return redirect()->route('login')->with('error', 'Pegawai ' . $validatedData['nama'] . ' telah didaftarkan dalam sistem ini.');
    //     }
    // }

    // public function store(Request $request): RedirectResponse
    // {
    //     try {
    //         // Validate the incoming request
    //         $validatedData = $request->validate([
    //             'nama'          => 'required|string|max:255',
    //             'no_kp'         => 'required|string|max:12',
    //             'emelPegawai'   => 'required|string|email|max:255',
    //             'no_tel'        => 'required|string|max:11',
    //             'jawatan'       => 'required|string',
    //             'peranan'       => 'required|string',
    //             'negeri_bertugas' => 'required_if:peranan,4,5|string', // Required for peranan 4 and 5
    //             'daerah_bertugas' => 'required_if:peranan,5|string', // Required only if peranan is 5
    //         ]);
    //     } 
    //     catch (\Illuminate\Validation\ValidationException $e) {
    //         // Redirect back with custom error message when validation fails
    //         return redirect()->back()->with('error', 'Sila pastikan semua medan bertanda * telah diisi dan format data adalah betul');
    //     }

    //     // Combine email name and domain
    //     $email = $request->emelPegawai . '@adk.gov.my';
        
    //     // Check if the user already exists
    //     $user = User::where('no_kp', '=', $request->no_kp)->first();
    //     $pegawai = Pegawai::where('no_kp', '=', $request->no_kp)->first();
    //     $permohonan_pegawai = PegawaiMohonDaftar::where('no_kp', '=', $request->no_kp)->first();

    //     if ($user === null && $pegawai === null) 
    //     {
    //         $pegawaiData = [
    //             'nama' => strtoupper($request->nama),
    //             'no_kp' => $request->no_kp,
    //             'emel' => $email,
    //             'no_tel' => $request->no_tel,
    //             'jawatan' => $request->jawatan,
    //             'peranan' => $request->peranan,
    //             'negeri_bertugas' => $request->negeri_bertugas,
    //             'daerah_bertugas' => $request->daerah_bertugas,
    //             'status' => 'Baharu',
    //         ];

    //         $pegawai = PegawaiMohonDaftar::create($pegawaiData);

    //         return redirect()->route('login')->with('success', 'Permohonan mendaftar sebagai pengguna sistem telah dihantar untuk semakan dan keputusan permohonan akan dihantar melalui notifikasi emel.');
    //     } 
    //     else {
    //         return redirect()->route('login')->with('error', 'Pegawai ' . $request->nama . ' telah didaftarkan dalam sistem ini.');
    //     }
    // }

    public function store(Request $request): RedirectResponse
    {
        // Combine email name and domain
        $email = $request->emelPegawai . '@adk.gov.my';
        
        // Check if the user already exists
        $user = User::where('no_kp', '=', $request->no_kp)->first();
        $pegawai = Pegawai::where('no_kp', '=', $request->no_kp)->first();
        $permohonan_pegawai = PegawaiMohonDaftar::where('no_kp', '=', $request->no_kp)->first();

        if ($user === null && $pegawai === null) 
        {
            $pegawaiData = [
                'nama' => strtoupper($request->nama),
                'no_kp' => $request->no_kp,
                'emel' => $email,
                'no_tel' => $request->no_tel,
                'jawatan' => $request->jawatan,
                'peranan' => $request->peranan,
                'negeri_bertugas' => $request->negeri_bertugas,
                'daerah_bertugas' => $request->daerah_bertugas,
                'status' => 'Baharu',
            ];

            $pegawai = PegawaiMohonDaftar::create($pegawaiData);

            return redirect()->route('login')->with('success', 'Permohonan mendaftar sebagai pengguna sistem telah dihantar untuk semakan dan keputusan permohonan akan dihantar melalui notifikasi emel.');
        } 
        else {
            return redirect()->route('login')->with('error', 'Pegawai ' . $request->nama . ' telah didaftarkan dalam sistem ini.');
        }
    }
}
