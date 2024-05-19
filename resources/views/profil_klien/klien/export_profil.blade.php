<!DOCTYPE html>
<head>
    <title>{{ config('app.name', 'SistemBKOKU') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    {{-- <link rel="stylesheet" href="/assets/css/customAADK.css"> --}}
    <style>
        .profile-form {
            width: 100%;
            border-collapse: collapse;
        }

        .profile-form th, .profile-form td {
            border: 1px solid black;
            padding: 5px;
            text-align: left;
        }

        .text-center {
            text-align: center;
        }

        .header-part {
            background-color: lightgray;
            font-weight: bold;
        }

        .gap-top {
            margin-top: 10px;
        }

        .gap-bottom {
            margin-bottom: 10px;
        }

        .gap-left {
            padding-left: 10px;
        }

        .no-break {
            page-break-inside: avoid;
        }
    </style>
</head>

<body>
    @php
        $daerahKlien = DB::table('senarai_daerah')->where('id', $klien['daerah'])->value('senarai_daerah.daerah');
        $negeriKlien = DB::table('senarai_negeri')->where('id', $klien['negeri'])->value('senarai_negeri.negeri');
        $daerahKerja = DB::table('senarai_daerah')->where('id', $pekerjaan['daerah_kerja'])->value('senarai_daerah.daerah');
        $negeriKerja = DB::table('senarai_negeri')->where('id', $pekerjaan['negeri_kerja'])->value('senarai_negeri.negeri');
        $daerahWaris = DB::table('senarai_daerah')->where('id', $keluarga['daerah_waris'])->value('senarai_daerah.daerah');
        $negeriWaris = DB::table('senarai_negeri')->where('id', $keluarga['negeri_waris'])->value('senarai_negeri.negeri');
        $daerahPasangan = DB::table('senarai_daerah')->where('id', $keluarga['daerah_pasangan'])->value('senarai_daerah.daerah');
        $negeriPasangan = DB::table('senarai_negeri')->where('id', $keluarga['negeri_pasangan'])->value('senarai_negeri.negeri');
        $daerahKerjaPasangan = DB::table('senarai_daerah')->where('id', $keluarga['daerah_kerja_pasangan'])->value('senarai_daerah.daerah');
        $negeriKerjaPasangan = DB::table('senarai_negeri')->where('id', $keluarga['negeri_kerja_pasangan'])->value('senarai_negeri.negeri');
    @endphp

    <table class="profile-form no-break">
        <tr class="no-break">
            <td class="text-center" colspan="3" style="text-align: center;">
                <img src="logo/aadk.png" alt="Logo AADK" style="width: 15%; height: 10%; padding-top:20px;">
                <h2>AGENSI ANTIDADAH KEBANGSAAN (AADK)</h2>
            </td>
        </tr>
        <tr>
            <td class="header-part" colspan="3">A. MAKLUMAT PERIBADI</td>
        </tr>
        <tbody>
            <tr class="gap-left">
                <td style="width: 30%" class="gap-top">Nama</td>
                <td style="width: 2%" class="gap-top">:</td>
                <td class="gap-top">{{$klien->nama}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 30%">No. Kad Pengenalan</td>
                <td style="width: 2%">:</td>
                <td>{{$klien->no_kp}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 30%">Nombor Telefon</td>
                <td style="width: 2%">:</td>
                <td>{{$klien->no_tel}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 30%">Alamat E-mel</td>
                <td style="width: 2%">:</td>
                <td>{{$klien->emel}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 30%">Alamat Rumah</td>
                <td style="width: 2%">:</td>
                <td>{{$klien->alamat_rumah}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 30%">Poskod</td>
                <td style="width: 2%">:</td>
                <td>{{$klien->poskod}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 30%">Daerah</td>
                <td style="width: 2%">:</td>
                <td>{{$daerahKlien}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 30%">Negeri</td>
                <td style="width: 2%">:</td>
                <td>{{$negeriKlien}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 30%">Jantina</td>
                <td style="width: 2%">:</td>
                <td>{{$klien->jantina}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 30%">Bangsa</td>
                <td style="width: 2%">:</td>
                <td>{{$klien->bangsa}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 30%">Agama</td>
                <td style="width: 2%">:</td>
                <td>{{$klien->agama}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 30%">Tarikh Tamat Pengawasan</td>
                <td style="width: 2%">:</td>
                <td class="gap-bottom">{{$klien->tarikh_tamat_pengawasan}}</td>
            </tr>
            <tr>
                <td class="header-part" colspan="3">B. MAKLUMAT PEKERJAAN</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 30%" class="gap-top">Pekerjaan</td>
                <td style="width: 2%" class="gap-top">:</td>
                <td class="gap-top">{{$pekerjaan->pekerjaan}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 30%">Pendapatan Bulanan (RM)</td>
                <td style="width: 2%">:</td>
                <td>{{$pekerjaan->pendapatan}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 30%">Bidang Perkerjaan</td>
                <td style="width: 2%">:</td>
                <td>{{$pekerjaan->bidang_kerja}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 30%">Alamat Tempat Bekerja</td>
                <td style="width: 2%">:</td>
                <td>{{$pekerjaan->alamat_kerja}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 30%">Poskod Tempat Bekerja</td>
                <td style="width: 2%">:</td>
                <td>{{$pekerjaan->poskod_kerja}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 30%">Daerah Tempat Bekerja</td>
                <td style="width: 2%">:</td>
                <td>{{$daerahKerja}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 30%">Negeri Tempat Bekerja</td>
                <td style="width: 2%">:</td>
                <td>{{$negeriKerja}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 30%">Nama Majikan</td>
                <td style="width: 2%">:</td>
                <td>{{$pekerjaan->nama_majikan}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 30%">Nombor Telefon Majikan</td>
                <td style="width: 2%">:</td>
                <td class="gap-bottom">{{$pekerjaan->no_tel_majikan}}</td>
            </tr>
            <tr>
                <td class="header-part" colspan="3">C. MAKLUMAT KELUARGA</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%" class="gap-top">Nama Waris</td>
                <td style="width: 2%" class="gap-top">:</td>
                <td class="gap-top">{{$keluarga->nama_waris}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Nombor Telefon Waris</td>
                <td style="width: 2%">:</td>
                <td>{{$keluarga->no_tel_waris}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Hubungan Waris</td>
                <td style="width: 2%">:</td>
                <td>{{$keluarga->hubungan_waris}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Alamat Waris</td>
                <td style="width: 2%">:</td>
                <td>{{$keluarga->alamat_waris}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Poskod Waris</td>
                <td style="width: 2%">:</td>
                <td>{{$keluarga->poskod_waris}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Daerah Waris</td>
                <td style="width: 2%">:</td>
                <td>{{$daerahWaris}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Negeri Waris</td>
                <td style="width: 2%">:</td>
                <td>{{$negeriWaris}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Nama Pasangan</td>
                <td style="width: 2%">:</td>
                <td>{{$keluarga->nama_pasangan}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Nombor Telefon Pasangan</td>
                <td style="width: 2%">:</td>
                <td>{{$keluarga->no_tel_pasangan}}</td>
            </tr>
            <tr class="gap-left">
                <td class="gap-bottom" style="width: 35%">Alamat Pasangan</td>
                <td class="gap-bottom" style="width: 2%">:</td>
                <td>{{$keluarga->alamat_pasangan}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Poskod Pasangan</td>
                <td style="width: 2%">:</td>
                <td>{{$keluarga->poskod_pasangan}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Daerah Pasangan</td>
                <td style="width: 2%">:</td>
                <td>{{$daerahPasangan}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Negeri Pasangan</td>
                <td style="width: 2%">:</td>
                <td>{{$negeriPasangan}}</td>
            </tr>
            <tr class="gap-left">
                <td class="gap-bottom" style="width: 35%">Alamat Tempat Pasangan Bekerja</td>
                <td class="gap-bottom" style="width: 2%">:</td>
                <td>{{$keluarga->alamat_kerja_pasangan}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Poskod Tempat Pasangan Bekerja</td>
                <td style="width: 2%">:</td>
                <td>{{$keluarga->poskod_kerja_pasangan}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Daerah Tempat Pasangan Bekerja</td>
                <td style="width: 2%">:</td>
                <td>{{$daerahKerjaPasangan}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Negeri Tempat Pasangan Bekerja</td>
                <td style="width: 2%">:</td>
                <td class="gap-bottom">{{$negeriKerjaPasangan}}</td>
            </tr>
        </tbody>
    </table>

    {{-- <table class="profile-form">
        <tr>
            <td class="text-center" colspan="3">
                <img src="/assets/media/svg/jata_negara.svg" alt="jata-negara-malaysia">
                <br><b class="title"> MAKLUMAT PROFIL PERIBADI</b>
                <p><b class="description">AGENSI ANTIDADAH KEBANGSAAN (AADK)</p>
                <br><br>
            </td>
        </tr>
        <tr>
            <td class="header-part" colspan="3">A. MAKLUMAT PERIBADI</td>
        </tr>
        <div>
            <tr class="gap-left">
                <td style="width: 30%" class="gap-top">Nama</td>
                <td style="width: 2%" class="gap-top">:</td>
                <td class="gap-top">{{$klien->nama}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 30%">No. Kad Pengenalan</td>
                <td style="width: 2%">:</td>
                <td>{{$klien->no_kp}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 30%">Nombor Telefon</td>
                <td style="width: 2%">:</td>
                <td>{{$klien->no_tel}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 30%">Alamat E-mel</td>
                <td style="width: 2%">:</td>
                <td>{{$klien->emel}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 30%">Alamat Rumah</td>
                <td style="width: 2%">:</td>
                <td>{{$klien->alamat_rumah}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 30%">Poskod</td>
                <td style="width: 2%">:</td>
                <td>{{$klien->poskod}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 30%">Daerah</td>
                <td style="width: 2%">:</td>
                <td>{{$daerahKlien}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 30%">Negeri</td>
                <td style="width: 2%">:</td>
                <td>{{$negeriKlien}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 30%">Jantina</td>
                <td style="width: 2%">:</td>
                <td>{{$klien->jantina}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 30%">Bangsa</td>
                <td style="width: 2%">:</td>
                <td>{{$klien->bangsa}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 30%">Agama</td>
                <td style="width: 2%">:</td>
                <td>{{$klien->agama}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 30%">Tarikh Tamat Pengawasan</td>
                <td style="width: 2%">:</td>
                <td class="gap-bottom">{{$klien->tarikh_tamat_pengawasan}}</td>
            </tr>
        </div>

        <tr>
            <td class="header-part" colspan="3">B. MAKLUMAT PEKERJAAN</td>
        </tr>
        <div>
            <tr class="gap-left">
                <td style="width: 30%" class="gap-top">Pekerjaan</td>
                <td style="width: 2%" class="gap-top">:</td>
                <td class="gap-top">{{$pekerjaan->pekerjaan}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 30%">Pendapatan Bulanan (RM)</td>
                <td style="width: 2%">:</td>
                <td>{{$pekerjaan->pendapatan}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 30%">Bidang Perkerjaan</td>
                <td style="width: 2%">:</td>
                <td>{{$pekerjaan->bidang_kerja}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 30%">Alamat Tempat Bekerja</td>
                <td style="width: 2%">:</td>
                <td>{{$pekerjaan->alamat_kerja}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 30%">Poskod Tempat Bekerja</td>
                <td style="width: 2%">:</td>
                <td>{{$pekerjaan->poskod_kerja}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 30%">Daerah Tempat Bekerja</td>
                <td style="width: 2%">:</td>
                <td>{{$daerahKerja}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 30%">Negeri Tempat Bekerja</td>
                <td style="width: 2%">:</td>
                <td>{{$negeriKerja}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 30%">Nama Majikan</td>
                <td style="width: 2%">:</td>
                <td>{{$pekerjaan->nama_majikan}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 30%">Nombor Telefon Majikan</td>
                <td style="width: 2%">:</td>
                <td  class="gap-bottom">{{$pekerjaan->no_tel_majikan}}</td>
            </tr>
        </div>

        <tr>
            <td class="header-part" colspan="3">C. MAKLUMAT KELUARGA</td>
        </tr>
        <div>
            <tr class="gap-left">
                <td style="width: 30%" class="gap-top">Nama Waris</td>
                <td style="width: 2%" class="gap-top">:</td>
                <td class="gap-top">{{$keluarga->nama_waris}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 30%">Nombor Telefon Waris</td>
                <td style="width: 2%">:</td>
                <td>{{$keluarga->no_tel_waris}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 30%">Hubungan Waris</td>
                <td style="width: 2%">:</td>
                <td>{{$keluarga->hubungan_waris}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 30%">Alamat Waris</td>
                <td style="width: 2%">:</td>
                <td>{{$keluarga->alamat_waris}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 30%">Poskod Waris</td>
                <td style="width: 2%">:</td>
                <td>{{$keluarga->poskod_waris}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 30%">Daerah Waris</td>
                <td style="width: 2%">:</td>
                <td>{{$daerahWaris}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 30%">Negeri Waris</td>
                <td style="width: 2%">:</td>
                <td>{{$negeriWaris}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 30%">Nama Pasangan</td>
                <td style="width: 2%">:</td>
                <td>{{$keluarga->nama_pasangan}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 30%">Nombor Telefon Pasangan</td>
                <td style="width: 2%">:</td>
                <td>{{$keluarga->no_tel_pasangan}}</td>
            </tr>
            <tr class="gap-left">
                <td class="gap-bottom" style="width: 30%">Alamat Pasangan</td>
                <td class="gap-bottom" style="width: 2%">:</td>
                <td>{{$keluarga->alamat_pasangan}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 30%">Poskod Pasangan</td>
                <td style="width: 2%">:</td>
                <td>{{$keluarga->poskod_pasangan}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 30%">Daerah Pasangan</td>
                <td style="width: 2%">:</td>
                <td>{{$daerahPasangan}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 30%">Negeri Pasangan</td>
                <td style="width: 2%">:</td>
                <td>{{$negeriPasangan}}</td>
            </tr>
            <tr class="gap-left">
                <td class="gap-bottom" style="width: 30%">Alamat Tempat Pasangan Bekerja</td>
                <td class="gap-bottom" style="width: 2%">:</td>
                <td>{{$keluarga->alamat_kerja_pasangan}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 30%">Poskod Tempat Pasangan Bekerja</td>
                <td style="width: 2%">:</td>
                <td>{{$keluarga->poskod_kerja_pasangan}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 30%">Daerah Tempat Pasangan Bekerja</td>
                <td style="width: 2%">:</td>
                <td>{{$daerahKerjaPasangan}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 30%">Negeri Tempat Pasangan Bekerja</td>
                <td style="width: 2%">:</td>
                <td class="gap-bottom">{{$negeriKerjaPasangan}}</td>
            </tr>
        </div>
    </table> --}}
</body>
