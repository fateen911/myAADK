<!DOCTYPE html>
<head>
    <title>{{ config('app.name', 'SistemAADK') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            position: relative;
            z-index: 1;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
        }

        .header img {
            width: 100px;
            height: auto;
        }

        .header h2 {
            margin: 0;
        }

        body::before {
            content: "";
            display: block;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('logo/aadk-removebg.png');
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            opacity: 0.2;
            z-index: -1; /* Place behind content */
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 8px;
            vertical-align: top;
        }

        .header-part {
            background-color: lightgray;
            font-weight: bold;
            margin-top: 10px;
        }

        .gap-top {
            margin-top: 10px;
        }

        .gap-bottom {
            margin-bottom: 10px;
        }

        .gap-left {
            padding-left: 10px;
            font-size: 14px;
        }

        .subheader {
            font-size: 11pt;
            padding: 4px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    @php
        $daerahKlien = DB::table('senarai_daerah')->where('id', $klien['daerah'])->value('senarai_daerah.daerah');
        $negeriKlien = DB::table('senarai_negeri')->where('id', $klien['negeri'])->value('senarai_negeri.negeri');
        $daerahKerja = DB::table('senarai_daerah')->where('id', $pekerjaan['daerah_kerja'])->value('senarai_daerah.daerah');
        $negeriKerja = DB::table('senarai_negeri')->where('id', $pekerjaan['negeri_kerja'])->value('senarai_negeri.negeri');
        $daerahBapa = DB::table('senarai_daerah')->where('id', $waris['daerah_bapa'])->value('senarai_daerah.daerah');
        $negeriBapa = DB::table('senarai_negeri')->where('id', $waris['negeri_bapa'])->value('senarai_negeri.negeri');
        $daerahIbu = DB::table('senarai_daerah')->where('id', $waris['daerah_ibu'])->value('senarai_daerah.daerah');
        $negeriIbu = DB::table('senarai_negeri')->where('id', $waris['negeri_ibu'])->value('senarai_negeri.negeri');
        $daerahPenjaga = DB::table('senarai_daerah')->where('id', $waris['daerah_penjaga'])->value('senarai_daerah.daerah');
        $negeriPenjaga = DB::table('senarai_negeri')->where('id', $waris['negeri_penjaga'])->value('senarai_negeri.negeri');
        $daerahPasangan = DB::table('senarai_daerah')->where('id', $pasangan['daerah_pasangan'])->value('senarai_daerah.daerah');
        $negeriPasangan = DB::table('senarai_negeri')->where('id', $pasangan['negeri_pasangan'])->value('senarai_negeri.negeri');
        $daerahKerjaPasangan = DB::table('senarai_daerah')->where('id', $pasangan['daerah_kerja_pasangan'])->value('senarai_daerah.daerah');
        $negeriKerjaPasangan = DB::table('senarai_negeri')->where('id', $pasangan['negeri_kerja_pasangan'])->value('senarai_negeri.negeri');
    @endphp

    <table class="profile-form no-break">
        <tr class="no-break">
            <td class="text-center" colspan="3" style="text-align: center;">
                <div class="header">
                    <img src="{{ public_path('logo/aadk.png') }}" alt="Logo AADK" style="width: 15%; height: 10%;">
                    <h3>AGENSI ANTIDADAH KEBANGSAAN (AADK)</h3>
                    <b>MAKLUMAT PROFIL PERIBADI</b>
                </div>
            </td>
        </tr>
        
        <tr>
            <td class="header-part" colspan="3">A. MAKLUMAT PERIBADI</td>
        </tr>
        <tbody>
            <tr class="gap-left">
                <td style="width: 35%" class="gap-top">Nama</td>
                <td style="width: 2%" class="gap-top">:</td>
                <td class="gap-top">{{$klien->nama}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">No. Kad Pengenalan</td>
                <td style="width: 2%">:</td>
                <td>{{$klien->no_kp}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Nombor Telefon</td>
                <td style="width: 2%">:</td>
                <td>{{$klien->no_tel}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Alamat E-mel</td>
                <td style="width: 2%">:</td>
                <td>{{$klien->emel}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Jantina</td>
                <td style="width: 2%">:</td>
                <td>{{$klien->jantina}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Agama</td>
                <td style="width: 2%">:</td>
                <td>{{$klien->agama}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Bangsa</td>
                <td style="width: 2%">:</td>
                <td>{{$klien->bangsa}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Alamat Rumah</td>
                <td style="width: 2%">:</td>
                <td>{{$klien->alamat_rumah}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Poskod</td>
                <td style="width: 2%">:</td>
                <td>{{$klien->poskod}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Daerah</td>
                <td style="width: 2%">:</td>
                <td>{{$daerahKlien}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Negeri</td>
                <td style="width: 2%">:</td>
                <td>{{$negeriKlien}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Tahap Pendidikan</td>
                <td style="width: 2%">:</td>
                <td class="gap-bottom">{{$klien->tahap_pendidikan}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Status Kesihatan Mental</td>
                <td style="width: 2%">:</td>
                <td>{{$klien->status_kesihatan_mental}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Status Orang Kurang Upaya (OKU)</td>
                <td style="width: 2%">:</td>
                <td>{{$klien->status_oku}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Skor CCRI</td>
                <td style="width: 2%">:</td>
                <td>{{$klien->skor_ccri}}</td>
            </tr>

            <tr>
                <td class="header-part" colspan="3">B. MAKLUMAT WARIS</td>
            </tr>
            <br>
            <tr>
                <td class="subheader" colspan="3">I) MAKLUMAT BAPA</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%" class="gap-top">Nama</td>
                <td style="width: 2%" class="gap-top">:</td>
                <td class="gap-top">{{$waris->nama_bapa}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">No Kad Pengenalan</td>
                <td style="width: 2%">:</td>
                <td>{{$waris->no_kp_bapa}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Nombor Telefon</td>
                <td style="width: 2%">:</td>
                <td>{{$waris->no_tel_bapa}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Status</td>
                <td style="width: 2%">:</td>
                <td>{{$waris->status_bapa}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Alamat</td>
                <td style="width: 2%">:</td>
                <td>{{$waris->alamat_bapa}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Poskod</td>
                <td style="width: 2%">:</td>
                <td>{{$waris->poskod_bapa}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Daerah</td>
                <td style="width: 2%">:</td>
                <td>{{$daerahBapa}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Negeri</td>
                <td style="width: 2%">:</td>
                <td>{{$negeriBapa}}</td>
            </tr>
            <br>
            <tr>
                <td class="subheader" colspan="3">II) MAKLUMAT IBU</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%" class="gap-top">Nama</td>
                <td style="width: 2%" class="gap-top">:</td>
                <td class="gap-top">{{$waris->nama_ibu}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">No Kad Pengenalan</td>
                <td style="width: 2%">:</td>
                <td>{{$waris->no_kp_ibu}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Nombor Telefon</td>
                <td style="width: 2%">:</td>
                <td>{{$waris->no_tel_ibu}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Status</td>
                <td style="width: 2%">:</td>
                <td>{{$waris->status_ibu}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Alamat</td>
                <td style="width: 2%">:</td>
                <td>{{$waris->alamat_ibu}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Poskod</td>
                <td style="width: 2%">:</td>
                <td>{{$waris->poskod_ibu}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Daerah</td>
                <td style="width: 2%">:</td>
                <td>{{$daerahIbu}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Negeri</td>
                <td style="width: 2%">:</td>
                <td>{{$negeriIbu}}</td>
            </tr>
            <br>
            <tr>
                <td class="subheader" colspan="3">III) MAKLUMAT PENJAGA</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Hubungan</td>
                <td style="width: 2%">:</td>
                <td>{{$waris->hubungan_penjaga}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%" class="gap-top">Nama</td>
                <td style="width: 2%" class="gap-top">:</td>
                <td class="gap-top">{{$waris->nama_penjaga}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">No Kad Pengenalan</td>
                <td style="width: 2%">:</td>
                <td>{{$waris->no_kp_penjaga}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Nombor Telefon</td>
                <td style="width: 2%">:</td>
                <td>{{$waris->no_tel_penjaga}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Status</td>
                <td style="width: 2%">:</td>
                <td>{{$waris->status_penjaga}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Alamat</td>
                <td style="width: 2%">:</td>
                <td>{{$waris->alamat_penjaga}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Poskod</td>
                <td style="width: 2%">:</td>
                <td>{{$waris->poskod_penjaga}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Daerah</td>
                <td style="width: 2%">:</td>
                <td>{{$daerahPenjaga}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Negeri</td>
                <td style="width: 2%">:</td>
                <td>{{$negeriPenjaga}}</td>
            </tr>

            <tr>
                <td class="header-part" colspan="3">C. MAKLUMAT KELUARGA</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Status Perkahwinan</td>
                <td style="width: 2%">:</td>
                <td>{{$pasangan->status_perkahwinan}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Nama Pasangan</td>
                <td style="width: 2%">:</td>
                <td>{{$pasangan->nama_pasangan}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Nombor Telefon Pasangan</td>
                <td style="width: 2%">:</td>
                <td>{{$pasangan->no_tel_pasangan}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Bilangan Anak</td>
                <td style="width: 2%">:</td>
                <td>{{$pasangan->bilangan_anak}}</td>
            </tr>
            <tr class="gap-left">
                <td class="gap-bottom" style="width: 35%">Alamat Rumah Pasangan</td>
                <td class="gap-bottom" style="width: 2%">:</td>
                <td>{{$pasangan->alamat_pasangan}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Poskod</td>
                <td style="width: 2%">:</td>
                <td>{{$pasangan->poskod_pasangan}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Daerah</td>
                <td style="width: 2%">:</td>
                <td>{{$daerahPasangan}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Negeri</td>
                <td style="width: 2%">:</td>
                <td>{{$negeriPasangan}}</td>
            </tr>
            <tr class="gap-left">
                <td class="gap-bottom" style="width: 35%">Alamat Tempat Kerja Pasangan</td>
                <td class="gap-bottom" style="width: 2%">:</td>
                <td>{{$pasangan->alamat_kerja_pasangan}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Poskod</td>
                <td style="width: 2%">:</td>
                <td>{{$pasangan->poskod_kerja_pasangan}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Daerah</td>
                <td style="width: 2%">:</td>
                <td>{{$daerahKerjaPasangan}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Negeri</td>
                <td style="width: 2%">:</td>
                <td class="gap-bottom">{{$negeriKerjaPasangan}}</td>
            </tr>

            <tr>
                <td class="header-part" colspan="3">D. MAKLUMAT PEKERJAAN</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%" class="gap-top">Status</td>
                <td style="width: 2%" class="gap-top">:</td>
                <td class="gap-top">{{$pekerjaan->status_kerja}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%" class="gap-top">Bidang</td>
                <td style="width: 2%" class="gap-top">:</td>
                <td class="gap-top">{{$pekerjaan->bidang_kerja}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%" class="gap-top">Nama</td>
                <td style="width: 2%" class="gap-top">:</td>
                <td class="gap-top">{{$pekerjaan->nama_kerja}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Pendapatan Bulanan (RM)</td>
                <td style="width: 2%">:</td>
                <td>{{$pekerjaan->pendapatan}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Kategori Majikan</td>
                <td style="width: 2%">:</td>
                <td>{{$pekerjaan->kategori_majikan}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Nama Majikan</td>
                <td style="width: 2%">:</td>
                <td>{{$pekerjaan->nama_majikan}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Nombor Telefon Majikan</td>
                <td style="width: 2%">:</td>
                <td class="gap-bottom">{{$pekerjaan->no_tel_majikan}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Alamat Tempat Bekerja</td>
                <td style="width: 2%">:</td>
                <td>{{$pekerjaan->alamat_kerja}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Poskod Tempat Bekerja</td>
                <td style="width: 2%">:</td>
                <td>{{$pekerjaan->poskod_kerja}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Daerah Tempat Bekerja</td>
                <td style="width: 2%">:</td>
                <td>{{$daerahKerja}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Negeri Tempat Bekerja</td>
                <td style="width: 2%">:</td>
                <td>{{$negeriKerja}}</td>
            </tr>
        </tbody>
    </table>
</body>
