@extends('layouts._default')

@section('content')

@php
    use Carbon\Carbon;
@endphp

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f5f5;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        header {
            font-family: 'Montserrat', sans-serif;
            color: #444;
            font-size: 1.8em;
            background-color: lightgrey;
            width: 94%;
            margin: 0 auto; /* Center the header */
            border-radius: 8px; /* Optional: Add rounded corners */
            text-align: center; /* Center the text inside the header */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Optional: Add a shadow for a better look */
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-size: 1.1em;
            margin-bottom: 0.5em;
        }

        input[type="text"], select, textarea {
            padding: 10px;
            margin-bottom: 1em;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1.1em;
        }

        button {
            padding: 10px 15px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        .form-check-input {
            margin-right: 0.5em;
        }

        .form-check-label {
            color: #000; 
        }

        .radio-group, .checkbox-group {
            display: flex;
            margin-bottom: 0.5em;
            margin-left: 1em;
        }

        .text-center {
            text-align: center;
        }

        .form-control {
            width: 30%;
            margin-left: 1em;
        }

        .d-none {
            display: none;
        }

        input::placeholder,
        textarea::placeholder {
            font-size: 15px;
            color: #999;
        }

        .form-control::placeholder {
            font-size: 15px;
            color: #999;
        }
    </style>
</head>

<div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
    <!--begin::Page title-->
    <div class="page-title flex-column justify-content-center flex-wrap me-3 mb-5">
        <!--begin::Title-->
        <h1 class="page-heading text-dark fw-bold fs-3 flex-column justify-content-center my-0">Modal Kepulihan</h1>
        <!--end::Title-->
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
            <!--begin::Item-->
            <li class="breadcrumb-item text-muted">
                <a href="../../demo1/dist/index.html" class="text-muted text-hover-primary">Modal Kepulihan</a>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item text-muted">Soal Selidik</li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item text-muted">Soalan Demografi</li>
            <!--end::Item-->
        </ul>
        <!--end::Breadcrumb-->
    </div>
    <!--end::Page title-->
</div>

<body>
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <!--begin::Card body-->
            <div class="card card-flush">
                <br>
                <header>SOAL SELIDIK MAKLUMAT DEMOGRAFI</header>
                <form method="POST" action="{{ route('klien.submit.demografi') }}" class="p-10">
                    @csrf

                    <div class="mb-4">
                        <label for="rawatan"><b>1) Di manakah anda pernah menerima rawatan ?</b></label><br>
                        <div class="radio-group">
                            <input class="form-check-input" type="radio" name="rawatan" value="PUSPEN/CCRC" id="rawatan1" {{ isset($respon) && $respon->rawatan == 'PUSPEN/CCRC' ? 'checked' : '' }}>
                            <label class="form-check-label" for="rawatan1">PUSPEN/CCRC</label>
                        </div>
                        <div class="radio-group">
                            <input class="form-check-input" type="radio" name="rawatan" value="PPDP" id="rawatan2" {{ isset($respon) && $respon->rawatan == 'PPDP' ? 'checked' : '' }}>
                            <label class="form-check-label" for="rawatan2">PPDP</label>
                        </div>
                        <div class="radio-group">
                            <input class="form-check-input" type="radio" name="rawatan" value="CCSC" id="rawatan3" {{ isset($respon) && $respon->rawatan == 'CCSC' ? 'checked' : '' }}>
                            <label class="form-check-label" for="rawatan3">CCSC</label>
                        </div>
                        <div class="radio-group">
                            <input class="form-check-input" type="radio" name="rawatan" value="Lain-lain" id="rawatan4" {{ isset($respon) && $respon->rawatan == 'Lain-lain' ? 'checked' : '' }}>
                            <label class="form-check-label" for="rawatan4">Lain-lain</label>
                        </div>
                        <input type="text" class="form-control mt-2 d-none" id="lain_lain_rawatan" name="lain_lain_rawatan" placeholder="Nyatakan jika lain-lain" value="{{ $respon->lain_lain_rawatan ?? '' }}">
                    </div>

                    <div  class="mb-4">
                        <label for="pusat_rawatan"><b>2) Di manakah pusat rawatan terkini anda ?</b></label><br>
                        <div class="radio-group">
                            <input class="form-check-input" type="radio" name="pusat_rawatan" value="PUSPEN/CCRC" id="pusat_rawatan1" {{ isset($respon) && $respon->pusat_rawatan == 'PUSPEN/CCRC' ? 'checked' : '' }}>
                            <label class="form-check-label" for="pusat_rawatan1">PUSPEN/CCRC</label>
                        </div>
                        <div class="radio-group">
                            <input class="form-check-input" type="radio" name="pusat_rawatan" value="PPDP" id="pusat_rawatan2" {{ isset($respon) && $respon->pusat_rawatan == 'PPDP' ? 'checked' : '' }}>
                            <label class="form-check-label" for="pusat_rawatan2">PPDP</label>
                        </div>
                        <div class="radio-group">
                            <input class="form-check-input" type="radio" name="pusat_rawatan" value="AADK Daerah" id="pusat_rawatan3" {{ isset($respon) && $respon->pusat_rawatan == 'AADK Daerah' ? 'checked' : '' }}>
                            <label class="form-check-label" for="pusat_rawatan3">AADK Daerah</label>
                        </div>
                    </div>

                    <div  class="mb-4">
                        <label for="tempoh_tidak_ambil_dadah"><b>3) Berapa lamakah anda sudah tidak mengambil dadah ?</b></label>
                        <input type="text" class="form-control" id="tempoh_tidak_ambil_dadah" name="tempoh_tidak_ambil_dadah" placeholder="Nyatakan berapa tahun" style="width: 30%;" value="{{ $respon->tempoh_tidak_ambil_dadah ?? '' }}">
                    </div>

                    <div class="mb-4">
                        <label for="kategori"><b>4) Apakah kategori pembebasan anda ?</b></label><br>
                        <div class="radio-group">
                            <input class="form-check-input" type="radio" name="kategori" value="Pasca bebas (kali pertama)" id="kategori1" 
                                {{ (isset($respon) && $respon->kategori == 'Pasca bebas (kali pertama)') || old('kategori') == 'Pasca bebas (kali pertama)' ? 'checked' : '' }}>
                            <label class="form-check-label" for="kategori1">Pasca bebas (kali pertama)</label>
                        </div>
                        <div class="radio-group">
                            <input class="form-check-input" type="radio" name="kategori" value="Pasca bebas (relaps)" id="kategori2" 
                                {{ (isset($respon) && $respon->kategori == 'Pasca bebas (relaps)') || old('kategori') == 'Pasca bebas (relaps)' ? 'checked' : '' }}>
                            <label class="form-check-label" for="kategori2">Pasca bebas (relaps)</label>
                        </div>
                        <input type="text" class="form-control mt-2 {{ (isset($respon) && $respon->kategori == 'Pasca bebas (relaps)') || old('kategori') == 'Pasca bebas (relaps)' ? '' : 'd-none' }}" 
                            id="jumlah_relapse" name="jumlah_relapse" placeholder="Jumlah bilangan relapse sejak mula menerima rawatan" 
                            value="{{ isset($respon) ? $respon->jumlah_relapse : old('jumlah_relapse') }}" style="width: 40%;">
                    </div>
                    
                    <div class="mb-4">
                        <label for="jenis_dadah"><b>5) Apakah jenis dadah yang pernah digunakan ?</b></label><br>
                        @php
                            $jenis_dadah = isset($respon) ? json_decode($respon->jenis_dadah, true) : [];
                        @endphp
                        <div class="radio-group">
                            <input class="form-check-input" type="checkbox" name="jenis_dadah[]" value="ATS (Syabu, Ice & Batu)" id="ATS" 
                                {{ (in_array('ATS (Syabu, Ice & Batu)', $jenis_dadah)) || in_array('ATS (Syabu, Ice & Batu)', old('jenis_dadah', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="ATS">ATS (Syabu, Ice & Batu)</label>
                        </div>
                        <div class="radio-group">
                            <input class="form-check-input" type="checkbox" name="jenis_dadah[]" value="Opiat (Ganja, Heroin, Morfin & Kodein)" id="Opiat" 
                                {{ (in_array('Opiat (Ganja, Heroin, Morfin & Kodein)', $jenis_dadah)) || in_array('Opiat (Ganja, Heroin, Morfin & Kodein)', old('jenis_dadah', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="Opiat">Opiat (Ganja, Heroin, Morfin & Kodein)</label>
                        </div>
                        <div class="radio-group">
                            <input class="form-check-input" type="checkbox" name="jenis_dadah[]" value="Ganja (Ganja, Hashish, Marijuana)" id="Ganja" 
                                {{ (in_array('Ganja (Ganja, Hashish, Marijuana)', $jenis_dadah)) || in_array('Ganja (Ganja, Hashish, Marijuana)', old('jenis_dadah', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="Ganja">Ganja (Ganja, Hashish, Marijuana)</label>
                        </div>
                        <div class="radio-group">
                            <input class="form-check-input" type="checkbox" name="jenis_dadah[]" value="Pil Psikotropik (Eramin 5, APO 5, Dormicum & Benzodiazepine)" id="Pil_Psikotropik" 
                                {{ (in_array('Pil Psikotropik (Eramin 5, APO 5, Dormicum & Benzodiazepine)', $jenis_dadah)) || in_array('Pil Psikotropik (Eramin 5, APO 5, Dormicum & Benzodiazepine)', old('jenis_dadah', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="Pil_Psikotropik">Pil Psikotropik (Eramin 5, APO 5, Dormicum & Benzodiazepine)</label>
                        </div>
                        <div class="radio-group">
                            <input class="form-check-input" type="checkbox" name="jenis_dadah[]" value="Lain-Lain" id="Lain_Lain" 
                                {{ (in_array('Lain-Lain', $jenis_dadah)) || in_array('Lain-Lain', old('jenis_dadah', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="Lain_Lain">Lain-Lain (Ketum, Kokain, Ketamin, Depresen, Dissoaciative, Hallucinogen, Inhalan)</label>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="jenis_kediaman"><b>6) Nyatakan jenis kediaman anda ?</b></label><br>
                        <div class="radio-group">
                            <input class="form-check-input" type="radio" name="jenis_kediaman" value="Rumah Teres" id="kediaman1" 
                                {{ (isset($respon) && $respon->jenis_kediaman == 'Rumah Teres') || old('jenis_kediaman') == 'Rumah Teres' ? 'checked' : '' }}>
                            <label class="form-check-label" for="kediaman1">Rumah Teres</label>
                        </div>
                        <div class="radio-group">
                            <input class="form-check-input" type="radio" name="jenis_kediaman" value="Rumah Teres Kos Rendah" id="kediaman2" 
                                {{ (isset($respon) && $respon->jenis_kediaman == 'Rumah Teres Kos Rendah') || old('jenis_kediaman') == 'Rumah Teres Kos Rendah' ? 'checked' : '' }}>
                            <label class="form-check-label" for="kediaman2">Rumah Teres Kos Rendah</label>
                        </div>
                        <div class="radio-group">
                            <input class="form-check-input" type="radio" name="jenis_kediaman" value="Rumah Kampung" id="kediaman3" 
                                {{ (isset($respon) && $respon->jenis_kediaman == 'Rumah Kampung') || old('jenis_kediaman') == 'Rumah Kampung' ? 'checked' : '' }}>
                            <label class="form-check-label" for="kediaman3">Rumah Kampung</label>
                        </div>
                        <div class="radio-group">
                            <input class="form-check-input" type="radio" name="jenis_kediaman" value="Flat/Pangsapuri" id="kediaman4" 
                                {{ (isset($respon) && $respon->jenis_kediaman == 'Flat/Pangsapuri') || old('jenis_kediaman') == 'Flat/Pangsapuri' ? 'checked' : '' }}>
                            <label class="form-check-label" for="kediaman4">Flat/Pangsapuri</label>
                        </div>
                        <div class="radio-group">
                            <input class="form-check-input" type="radio" name="jenis_kediaman" value="Tiada Tempat Tinggal" id="kediaman5" 
                                {{ (isset($respon) && $respon->jenis_kediaman == 'Tiada Tempat Tinggal') || old('jenis_kediaman') == 'Tiada Tempat Tinggal' ? 'checked' : '' }}>
                            <label class="form-check-label" for="kediaman5">Tiada Tempat Tinggal</label>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="tempoh_tinggal_lokasi_terkini"><b>7) Berapa lamakah anda tinggal di lokasi terkini ?</b></label>
                        <input type="text" class="form-control" id="tempoh_tinggal_lokasi_terkini" name="tempoh_tinggal_lokasi_terkini" placeholder="Tahun" 
                            value="{{ isset($respon) ? $respon->tempoh_tinggal_lokasi_terkini : old('tempoh_tinggal_lokasi_terkini') }}" style="width: 30%;">
                    </div>
                    
                    <div class="mb-4">
                        <label for="tinggal_dengan"><b>8) Dengan siapa anda tinggal bersama ?</b></label><br>
                        <div class="radio-group">
                            <input class="form-check-input" type="radio" name="tinggal_dengan" value="Sendiri" id="tinggal_dengan1" 
                                {{ (isset($respon) && $respon->tinggal_dengan == 'Sendiri') || old('tinggal_dengan') == 'Sendiri' ? 'checked' : '' }}>
                            <label class="form-check-label" for="tinggal_dengan1">Sendiri</label>
                        </div>
                        <div class="radio-group">
                            <input class="form-check-input" type="radio" name="tinggal_dengan" value="Keluarga" id="tinggal_dengan2" 
                                {{ (isset($respon) && $respon->tinggal_dengan == 'Keluarga') || old('tinggal_dengan') == 'Keluarga' ? 'checked' : '' }}>
                            <label class="form-check-label" for="tinggal_dengan2">Keluarga</label>
                        </div>
                        <div class="radio-group">
                            <input class="form-check-input" type="radio" name="tinggal_dengan" value="Saudara" id="tinggal_dengan3" 
                                {{ (isset($respon) && $respon->tinggal_dengan == 'Saudara') || old('tinggal_dengan') == 'Saudara' ? 'checked' : '' }}>
                            <label class="form-check-label" for="tinggal_dengan3">Saudara</label>
                        </div>
                        <div class="radio-group">
                            <input class="form-check-input" type="radio" name="tinggal_dengan" value="Kawan" id="tinggal_dengan4" 
                                {{ (isset($respon) && $respon->tinggal_dengan == 'Kawan') || old('tinggal_dengan') == 'Kawan' ? 'checked' : '' }}>
                            <label class="form-check-label" for="tinggal_dengan4">Kawan</label>
                        </div>
                        <div class="radio-group">
                            <input class="form-check-input" type="radio" name="tinggal_dengan" value="Gelandangan" id="tinggal_dengan5" 
                                {{ (isset($respon) && $respon->tinggal_dengan == 'Gelandangan') || old('tinggal_dengan') == 'Gelandangan' ? 'checked' : '' }}>
                            <label class="form-check-label" for="tinggal_dengan5">Gelandangan (Homeless)</label>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="kawasan_tempat_tinggal"><b>9) Di kawasan manakah anda tinggal ?</b></label><br>
                        <div class="radio-group">
                            <input class="form-check-input" type="radio" name="kawasan_tempat_tinggal" value="Bandar" id="kawasan1" 
                                {{ (isset($respon) && $respon->kawasan_tempat_tinggal == 'Bandar') || old('kawasan_tempat_tinggal') == 'Bandar' ? 'checked' : '' }}>
                            <label class="form-check-label" for="kawasan1">Bandar</label>
                        </div>
                        <div class="radio-group">
                            <input class="form-check-input" type="radio" name="kawasan_tempat_tinggal" value="Pinggir Bandar" id="kawasan2" 
                                {{ (isset($respon) && $respon->kawasan_tempat_tinggal == 'Pinggir Bandar') || old('kawasan_tempat_tinggal') == 'Pinggir Bandar' ? 'checked' : '' }}>
                            <label class="form-check-label" for="kawasan2">Pinggir Bandar</label>
                        </div>
                        <div class="radio-group">
                            <input class="form-check-input" type="radio" name="kawasan_tempat_tinggal" value="Luar Bandar/Kampung" id="kawasan3" 
                                {{ (isset($respon) && $respon->kawasan_tempat_tinggal == 'Luar Bandar/Kampung') || old('kawasan_tempat_tinggal') == 'Luar Bandar/Kampung' ? 'checked' : '' }}>
                            <label class="form-check-label" for="kawasan3">Luar Bandar/Kampung</label>
                        </div>
                        <div class="radio-group">
                            <input class="form-check-input" type="radio" name="kawasan_tempat_tinggal" value="Felda" id="kawasan4" 
                                {{ (isset($respon) && $respon->kawasan_tempat_tinggal == 'Felda') || old('kawasan_tempat_tinggal') == 'Felda' ? 'checked' : '' }}>
                            <label class="form-check-label" for="kawasan4">Felda</label>
                        </div>
                        <div class="radio-group">
                            <input class="form-check-input" type="radio" name="kawasan_tempat_tinggal" value="Felcra" id="kawasan5" 
                                {{ (isset($respon) && $respon->kawasan_tempat_tinggal == 'Felcra') || old('kawasan_tempat_tinggal') == 'Felcra' ? 'checked' : '' }}>
                            <label class="form-check-label" for="kawasan5">Felcra</label>
                        </div>
                        <div class="radio-group">
                            <input class="form-check-input" type="radio" name="kawasan_tempat_tinggal" value="Kebun Getah" id="kawasan6" 
                                {{ (isset($respon) && $respon->kawasan_tempat_tinggal == 'Kebun Getah') || old('kawasan_tempat_tinggal') == 'Kebun Getah' ? 'checked' : '' }}>
                            <label class="form-check-label" for="kawasan6">Kebun Getah</label>
                        </div>
                        <div class="radio-group">
                            <input class="form-check-input" type="radio" name="kawasan_tempat_tinggal" value="Kawasan Nelayan" id="kawasan7" 
                                {{ (isset($respon) && $respon->kawasan_tempat_tinggal == 'Kawasan Nelayan') || old('kawasan_tempat_tinggal') == 'Kawasan Nelayan' ? 'checked' : '' }}>
                            <label class="form-check-label" for="kawasan7">Kawasan Nelayan</label>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary text-center mt-5">Seterusnya</button>
                    </div>
                </form>
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Content container-->
    </div>

    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Check if there is a flash message
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berjaya!',
                    text: '{!! session('success') !!}',
                    confirmButtonText: 'OK'
                });
            @endif

            // Check if there is a flash error message
            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Tidak Berjaya!',
                    text: '{!! session('error') !!}',
                    confirmButtonText: 'OK'
                });
            @endif
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const rawatanRadios = document.querySelectorAll('input[name="rawatan"]');
            const lainLainRawatanField = document.getElementById('lain_lain_rawatan');
            const kategoriRadios = document.querySelectorAll('input[name="kategori"]');
            const jumlahRelapseField = document.getElementById('jumlah_relapse');

            rawatanRadios.forEach(radio => {
                radio.addEventListener('change', function () {
                    if (this.value === 'Lain-lain') {
                        lainLainRawatanField.classList.remove('d-none');
                    } else {
                        lainLainRawatanField.classList.add('d-none');
                    }
                });
            });

            kategoriRadios.forEach(radio => {
                radio.addEventListener('change', function () {
                    if (this.value === 'Pasca bebas (relaps)') {
                        jumlahRelapseField.classList.remove('d-none');
                    } else {
                        jumlahRelapseField.classList.add('d-none');
                    }
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Select all form inputs
            const inputs = document.querySelectorAll('input, textarea, select');
        
            // Function to save form data
            const saveFormData = (event) => {
                const formData = new FormData(document.querySelector('form'));
                fetch('{{ route("klien.autosave.demografi") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Autosave successful', data);
                })
                .catch(error => {
                    console.error('Autosave error', error);
                });
            };
        
            // Attach event listener to inputs
            inputs.forEach(input => {
                input.addEventListener('change', saveFormData);
                input.addEventListener('input', saveFormData);
            });
        });
    </script>
</body>
@endsection