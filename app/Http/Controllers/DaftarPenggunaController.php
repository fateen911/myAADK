<?php

namespace App\Http\Controllers;

use App\Mail\DaftarKlien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use App\Mail\DaftarPegawai;
use App\Mail\PegawaiApproved;
use App\Mail\PegawaiRejected;
use App\Mail\KemaskiniKataLaluan;
use App\Models\Daerah;
use App\Models\User;
use App\Models\Klien;
use App\Models\WarisKlien;
use App\Models\PekerjaanKlien;
use App\Models\KeluargaKlien;
use App\Models\Pegawai;
use App\Models\NegeriPejabat;
use App\Models\DaerahPejabat;
use App\Models\JawatanAADK;
use App\Models\PegawaiMohonDaftar;
use App\Models\TahapPengguna;
use App\Models\NotifikasiPegawaiDaerah;
use App\Models\KlienView;
use App\Models\KerjaView;
use App\Models\WarisView;
use App\Models\FamiliView;
use App\Models\Negeri;
use App\Models\RawatanKlien;
use App\Models\viewfamililocal;
use App\Models\viewkerjalocal;
use App\Models\viewklienlocal;
use App\Models\viewwarislocal;
use Yajra\DataTables\Facades\DataTables;

class DaftarPenggunaController extends Controller
{
    // 1) PEGAWAI DAERAH
    public function senaraiDaftarKlien(Request $request)
    {
        $pegawai = Auth::user();
        $pegawaiDaerah = Pegawai::where('users_id', $pegawai->id)->first();

        // Fetch notifications for daerah_aadk_lama
        $notificationsLama = NotifikasiPegawaiDaerah::where('daerah_aadk_lama', $pegawaiDaerah->daerah_bertugas)
            ->select('id', 'message1', 'created_at', 'is_read1')
            ->get();

        // Fetch notifications for daerah_aadk_baru
        $notificationsBaru = NotifikasiPegawaiDaerah::where('daerah_aadk_baru', $pegawaiDaerah->daerah_bertugas)
            ->select('id', 'message2', 'created_at', 'is_read2')
            ->get();

        // Merge and sort notifications
        $notifications = $notificationsLama->merge($notificationsBaru)->sortByDesc('created_at')->values();

        // Count unread notifications
        $unreadCountPD = NotifikasiPegawaiDaerah::where(function ($query) use ($pegawaiDaerah) {
            $query->where(function ($subQuery) use ($pegawaiDaerah) {
                $subQuery->where('daerah_aadk_lama', $pegawaiDaerah->daerah_bertugas)
                        ->where('is_read1', false);
            })->orWhere(function ($subQuery) use ($pegawaiDaerah) {
                $subQuery->where('daerah_aadk_baru', $pegawaiDaerah->daerah_bertugas)
                        ->where('is_read2', false);
            });
        })->count();

        return view('pendaftaran.pegawai_daerah.daftar_klien', compact( 'notifications', 'unreadCountPD'));
    }

    public function getDataKlienDaerah(Request $request)
    {
        $pegawai = Auth::user();
        $pegawaiDaerah = Pegawai::where('users_id', $pegawai->id)->first();

        if (!$pegawaiDaerah) {
            return response()->json(['error' => 'Pegawai not found'], 404);
        }

        $query = Klien::leftJoin('users', 'klien.no_kp', '=', 'users.no_kp')
                        ->select('klien.*', 'users.updated_at as user_updated_at')
                        ->where('klien.daerah_pejabat', $pegawaiDaerah->daerah_bertugas)
                        ->orderBy('user_updated_at', 'desc');

        return DataTables::of($query)
            ->addColumn('tarikhDaftar', function ($klien) {
                return $klien->user_updated_at ? \Carbon\Carbon::parse($klien->user_updated_at)->format('d/m/Y') : '';
            })
            ->addColumn('tindakan', function ($klien) {
                return $klien->user_updated_at !== null
                    ? '<a id="kemaskiniKlienModal" class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" data-bs-toggle="modal" data-id="' . $klien->id . '" data-bs-target="#modal_kemaskini_klien">
                            <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Kemaskini">
                                <i class="ki-duotone bi bi-pencil fs-3"></i>
                            </span>
                        </a>'
                    : '<a id="daftarKlienModal" class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" data-bs-toggle="modal" data-id="' . $klien->id . '" data-bs-target="#modal_daftar_klien">
                            <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Daftar">
                                <i class="ki-duotone bi bi-pencil fs-3"></i>
                            </span>
                        </a>';
            })
            ->rawColumns(['tindakan']) // Allow HTML rendering in the 'tindakan' column
            ->make(true);
    }

    public function modalKemaskiniKlienDaerah($id)
    {
        $klien = Klien::find($id);
        return view('pendaftaran.pegawai_daerah.modal_kemaskini_klien', compact('klien'));
    }

