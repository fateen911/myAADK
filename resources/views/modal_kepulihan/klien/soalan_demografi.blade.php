@extends('layouts._default')

@section('content')

@php
    use Carbon\Carbon;
@endphp

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .card-flush {
            padding: 20px;
            display: flex;
            width: 100%;
        }
        .card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        /* .h2 {
            text-align: center !important;
            padding-top: 20px;
        } */
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
    
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-xxl">
        <!--begin::Card body-->
        <div class="card card-flush">
            <h2 class="text-center">BAHAGIAN A : DEMOGRAFI</h2>
            <form method="POST" action="" class="p-4">
                @csrf

                <div class="mb-7">
                    <label for="rawatan">1) Dimanakah anda pernah menerima rawatan ?</label><br>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="radio" name="rawatan" value="PUSPEN/CCRC" id="rawatan1">
                        <label class="form-check-label" for="rawatan1">PUSPEN/CCRC</label>
                    </div>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="radio" name="rawatan" value="PPDP" id="rawatan2">
                        <label class="form-check-label" for="rawatan2">PPDP</label>
                    </div>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="radio" name="rawatan" value="CCSC" id="rawatan3">
                        <label class="form-check-label" for="rawatan3">CCSC</label>
                    </div>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="radio" name="rawatan" value="Lain-lain" id="rawatan4">
                        <label class="form-check-label" for="rawatan4">Lain-lain. Nyatakan</label>
                    </div>
                    <input type="text" class="form-control mt-2 d-none" id="lain_lain_rawatan" name="lain_lain_rawatan" placeholder="Nyatakan jika lain-lain">
                </div>

                <div class="mb-7">
                    <label for="pusat_rawatan">2) Dimanakah pusat rawatan terkini anda ?</label><br>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="radio" name="pusat_rawatan" value="PUSPEN/CCRC" id="pusat_rawatan1">
                        <label class="form-check-label" for="pusat_rawatan1">PUSPEN/CCRC</label>
                    </div>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="radio" name="pusat_rawatan" value="PPDP" id="pusat_rawatan2">
                        <label class="form-check-label" for="pusat_rawatan2">PPDP</label>
                    </div>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="radio" name="pusat_rawatan" value="AADK Daerah" id="pusat_rawatan3">
                        <label class="form-check-label" for="pusat_rawatan3">AADK Daerah</label>
                    </div>
                </div>

                <div class="mb-7">
                    <label for="lama_tidak_ambil_dadah">3) Berapa lama anda sudah tidak mengambil dadah ?</label>
                    <input type="text" class="form-control" id="lama_tidak_ambil_dadah" name="lama_tidak_ambil_dadah" placeholder="Tahun">
                </div>

                <div class="mb-7">
                    <label for="kategori">4) Apakah kategori pembebasan anda ?</label><br>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="radio" name="kategori" value="Pasca bebas (kali pertama)" id="kategori1">
                        <label class="form-check-label" for="kategori1">Pasca bebas (kali pertama)</label>
                    </div>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="radio" name="kategori" value="Pascabebas (relapse)" id="kategori2">
                        <label class="form-check-label" for="kategori2">Pascabebas (relapse)</label>
                    </div>
                    <input type="text" class="form-control mt-2 d-none" id="jumlah_relapse" name="jumlah_relapse" placeholder="Jumlah bilangan relapse sejak mula menerima rawatan">
                </div>

                <div class="mb-7">
                    <label for="jenis_dadah">5) Apakah jenis dadah yang pernah digunakan ?</label><br>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" name="jenis_dadah[]" value="ATS (Syabu, Ice & Batu)" id="ATS">
                        <label class="form-check-label" for="ATS">ATS (Syabu, Ice & Batu)</label>
                    </div>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" name="jenis_dadah[]" value="Opiat (Ganja, Heroin, Morfin & Kodein)" id="Opiat">
                        <label class="form-check-label" for="Opiat">Opiat (Ganja, Heroin, Morfin & Kodein)</label>
                    </div>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" name="jenis_dadah[]" value="Ganja (Ganja, Hashish, Marijuana)" id="Ganja">
                        <label class="form-check-label" for="Ganja">Ganja (Ganja, Hashish, Marijuana)</label>
                    </div>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" name="jenis_dadah[]" value="Pil Psikotropik (Eramin 5, APO 5, Dormicum & Benzodiazepine)" id="Pil_Psikotropik">
                        <label class="form-check-label" for="Pil_Psikotropik">Pil Psikotropik (Eramin 5, APO 5, Dormicum & Benzodiazepine)</label>
                    </div>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" name="jenis_dadah[]" value="Lain-Lain" id="Lain_Lain">
                        <label class="form-check-label" for="Lain_Lain">Lain-Lain (Ketum, Kokain, Ketamin, Depresen, Dissoaciative, Hallucinogen, Inhalan)</label>
                    </div>
                </div>

                <div class="mb-7">
                    <label for="jenis_kediaman">6) Nyatakan jenis kediaman anda ?</label><br>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="radio" name="jenis_kediaman" value="Rumah Teres" id="kediaman1">
                        <label class="form-check-label" for="kediaman1">Rumah Teres</label>
                    </div>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="radio" name="jenis_kediaman" value="Rumah Teres Kos Rendah" id="kediaman2">
                        <label class="form-check-label" for="kediaman2">Rumah Teres Kos Rendah</label>
                    </div>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="radio" name="jenis_kediaman" value="Rumah Kampung" id="kediaman3">
                        <label class="form-check-label" for="kediaman3">Rumah Kampung</label>
                    </div>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="radio" name="jenis_kediaman" value="Flat/Pangsapuri" id="kediaman4">
                        <label class="form-check-label" for="kediaman4">Flat/Pangsapuri</label>
                    </div>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="radio" name="jenis_kediaman" value="Tiada Tempat Tinggal" id="kediaman5">
                        <label class="form-check-label" for="kediaman5">Tiada Tempat Tinggal</label>
                    </div>
                </div>

                <div class="mb-7">
                    <label for="lama_tinggal_lokasi">7) Berapa lamakah anda tinggal di lokasi terkini ?</label>
                    <input type="text" class="form-control" id="lama_tinggal_lokasi" name="lama_tinggal_lokasi" placeholder="Tahun">
                </div>

                <div class="mb-7">
                    <label for="tinggal_dengan">8) Dengan siapa anda tinggal dan hidup ?</label><br>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="radio" name="tinggal_dengan" value="Sendiri" id="tinggal_dengan1">
                        <label class="form-check-label" for="tinggal_dengan1">Sendiri</label>
                    </div>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="radio" name="tinggal_dengan" value="Keluarga" id="tinggal_dengan2">
                        <label class="form-check-label" for="tinggal_dengan2">Keluarga</label>
                    </div>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="radio" name="tinggal_dengan" value="Saudara" id="tinggal_dengan3">
                        <label class="form-check-label" for="tinggal_dengan3">Saudara</label>
                    </div>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="radio" name="tinggal_dengan" value="Kawan" id="tinggal_dengan4">
                        <label class="form-check-label" for="tinggal_dengan4">Kawan</label>
                    </div>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="radio" name="tinggal_dengan" value="Gelandangan" id="tinggal_dengan5">
                        <label class="form-check-label" for="tinggal_dengan5">Gelandangan (Homeless)</label>
                    </div>
                </div>

                <div class="mb-7">
                    <label for="tinggal_di_kawasan">9) Di kawasan manakah anda tinggal ?</label><br>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="radio" name="tinggal_di_kawasan" value="Bandar" id="kawasan1">
                        <label class="form-check-label" for="kawasan1">Bandar</label>
                    </div>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="radio" name="tinggal_di_kawasan" value="Pinggir Bandar" id="kawasan2">
                        <label class="form-check-label" for="kawasan2">Pinggir Bandar</label>
                    </div>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="radio" name="tinggal_di_kawasan" value="Luar Bandar/Kampung" id="kawasan3">
                        <label class="form-check-label" for="kawasan3">Luar Bandar/Kampung</label>
                    </div>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="radio" name="tinggal_di_kawasan" value="Felda" id="kawasan4">
                        <label class="form-check-label" for="kawasan4">Felda</label>
                    </div>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="radio" name="tinggal_di_kawasan" value="Felcra" id="kawasan5">
                        <label class="form-check-label" for="kawasan5">Felcra</label>
                    </div>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="radio" name="tinggal_di_kawasan" value="Kebun Getah" id="kawasan6">
                        <label class="form-check-label" for="kawasan6">Kebun Getah</label>
                    </div>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="radio" name="tinggal_di_kawasan" value="Kawasan Nelayan" id="kawasan7">
                        <label class="form-check-label" for="kawasan7">Kawasan Nelayan</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary text-center mt-5">Simpan</button>
            </form>
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Content container-->
</div>

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
                if (this.value === 'Pascabebas (relapse)') {
                    jumlahRelapseField.classList.remove('d-none');
                } else {
                    jumlahRelapseField.classList.add('d-none');
                }
            });
        });
    });
</script>

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
@endsection