    public function pegawaiKemaskiniKlien(Request $request)
    {
        // Retrieve the user by their ID
        $user = User::where('no_kp', $request->no_kp)->first();

        // Retrieve the corresponding Klien record by no_kp
        $klien = Klien::where('no_kp', $request->no_kp)->first();

        // Check if klien already registered or not
        if ($user) {
            // Prepare update data for users table
            $updateData = [
                'email' => $request->email,
                'updated_at' => now(),
            ];

            // Check if a new password has been generated
            if ($request->filled('passwordKemaskini')) {
                $updateData['password'] = Hash::make($request->passwordKemaskini);
            }

            // Update user in the users table
            $user->update($updateData);

            // Disable timestamps temporarily
            $klien->timestamps = false;

            // Check if the Klien exists and update the no_tel and email in the klien table
            if ($klien) {
                $klien->update([
                    'no_tel' => $request->no_tel,
                    'emel' => $request->email,
                ]);
            }

            // Send email notification if the user has an email and a new password was set
            if ($user->email && $request->filled('passwordKemaskini')) {
                Mail::to($user->email)->send(new KemaskiniKataLaluan($user->email, $request->passwordKemaskini, $user->no_kp));
                return redirect()->route('daftar-klien')->with('message', 'Maklumat akaun klien ' . $request->name . ' telah berjaya dikemaskini. Notifikasi e-mel telah dihantar kepada klien.');
            }

            return redirect()->route('daftar-klien')->with('message', 'Maklumat akaun klien ' . $request->name . ' telah berjaya dikemaskini.');
        } else {
            return redirect()->route('daftar-klien')->with('warning', 'Maklumat akaun klien belum didaftarkan ke dalam sistem.');
        }
    }

    // TEST SEMAK IC
    public function semakKpDaerah(Request $request)
    {
        $no_kp = $request->input('no_kp');
        $pegawai = Auth::user(); 
        $pegawaiDaerah = Pegawai::where('users_id', $pegawai->id)->first(); 

        // SERVER
        // $klienView = KlienView::where('mykad', $no_kp)->first();

        // LOCAL
        $klienView = viewklienlocal::where('mykad', $no_kp)->first();

        // Step 1: Check if client exists in view
        if (!$klienView) {
            return redirect()->back()->with('not-exists', 'No kad pengenalan tersebut tidak dibenarkan untuk mendaftar sebagai pengguna sistem ini');
        }

        // Step 2: Check if already registered
        $user = User::where('no_kp', $no_kp)->first();
        if ($user) {
            return redirect()->back()->with('registered', 'Klien sudah mendaftar sebagai pengguna sistem ini.');
        }

        // Step 3: Check if klien berada di bawah pengawasan pegawai daerah
        if ($klienView->id_fasiliti != $pegawaiDaerah->daerah_bertugas) {
            return redirect()->back()->with('unauthorized', 'Klien bukan berada di bawah pengawasan anda.');
        }
        else{
            // Step 4: Store data in session
            session([
                'no_kp' => $no_kp,
                'klien_view' => (object)[
                    'nama' => $klienView->nama,
                    'no_tel' => $klienView->telefon,
                    'email' => $klienView->emel,
                ]
            ]);

            return redirect()->back()->with('exists', 'Data berjaya dijumpai. Sila klik "Daftar" untuk mendaftar klien ini.');
        }
    }

    public function modalDaftarKlienDaerah($id)
    {
        // SERVER
        // $klien = KlienView::where('mykad', $id)->first();

        // DB LOCAL
        $klien = viewklienlocal::where('mykad', $id)->first();
        
        return view('pendaftaran.pegawai_daerah.modal_daftar_klien', compact('klien'));
    }

    public function pegawaiDaftarKlien(Request $request)
    {
        // Retrieve the user by their ID
        $user = User::where('no_kp', $request->no_kp)->first();

        // Retrieve the corresponding Klien record by no_kp
        $klien = Klien::where('no_kp', $request->no_kp)->first();

        // Check if a password has been provided
        if (!$request->filled('passwordDaftar')) {
            return redirect()->back()->with('error', 'Klien belum didaftarkan sebagai pengguna sistem. Sila jana kata laluan terlebih dahulu untuk mendaftarkan klien.');
        }
        else
        {
            $createData = [
                'name' => strtoupper($request->name),
                'no_kp' => $request->no_kp,
                'email' => $request->email,
                'tahap_pengguna' => 2,
                'status' => 0,
                'password' => Hash::make($request->passwordDaftar),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Create the new user
            $user = User::create($createData);

            // Disable timestamps temporarily
            $klien->timestamps = false;

            // Update in table klien
            $klien->update([
                'no_tel' => $request->no_tel,
                'emel' => $request->email,
            ]);

            // Update created_at for WarisKlien, KeluargaKlien, and PekerjaanKlien where klien_id matches
            WarisKlien::where('klien_id', $klien->id)->update(['created_at' => now()]);
            KeluargaKlien::where('klien_id', $klien->id)->update(['created_at' => now()]);
            PekerjaanKlien::where('klien_id', $klien->id)->update(['created_at' => now()]);

            if ($request->email)
            {
                Mail::to(users: $user->email)->send(new DaftarKlien($user, $request->passwordDaftar));
                return redirect()->route('daftar-klien')->with('success', 'Klien telah berjaya didaftarkan sebagai pengguna sistem. Notifikasi e-mel telah dihantar kepada klien.');
            }
            else{
                return redirect()->route('daftar-klien')->with('success', 'Klien telah berjaya didaftarkan sebagai pengguna sistem.');
            }
        }
    }

    // 2) PENTADBIR
    public function senaraiPengguna()
    {
        $negeri = NegeriPejabat::all()->sortBy('negeri');
        $daerah = DaerahPejabat::all()->sortBy('daerah');

        $tahap = TahapPengguna::whereIn('id', [3, 4, 5])->get()->sortBy('id');
        $jawatan = JawatanAADK::all();

        return view('pendaftaran.pentadbir.daftar_pengguna', compact('tahap', 'daerah', 'negeri','jawatan'));
    }

    // AJAX SENARAI PEGAWAI & KLIEN
    public function getDataKlien(Request $request)
    {
        $query = Klien::leftJoin('users', 'klien.no_kp', '=', 'users.no_kp')
                        ->select('klien.*', 'users.updated_at as user_updated_at')
                        ->orderBy('user_updated_at', 'desc');

        return DataTables::of($query)
            ->addColumn('tarikhDaftar', function ($klien) {
                return $klien->user_updated_at ? \Carbon\Carbon::parse($klien->user_updated_at)->format('d/m/Y') : '';
            })
            ->addColumn('tindakan', function ($klien) {
                return $klien->user_updated_at !== null
                    ? '<a id="kemaskiniKlienModal" class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" data-bs-toggle="modal" data-id="' . $klien->id . '" data-bs-target="#modal_kemaskini_klien">
                            <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Kemaskini">
                                <i class="ki-duotone bi bi-pencil fs-3"></i>
                            </span>
                        </a>'
                    : '<a id="daftarKlienModal" class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" data-bs-toggle="modal" data-id="' . $klien->id . '" data-bs-target="#modal_daftar_klien">
                            <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Daftar">
                                <i class="ki-duotone bi bi-pencil fs-3"></i>
                            </span>
                        </a>';
            })
            ->rawColumns(['tindakan']) // Allow HTML rendering in the 'tindakan' column
            ->make(true);
    }

    public function getDataPegawai()
    {
        $query = User::leftJoin('pegawai', 'users.no_kp', '=', 'pegawai.no_kp')
                    ->leftJoin('tahap_pengguna', 'users.tahap_pengguna', '=', 'tahap_pengguna.id') // Join for Peranan
                    ->leftJoin('senarai_negeri_pejabat', 'pegawai.negeri_bertugas', '=', 'senarai_negeri_pejabat.negeri_id') // Join for Negeri
                    ->leftJoin('senarai_daerah_pejabat', 'pegawai.daerah_bertugas', '=', 'senarai_daerah_pejabat.kod') // Join for Daerah
                    ->select([
                        'users.*',
                        'pegawai.id as pegawai_id',
                        'tahap_pengguna.peranan',
                        'senarai_negeri_pejabat.negeri as negeri_bertugas',
                        'senarai_daerah_pejabat.daerah as daerah_bertugas'
                    ])
                    ->whereIn('tahap_pengguna.id', [3, 4, 5])
                    ->orderBy('users.updated_at', 'desc');

        if ($query->count() == 0) {
            return response()->json(['data' => []]); // Ensure empty response when no records exist
        }
    
        return DataTables::of($query)->make(true);
    }

    public function getDataPermohonanPegawai()
    {
        $query = PegawaiMohonDaftar::where('status', 'Baharu')
                    ->leftJoin('tahap_pengguna', 'pegawai_mohon_daftar.peranan', '=', 'tahap_pengguna.id') // Join for Peranan
                    ->leftJoin('senarai_negeri_pejabat', 'pegawai_mohon_daftar.negeri_bertugas', '=', 'senarai_negeri_pejabat.negeri_id') // Join for Negeri
                    ->leftJoin('senarai_daerah_pejabat', 'pegawai_mohon_daftar.daerah_bertugas', '=', 'senarai_daerah_pejabat.kod') // Join for Daerah
                    ->select(
                        'pegawai_mohon_daftar.id',
                        'pegawai_mohon_daftar.nama',
                        'pegawai_mohon_daftar.no_kp',
                        'pegawai_mohon_daftar.emel',
                        'senarai_negeri_pejabat.negeri as negeri_bertugas',
                        'senarai_daerah_pejabat.daerah as daerah_bertugas',
                        'tahap_pengguna.peranan as peranan'
                    )
                    ->orderBy('pegawai_mohon_daftar.updated_at', 'desc');
        
        if ($query->count() == 0) {
            return response()->json(['data' => []]); // Ensure empty response when no records exist
        }
    
        return DataTables::of($query)->make(true);
    }

    // DAFTAR / KEMASKINI PEGAWAI & KLIEN
    public function modalKemaskiniKlien($id)
    {
        $klien = Klien::find($id);
        return view('pendaftaran.pentadbir.modal_kemaskini_klien', compact('klien'));
    }

    public function pentadbirKemaskiniKlien(Request $request)
    {
        // Retrieve the user by their ID
        $user = User::where('no_kp', $request->no_kp)->first();

        // Retrieve the corresponding Klien record by no_kp
        $klien = Klien::where('no_kp', $request->no_kp)->first();

        // Check if klien already registered or not
        if ($user) {
            // Prepare update data
            $updateData = [
                'email' => $request->email,
                'acc_status' => $request->status_ak,
                'updated_at' => now(),
            ];

            // Include password if `passwordKemaskini` is provided
            if ($request->filled('passwordKemaskini')) {
                $updateData['password'] = Hash::make($request->passwordKemaskini);
            }

            // Update user with the new data
            $user->update($updateData);

            // Disable timestamps temporarily
            $klien->timestamps = false;

            // Update Klien if exists
            if ($klien) {
                $klien->update([
                    'no_tel' => $request->no_tel,
                    'emel' => $request->email,
                ]);
            }

            // Send email notification if the user has an email and passwordKemaskini is filled
            if ($user->email && $request->filled('passwordKemaskini')) {
                Mail::to($user->email)->send(new KemaskiniKataLaluan($user->email, $request->passwordKemaskini, $user->no_kp));
                return redirect()->route('senarai-pengguna')->with('message', 'Maklumat akaun klien ' . $request->name . ' telah berjaya dikemaskini. Notifikasi e-mel telah dihantar kepada klien.');
            }
            else{
                return redirect()->route('senarai-pengguna')->with('message', 'Maklumat akaun klien ' . $request->name . ' telah berjaya dikemaskini.');
            }
        }
        else {
            return redirect()->route('senarai-pengguna')->with('warning', 'Maklumat akaun klien belum didaftarkan ke dalam sistem.');
        }
    }
    
    public function modalKemaskiniPegawai($id)
    {
        $pegawai = Pegawai::find($id);
        $negeri = NegeriPejabat::all()->sortBy('negeri');
        $daerah = DaerahPejabat::all()->sortBy('daerah');
        $tahap = TahapPengguna::whereIn('id', [3, 4, 5])->get()->sortBy('id');
        $jawatan = JawatanAADK::all();

        return view('pendaftaran.pentadbir.modal_kemaskini_pegawai', compact('pegawai','negeri','daerah','tahap','jawatan'));
    }

    public function kemaskiniPegawai(Request $request)
    {
        // Combine email name and domain
        $email = $request->emel . '@aadk.gov.my';

        // Retrieve pegawai info
        $pegawai = Pegawai::find($request->id);
        $user = User::where('id', $pegawai->users_id)->first();

        if ($user && $pegawai) {
            // Prepare the data for update in table users
            $updateDataUsers = [
                'name' => strtoupper($request->nama),
                'no_kp' => $request->no_kp,
                'email' => $email,
                'tahap_pengguna' => $request->tahap_pengguna,
                'acc_status' => $request->status_ak,
                'updated_at' => now(),
            ];

            // Check if a new password has been provided
            if ($request->filled('password')) {
                $updateDataUsers['password'] = Hash::make($request->password);
            }

            // Update user details
            $user->update($updateDataUsers);

            // Send email notification if password was updated and user has an email
            if ($request->filled('password') && $user->email) {
                Mail::to($user->email)->send(new KemaskiniKataLaluan($user->email, $request->password, $user->no_kp));
            }

            // Prepare the data for update in table pegawai
            $updateDataPegawai = [
                'nama' => strtoupper($request->nama),
                'no_kp' => $request->no_kp,
                'emel' => $email,
                'no_tel' => $request->no_tel,
                'jawatan' => $request->jawatan,
                'peranan' => $request->tahap_pengguna,
                'updated_at' => now(),
            ];

            // Update `negeri_bertugas` and `daerah_bertugas` based on `tahap_pengguna`
            if ($request->tahap_pengguna == 3) {
                // If tahap_pengguna is 3, set both to null
                $updateDataPegawai['negeri_bertugas'] = null;
                $updateDataPegawai['daerah_bertugas'] = null;
            } elseif ($request->tahap_pengguna == 4) {
                // If tahap_pengguna is 4, set daerah_bertugas to null, keep negeri_bertugas from request
                $updateDataPegawai['negeri_bertugas'] = $request->negeri_bertugas;
                $updateDataPegawai['daerah_bertugas'] = null;
            } elseif ($request->tahap_pengguna == 5) {
                // If tahap_pengguna is 5, use both negeri_bertugas and daerah_bertugas from request
                $updateDataPegawai['negeri_bertugas'] = $request->negeri_bertugas;
                $updateDataPegawai['daerah_bertugas'] = $request->daerah_bertugas;
            }

            // Update pegawai details
            $pegawai->update($updateDataPegawai);

            return redirect()->route('senarai-pengguna')->with('message', 'Akaun pegawai ' . $request->nama . ' telah berjaya dikemaskini.');
        }

        return redirect()->route('senarai-pengguna')->with('error', 'Pengguna tidak wujud.');
    }

    public function modalPermohonanPegawai($id)
    {
        $permohonan_pegawai = PegawaiMohonDaftar::find($id);

        $negeri = NegeriPejabat::all()->sortBy('negeri');
        $daerah = DaerahPejabat::all()->sortBy('daerah');
        $tahap = TahapPengguna::whereIn('id', [3, 4, 5])->get()->sortBy('id');
        $jawatan = JawatanAADK::all();

        return view('pendaftaran.pentadbir.modal_permohonan_pegawai', compact('permohonan_pegawai','negeri','daerah','tahap','jawatan'));
    }

    public function permohonanPegawaiLulus(Request $request, $id)
    {
        // Add server-side validation for input fields
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'no_kp' => 'required|string|max:12',  // Must be exactly 12 digits
            'emelPegawai' => 'required|string',
            'no_tel' => 'nullable|string|max:11',  // Not more than 11 digits
            'jawatan' => 'required|string',
            'peranan_pengguna' => 'required|string',
            'negeri_bertugas' => 'nullable|string', // If this can be optional, use nullable
            'daerah_bertugas' => 'nullable|string',
        ]);

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
            $user->name = $validatedData['nama'];
            $user->no_kp = $validatedData['no_kp'];
            $user->email = $validatedData['emelPegawai'] . '@aadk.gov.my';
            $user->password = bcrypt($password);
            $user->tahap_pengguna = $validatedData['peranan_pengguna'];
            $user->status = '0';
            $user->updated_at = now();
            $user->save();

            // Store additional staff information in pegawai table
            $pegawai = new Pegawai();
            $pegawai->users_id = $user->id;
            $pegawai->no_kp = $validatedData['no_kp'];
            $pegawai->nama = $validatedData['nama'];
            $pegawai->emel = $validatedData['emelPegawai'] . '@aadk.gov.my';
            $pegawai->no_tel = $validatedData['no_tel'];
            $pegawai->jawatan = $validatedData['jawatan'];
            $pegawai->peranan = $validatedData['peranan_pengguna'];

            // Set negeri_bertugas and daerah_bertugas based on peranan_pengguna
            if ($validatedData['peranan_pengguna'] == "3") {
                // If peranan_pengguna is 3, set both fields to null
                $pegawai->negeri_bertugas = null;
                $pegawai->daerah_bertugas = null;
            } elseif ($validatedData['peranan_pengguna'] == "4") {
                // If peranan_pengguna is 4, set daerah_bertugas to null and update negeri_bertugas
                $pegawai->negeri_bertugas = $request->input('negeri_bertugas');
                $pegawai->daerah_bertugas = null;
            } elseif ($validatedData['peranan_pengguna'] == "5") {
                // If peranan_pengguna is 5, update based on request input
                $pegawai->negeri_bertugas = $request->input('negeri_bertugas');
                $pegawai->daerah_bertugas = $request->input('daerah_bertugas');
            }

            $pegawai->updated_at = now();
            $pegawai->save();

            // Update the status in pegawai_mohon_daftar table
            $pegawaiBaharu->status = 'Lulus';
            $pegawaiBaharu->updated_at = now();
            $pegawaiBaharu->save();

            // Generate the email verification URL
            // event(new Registered($user));
            $verificationUrl = URL::temporarySignedRoute(
                'verification.verify',
                now()->addMinutes(60),
                ['id' => $user->id, 'hash' => sha1($user->email)]
            );

            // $defaultEmail = 'wsyafiqah4@gmail.com';

            // Send notification email to the staff
            // Mail::to($defaultEmail)->send(new PegawaiApproved($user, $password, $verificationUrl));
            Mail::to($pegawai->emel)->send(new PegawaiApproved($pegawaiBaharu, $password, $verificationUrl));

            return redirect()->back()->with('success', 'Pegawai ' . $user->name . ' telah berjaya didaftarkan sebagai pengguna sistem ini. Notifikasi e-mel telah dihantar kepada pemohon.');
        }
    }

    public function modalPermohonanPegawaiDitolak($id)
    {
        $permohonan_pegawai = PegawaiMohonDaftar::find($id);
        return view('pendaftaran.pentadbir.modal_permohonan_pegawai_ditolak', compact('permohonan_pegawai'));
    }

    public function permohonanPegawaiDitolak(Request $request, $id)
    {
        // Fetch the staff request data
        $pegawaiDitolak = PegawaiMohonDaftar::where('id', $id)->firstOrFail();

        // Split the input by commas and trim any spaces
        $alasanDitolak = explode(',', $request->input('alasan_ditolak'));
        $alasanDitolak = array_map('trim', $alasanDitolak); // Trim spaces from each reason

        // Encode the alasan_ditolak array as JSON before saving
        $pegawaiDitolak->alasan_ditolak = json_encode($alasanDitolak);
        $pegawaiDitolak->status = 'Ditolak';
        $pegawaiDitolak->updated_at = now();
        $pegawaiDitolak->save();

        // $defaultEmail = 'fateennashuha9@gmail.com';

        // Send rejection email to the staff
        // Mail::to($defaultEmail)->send(new PegawaiRejected($pegawaiDitolak));
        Mail::to($pegawaiDitolak->emel)->send(new PegawaiRejected($pegawaiDitolak));

        return redirect()->route('senarai-pengguna')->with('error', 'Pengguna ' . $pegawaiDitolak->nama . ' tidak didaftarkan sebagai pengguna sistem ini. Notifikasi e-mel telah dihantar kepada pemohon.');
    }

    public function daftarPegawai(Request $request)
    {
        // Validation for required fields
        $request->validate([
            'name' => 'required|string',
            'no_kp' => 'required|numeric',
            'emailPegawai' => 'required|string',
            'peranan_pegawai' => 'required|integer',
            'no_tel' => 'required|numeric',
            'jawatan' => 'required|string',
            'daftar_negeri_bertugas' => 'nullable|string',
            'daftar_daerah_bertugas' => 'nullable|string',
        ]);

        // Combine email name and domain
        $email = $request->emailPegawai . '@aadk.gov.my';

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
                'tahap_pengguna' => $request->peranan_pegawai,  // Make sure this field is filled
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
            // event(new Registered($user));
            $verificationUrl = URL::temporarySignedRoute(
                'verification.verify',
                now()->addMinutes(60),
                ['id' => $user->id, 'hash' => sha1($user->email)]
            );

            // $defaultEmail = 'wsyafiqah4@gmail.com';

            Mail::to($email)->send(new DaftarPegawai($pegawai, $password, $verificationUrl));
            // Mail::to($defaultEmail)->send(new DaftarPegawai($pegawai, $password, $verificationUrl));

            return redirect()->route('senarai-pengguna')->with('success', 'Pegawai telah berjaya didaftarkan sebagai pengguna sistem ini. Notifikasi e-mel telah dihantar kepada pegawai.');
        }
        else {
            return redirect()->route('senarai-pengguna')->with('error', 'No kad pengenalan ' . $request->no_kp . ' telah didaftarkan dalam sistem ini.');
        }
    }

    // SEMAK IC DARI VIEW MyAADK
    public function semakKp(Request $request)
    {
        $no_kp = $request->input('no_kp');

        // SERVER
        // $klienView = KlienView::where('mykad', $no_kp)->first();

        // DB LOCAL
        $klienView = viewklienlocal::where('mykad', $no_kp)->first();

        // Check if client exists or not in view MyAADK
        if (!$klienView) {
            return redirect()->back()->with('not-exists', 'No kad pengenalan tersebut tidak dibenarkan untuk mendaftar sebagai pengguna sistem ini');
        }

        // Check if client already exists as a user
        $user = User::where('no_kp', $no_kp)->first();

        if ($user) {
            return redirect()->back()->with('registered', 'Klien sudah mendaftar sebagai pengguna sistem ini.');
        }

        // Store IC and client data in session if not yet registered
        session([
            'no_kp' => $no_kp,
            'klien_view' => [
                'nama' => $klienView->nama,
                'no_tel' => $klienView->telefon,
                'email' => $klienView->emel,
            ],
        ]);

        return redirect()->back()->with('exists', 'Data berjaya dijumpai. Sila klik "Daftar" untuk mendaftar klien ini.');
    }

    public function modalDaftarKlien($id)
    {
        // SERVER
        // $klien = KlienView::where('mykad', $id)->first();

        // DB LOCAL
        $klien = viewklienlocal::where('mykad', $id)->first();

        return view('pendaftaran.pentadbir.modal_daftar_klien', compact('klien'));
    }

    public function pentadbirDaftarKlien(Request $request)
    {
        $no_kp = $request->input('no_kp');

        // SERVER
        // $klienData = KlienView::where('mykad', $no_kp)->first();
        // $keluargaData = FamiliView::where('id_pk', $klienData->id_pk)->first();
        // $warisData = WarisView::where('id_pk', $klienData->id_pk)->first();
        // $pekerjaanData = KerjaView::where('id_pk', $klienData->id_pk)->where('id_kes', $klienData->id_ki)->first();

        // DB LOCAL
        $klienData = viewklienlocal::where('mykad', $no_kp)->first();
        $keluargaData = viewfamililocal::where('id_pk', $klienData->id_pk)->first();
        $warisData = viewwarislocal::where('id_pk', $klienData->id_pk)->first();
        $pekerjaanData = viewkerjalocal::where('id_pk', $klienData->id_pk)->where('id_kes', $klienData->id_ki)->first();

        // 1) Create klien
        $no_tel = $request->input('no_tel') ?: $klienData->telefon;
        $email = $request->input('email') ?: $klienData->emel;

        $penyakit = 'TIADA';
        if (!empty($klienData->penyakit)) {
            $parsed = @unserialize($klienData->penyakit);
            if (is_array($parsed) && isset($parsed[0]['nama'])) {
                $penyakit = strtoupper($parsed[0]['nama']);
            }
        }

        // negeri_pejabat: from senarai_negeri_pejabat where negeri == $klienData->negeri
        $negeri_pejabat_id = DaerahPejabat::where('kod', $klienData->id_fasiliti)->value('negeri_id');
        $negeriPejabat = NegeriPejabat::where('negeri_id', $negeri_pejabat_id)->value('id');

        // negeri: from senarai_negeri where negeri == $klienData->negeri_alamat
        $negeri = Negeri::where('negeri', $klienData->negeri)->value('id');

        // daerah: from senarai_daerah where daerah == $klienData->alamat03
        $daerah = Daerah::where('daerah', $klienData->alamat03)->value('id');

        $klien = Klien::create([
            'id_pk' => $klienData->id_pk,
            'id_ki' => $klienData->id_ki,
            'no_kp' => $klienData->mykad,
            'nama' => strtoupper($klienData->nama),
            'no_tel' => preg_replace('/[^0-9]/', '', str_replace('-', '', trim($no_tel))),
            'emel' => $email,
            'alamat_rumah' => strtoupper(implode(' ', array_filter([
                $klienData->alamat01,
                $klienData->alamat02,
                $klienData->alamat03
            ]))),
            'poskod' => (empty($klienData->poskod)) 
                ? '00000' 
                : (strlen($klienData->poskod) == 5 
                    ? $klienData->poskod 
                    : substr('00000' . $klienData->poskod, -5)),
            'daerah' => $daerah ?? '',
            'negeri' => $negeri ?? '',
            'jantina' => $klienData->jantina,
            'agama' => $klienData->id_agama,
            'bangsa' => $klienData->id_bangsa,
            'tahap_pendidikan' => $klienData->id_pendidikan,
            'penyakit' => $penyakit,
            'status_oku' => empty($klienData->{'kategori oku'}) ? 'TIADA' : strtoupper($klienData->{'kategori oku'}),
            'skor_ccri' => $klienData->markah,
            'daerah_pejabat' => $klienData->id_fasiliti,
            'negeri_pejabat' => $negeriPejabat,
            'status_kemaskini' => 'Baharu',
            'created_at' => now(),
        ]);

        // get klien_id
        $klien_id = Klien::where('no_kp', $no_kp)->value('id');


        // 2) Create keluarga_klien
        KeluargaKlien::create([
            'klien_id' => $klien_id,
            'status_perkahwinan' => $keluargaData ? strtoupper($klienData->st_kahwin) : null,
            'nama_pasangan' => $keluargaData ? strtoupper($keluargaData->lk_nama_psgn) : null,
            'no_tel_pasangan' => $keluargaData ? preg_replace('/[^0-9]/', '', str_replace('-', '', trim($keluargaData->lk_notel_psgn))) : null,
            'status_kemaskini' => 'Baharu',
            'created_at' => now(),
        ]);

        
        // 3) Create waris_klien
        // daerah: from senarai_daerah where daerah == $warisData->alamat3
        $daerah_penjaga = $warisData ? Daerah::where('daerah', $warisData->wr_alamat3)->value('id') : null;

        WarisKlien::create([
            'klien_id' => $klien_id,
            'nama_bapa' => $keluargaData ? strtoupper($keluargaData->lk_nama_bapa) : null,
            'no_tel_bapa' => $keluargaData ? preg_replace('/[^0-9]/', '', str_replace('-', '', trim($keluargaData->lk_notel_bapa))) : null,
            'status_bapa' => $keluargaData ? strtoupper($keluargaData->status_bapa) : null,
            'nama_ibu' => $keluargaData ? strtoupper($keluargaData->lk_nama_ibu) : null,
            'no_tel_ibu' => $keluargaData ? preg_replace('/[^0-9]/', '', str_replace('-', '', trim($keluargaData->lk_notel_ibu))) : null,
            'status_ibu' => $keluargaData ? strtoupper($keluargaData->status_ibu) : null,
            'hubungan_penjaga' => $warisData ? strtoupper($warisData->wr_hubungan) : null,
            'nama_penjaga' => $warisData ? strtoupper($warisData->wr_nama) : null,
            'no_tel_penjaga' => $warisData ? preg_replace('/[^0-9]/', '', str_replace('-', '', trim($warisData->wr_notel))) : null,
            'alamat_penjaga' => $warisData ? strtoupper(implode(' ', array_filter([
                $warisData->wr_alamat1,
                $warisData->wr_alamat2,
            ]))) : null,
            'poskod_penjaga' => $warisData
                ? (empty($warisData->wr_poskod) 
                    ? '00000' 
                    : (strlen($warisData->wr_poskod) == 5 
                        ? $warisData->wr_poskod 
                        : substr('00000' . $warisData->wr_poskod, -5)))
                : null,
            'daerah_penjaga' => $daerah_penjaga,
            'negeri_penjaga' => $warisData ? $warisData->wr_negeri : null,
            'status_kemaskini' => 'Baharu',
            'created_at' => now(),
        ]);


        // 4) Create pekerjaan_klien
        // daerah: from senarai_daerah where daerah == $warisData->tk_majikan_alamat3
        $daerah_majikan = $pekerjaanData ? Daerah::where('daerah', $pekerjaanData->tk_majikan_alamat3)->value('id') : null;

        PekerjaanKlien::create([
            'klien_id' => $klien_id,
            'status_kerja' => $pekerjaanData ? strtoupper($pekerjaanData->tk_status) : null,
            'alasan_tidak_kerja' => $pekerjaanData ? strtoupper($pekerjaanData->tk_status_xbekerja) : null,
            'bidang_kerja' => $pekerjaanData ? $pekerjaanData->tk_bidang : null,
            'nama_kerja' => $pekerjaanData ? $pekerjaanData->tk_pekerjaan : null,
            'pendapatan' => $pekerjaanData ? $pekerjaanData->tk_gaji : null,
            'kategori_majikan' => $pekerjaanData ? strtoupper($pekerjaanData->tk_kategori_majikan) : null,
            'nama_majikan' => $pekerjaanData ? $pekerjaanData->tk_nama_majikan : null,
            'no_tel_majikan' => $pekerjaanData ? preg_replace('/[^0-9]/', '', str_replace('-', '', trim($pekerjaanData->tk_majikan_notel))) : null,
            'alamat_kerja' => $pekerjaanData ? strtoupper(implode(' ', array_filter([
                $pekerjaanData->tk_majikan_alamat1,
                $pekerjaanData->tk_majikan_alamat2,
            ]))) : null,
            'poskod_kerja' => $pekerjaanData
                ? (empty($pekerjaanData->tk_majikan_poskod) 
                    ? '00000' 
                    : (strlen($pekerjaanData->tk_majikan_poskod) == 5 
                        ? $pekerjaanData->tk_majikan_poskod 
                        : substr('00000' . $pekerjaanData->tk_majikan_poskod, -5)))
                : null,
            'daerah_kerja' => $daerah_majikan,
            'negeri_kerja' => $pekerjaanData ? $pekerjaanData->tk_majikan_negeri : null,
            'status_kemaskini' => 'Baharu',
            'created_at' => now(),
        ]);


        // 5) Create rawatan_klien
        $rawatan = RawatanKlien::create([
            'klien_id' => $klien_id,
            'id_pk' => $klienData->id_pk,
            'id_ki' => $klienData->id_ki,
            'tkh_perintah' => $klienData->tkh_perintah,
            'tkh_mula_pengawasan' => $klienData->tkh_mulaPengawasan,
            'tkh_tamat_pengawasan' => $klienData->tkh_tamatPengawasan,
            'seksyen' => $klienData->ki_detail_seksyen,
            'puspen' => $klienData->PUSPEN02 ?? $klienData->PUSPEN01,
            'pejabat' => $klienData->id_fasiliti,
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        // 6) Create users
        // Check if password is provided
        if (!$request->filled('passwordDaftar')) {
            return redirect()->back()->with('error', 'Klien belum didaftarkan sebagai pengguna sistem. Sila jana kata laluan terlebih dahulu.');
        }

        $user = User::create([
            'name' => strtoupper($request->name),
            'no_kp' => $request->no_kp,
            'email' => $request->email,
            'tahap_pengguna' => 2, // Klien
            'status' => 0,
            'password' => Hash::make($request->passwordDaftar),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Send Email if email exists
        if ($request->email) {
            Mail::to($user->email)->send(new DaftarKlien($user, $request->passwordDaftar));
            $message = 'Klien telah berjaya didaftarkan sebagai pengguna sistem. Notifikasi e-mel telah dihantar kepada klien.';
        } else {
            $message = 'Klien telah berjaya didaftarkan sebagai pengguna sistem.';
        }

        return redirect()->route('senarai-pengguna')->with('success', $message);
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

    public function getDaerahBertugas($negeri_id)
    {
        // Fetch daerah based on negeri_id
        $daerah = DaerahPejabat::where('negeri_id', $negeri_id)->get();

        // Return JSON response
        return response()->json($daerah);
    }
}
