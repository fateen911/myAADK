<!DOCTYPE html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            position: relative;
            z-index: 1;
        }

        .tittle
        {
            background-color: lightgray;
            font-weight: bold;
            padding: 8px;
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
            background-image: url('logo/mySupport-bw.png');
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
        $daerahKlien = $klien && isset($klien['daerah'])
                        ? DB::table('senarai_daerah')->where('id', $klien['daerah'])->value('senarai_daerah.daerah')
                        : null;

        $negeriKlien = $klien && isset($klien['negeri'])
                        ? DB::table('senarai_negeri')->where('id', $klien['negeri'])->value('senarai_negeri.negeri')
                        : null;

        $daerahKerja = $pekerjaan && isset($pekerjaan['daerah_kerja'])
                        ? DB::table('senarai_daerah')->where('id', $pekerjaan['daerah_kerja'])->value('senarai_daerah.daerah')
                        : null;

        $negeriKerja = $pekerjaan && isset($pekerjaan['negeri_kerja'])
                        ? DB::table('senarai_negeri')->where('id', $pekerjaan['negeri_kerja'])->value('senarai_negeri.negeri')
                        : null;

        $daerahBapa = $waris && isset($waris['daerah_bapa'])
                        ? DB::table('senarai_daerah')->where('id', $waris['daerah_bapa'])->value('senarai_daerah.daerah')
                        : null;

        $negeriBapa = $waris && isset($waris['negeri_bapa'])
                        ? DB::table('senarai_negeri')->where('id', $waris['negeri_bapa'])->value('senarai_negeri.negeri')
                        : null;

        $daerahIbu = $waris && isset($waris['daerah_ibu'])
                        ? DB::table('senarai_daerah')->where('id', $waris['daerah_ibu'])->value('senarai_daerah.daerah')
                        : null;

        $negeriIbu = $waris && isset($waris['negeri_ibu'])
                        ? DB::table('senarai_negeri')->where('id', $waris['negeri_ibu'])->value('senarai_negeri.negeri')
                        : null;

        $daerahPenjaga = $waris && isset($waris['daerah_penjaga'])
                        ? DB::table('senarai_daerah')->where('id', $waris['daerah_penjaga'])->value('senarai_daerah.daerah')
                        : null;

        $negeriPenjaga = $waris && isset($waris['negeri_penjaga'])
                        ? DB::table('senarai_negeri')->where('id', $waris['negeri_penjaga'])->value('senarai_negeri.negeri')
                        : null;

        $daerahPasangan = $pasangan && isset($pasangan['daerah_pasangan'])
                            ? DB::table('senarai_daerah')->where('id', $pasangan['daerah_pasangan'])->value('senarai_daerah.daerah')
                            : null;

        $negeriPasangan = $pasangan && isset($pasangan['negeri_pasangan'])
                            ? DB::table('senarai_negeri')->where('id', $pasangan['negeri_pasangan'])->value('senarai_negeri.negeri')
                            : null;

        $daerahKerjaPasangan = $pasangan && isset($pasangan['daerah_kerja_pasangan'])
                                ? DB::table('senarai_daerah')->where('id', $pasangan['daerah_kerja_pasangan'])->value('senarai_daerah.daerah')
                                : null;

        $negeriKerjaPasangan = $pasangan && isset($pasangan['negeri_kerja_pasangan'])
                                ? DB::table('senarai_negeri')->where('id', $pasangan['negeri_kerja_pasangan'])->value('senarai_negeri.negeri')
                                : null;

        $agamaKlien = DB::table('senarai_agama')->where('id', $klien->agama)->value('senarai_agama.agama');

        $bangsaKlien = DB::table('senarai_bangsa')->where('id', $klien->bangsa)->value('senarai_bangsa.bangsa');

        $penyakitKlien = DB::table('senarai_penyakit')->where('id', $klien->penyakit)->value('senarai_penyakit.penyakit');

        $pendidikanKlien = DB::table('senarai_pendidikan')->where('id', $klien->tahap_pendidikan)->value('senarai_pendidikan.pendidikan');

        $bidangKerja = $pekerjaan && isset($pekerjaan['bidang_kerja']) ? DB::table('senarai_bidang_pekerjaan')->where('id', $pekerjaan['bidang_kerja'])->value('senarai_bidang_pekerjaan.bidang') : null;

        $namaKerja = $pekerjaan && isset($pekerjaan['nama_kerja']) ? DB::table('senarai_pekerjaan')->where('id', $pekerjaan['nama_kerja'])->value('senarai_pekerjaan.pekerjaan') : null;

        $pendapatanBulanan = $pekerjaan && isset($pekerjaan['pendapatan']) ? DB::table('senarai_pendapatan')->where('id', $pekerjaan['pendapatan'])->value('senarai_pendapatan.pendapatan') : null;

        $namaMajikan = $pekerjaan && isset($pekerjaan['nama_majikan']) ? DB::table('senarai_majikan')->where('id', $pekerjaan['nama_majikan'])->value('senarai_majikan.majikan') : null;

        $daerah_asal = DB::table('pejabat_pengawasan_klien')->where('klien_id', $klien->id)->value('pejabat_pengawasan_klien.daerah_aadk_asal');

        $tamatRPDK = DB::table('senarai_daerah_pejabat')->where('kod', $daerah_asal)->value('senarai_daerah_pejabat.daerah');

        $daerah1 = DB::table('pejabat_pengawasan_klien')->where('klien_id', $klien->id)->select('daerah_aadk_baru', 'daerah_aadk_asal')->first();

        $daerah_semasa = null;

        if ($daerah1) {
            $daerah_semasa = $daerah1->daerah_aadk_baru ?? $daerah1->daerah_aadk_asal;
        }

        $daerahPCCP = DB::table('senarai_daerah_pejabat')->where('kod', $daerah_semasa)->value('daerah');
    @endphp

    <table class="profile-form no-break">
        <tr class="no-break">
            <td class="text-center" colspan="3" style="text-align: center;">
                <div class="header">
                    <img src="{{ public_path('logo/mySupport.png') }}" alt="Logo AADK" style="width: 18%; height: 12%;">
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
                <td style="width: 35%">No. Telefon</td>
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
                <td>{{$klien->jantina == 'L' ? 'LELAKI' : 'PEREMPUAN'}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Agama</td>
                <td style="width: 2%">:</td>
                <td>{{$agamaKlien}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Bangsa</td>
                <td style="width: 2%">:</td>
                <td>{{$bangsaKlien}}</td>
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
                <td class="gap-bottom">{{$pendidikanKlien}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Penyakit</td>
                <td style="width: 2%">:</td>
                <td>{{$penyakitKlien}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Status Orang Kurang Upaya (OKU)</td>
                <td style="width: 2%">:</td>
                <td>{{$klien->status_oku}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Skor CCRI</td>
                <td style="width: 2%">:</td>
                <td>
                    {{$klien->skor_ccri}}
                    @if($klien->skor_ccri < 40)
                        (TIDAK MEMUASKAN)
                    @elseif($klien->skor_ccri >= 40 && $klien->skor_ccri <= 60)
                        (MEMUASKAN)
                    @elseif($klien->skor_ccri >= 61 && $klien->skor_ccri <= 79)
                        (BAIK)
                    @elseif($klien->skor_ccri >= 80)
                        (CEMERLANG)
                    @endif
                </td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Tamat RPDK</td>
                <td style="width: 2%">:</td>
                <td class="gap-bottom">{{$tamatRPDK}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">Daerah Semasa PCCP</td>
                <td style="width: 2%">:</td>
                <td>{{$daerahPCCP}}</td>
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
                <td style="width: 35%">No. Kad Pengenalan</td>
                <td style="width: 2%">:</td>
                <td>{{$waris->no_kp_bapa}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">No. Telefon</td>
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
                <td style="width: 35%">No. Kad Pengenalan</td>
                <td style="width: 2%">:</td>
                <td>{{$waris->no_kp_ibu}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">No. Telefon</td>
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
                <td style="width: 35%">No. Kad Pengenalan</td>
                <td style="width: 2%">:</td>
                <td>{{$waris->no_kp_penjaga}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%">No. Telefon</td>
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

            @if ($pasangan->status_perkahwinan == 'BERKAHWIN')
                <tr class="gap-left">
                    <td style="width: 35%">Nama Pasangan</td>
                    <td style="width: 2%">:</td>
                    <td>{{$pasangan->nama_pasangan}}</td>
                </tr>
                <tr class="gap-left">
                    <td style="width: 35%">No. Telefon Pasangan</td>
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
            @endif

            <tr>
                <td class="header-part" colspan="3">D. MAKLUMAT PEKERJAAN</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 35%" class="gap-top">Status Pekerjaan</td>
                <td style="width: 2%" class="gap-top">:</td>
                <td class="gap-top">{{$pekerjaan->status_kerja ?? ''}}</td>
            </tr>

            @if ($pekerjaan->status_kerja == 'BEKERJA')
                <tr class="gap-left">
                    <td style="width: 35%" class="gap-top">Bidang Pekerjaan</td>
                    <td style="width: 2%" class="gap-top">:</td>
                    <td class="gap-top">{{$bidangKerja}}</td>
                </tr>
                <tr class="gap-left">
                    <td style="width: 35%" class="gap-top">Nama Pekerjaan</td>
                    <td style="width: 2%" class="gap-top">:</td>
                    <td class="gap-top">{{$namaKerja}}</td>
                </tr>
                <tr class="gap-left">
                    <td style="width: 35%">Pendapatan Bulanan (RM)</td>
                    <td style="width: 2%">:</td>
                    <td>{{$pendapatanBulanan}}</td>
                </tr>
                <tr class="gap-left">
                    <td style="width: 35%">Kategori Majikan</td>
                    <td style="width: 2%">:</td>
                    <td>{{$pekerjaan->kategori_majikan ?? ''}}</td>
                </tr>
                <tr class="gap-left">
                    <td style="width: 35%">Nama Majikan</td>
                    <td style="width: 2%">:</td>
                    <td>
                        {{$namaMajikan}}
                        @if ($namaMajikan == 'LAIN-LAIN')
                            ({{$pekerjaan->lain_lain_majikan ?? ''}})
                        @endif
                    </td>
                </tr>
                <tr class="gap-left">
                    <td style="width: 35%">No. Telefon Majikan</td>
                    <td style="width: 2%">:</td>
                    <td class="gap-bottom">{{$pekerjaan->no_tel_majikan ?? ''}}</td>
                </tr>
                <tr class="gap-left">
                    <td style="width: 35%">Alamat Tempat Bekerja</td>
                    <td style="width: 2%">:</td>
                    <td>{{$pekerjaan->alamat_kerja ?? ''}}</td>
                </tr>
                <tr class="gap-left">
                    <td style="width: 35%">Poskod Tempat Bekerja</td>
                    <td style="width: 2%">:</td>
                    <td>{{$pekerjaan->poskod_kerja ?? ''}}</td>
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
            @else
                <tr class="gap-left">
                    <td style="width: 35%" class="gap-top">Alasan Tidak Bekerja</td>
                    <td style="width: 2%" class="gap-top">:</td>
                    <td class="gap-top">{{$pekerjaan->alasan_tidak_kerja ?? ''}}</td>
                </tr>
            @endif

            @if($perekodan->isNotEmpty())
                <!--Aktiviti-->
                <br>
                <tr>
                    <td class="header-part" colspan="3">E. REKOD KEHADIRAN AKTIVITI</td>
                </tr>
                <br>
                <!--iteration in roman-->
                @php
                    function toRoman($num) {
                        $map = [
                            'M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400,
                            'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40,
                            'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1
                        ];
                        $result = '';
                        foreach ($map as $roman => $value) {
                            while ($num >= $value) {
                                $result .= $roman;
                                $num -= $value;
                            }
                        }
                        return $result;
                    }
                @endphp
                @foreach($perekodan as $index => $rekod)
                    @php
                        $kategori = DB::table('kategori_program')->where('id', $rekod->program->kategori_id)->value('nama');
                    @endphp
                    <tr>
                        <td class="subheader" colspan="3"> {{ toRoman($index+1)}}) {{strtoupper($rekod->program->nama)}}</td>
                    </tr>
                    <tr class="gap-left">
                        <td style="width: 35%" class="gap-top">ID</td>
                        <td style="width: 2%" class="gap-top">:</td>
                        <td class="gap-top">{{strtoupper($rekod->program->custom_id)}}</td>
                    </tr>
                    <tr class="gap-left">
                        <td style="width: 35%" class="gap-top">Kategori</td>
                        <td style="width: 2%" class="gap-top">:</td>
                        <td class="gap-top">{{strtoupper($kategori)}}</td>
                    </tr>
                    <tr class="gap-left">
                        <td style="width: 35%" class="gap-top">Tempat</td>
                        <td style="width: 2%" class="gap-top">:</td>
                        <td class="gap-top">{{strtoupper($rekod->program->tempat)}}</td>
                    </tr>
                    <tr class="gap-left">
                        <td style="width: 35%" class="gap-top">Tarikh</td>
                        <td style="width: 2%" class="gap-top">:</td>
                        <td class="gap-top">{{date('d/m/Y, h:iA', strtotime($rekod->program->tarikh_mula))}}</td>
                    </tr>
                    <br>
                @endforeach
            @endif
        </tbody>
    </table>

    @foreach ($modalKepulihan as $sesi => $modalData)
        @php
            // Fetch corresponding keputusan kepulihan record for the same sesi
            $kepulihan = $keputusanKepulihan[$sesi] ?? null;
        @endphp

        @if ($kepulihan)
            <div style="page-break-before: always;"></div>

            <div class="tittle">F. SEJARAH SOAL SELIDIK MODAL KEPULIHAN</div>

            <br>
            <div class="mt-10">
                @php
                    $tahap_kepulihan = DB::table('tahap_kepulihan')->where('id', $kepulihan->tahap_kepulihan_id)->value('tahap_kepulihan.tahap');
                @endphp
                <b>TAHAP KEPULIHAN:</b>
                @if ($kepulihan->tahap_kepulihan_id == 1)
                    <badge class="badge text-white" style="background-color: red; padding:5px;">{{ $tahap_kepulihan }} (SKOR: {{ number_format($kepulihan->skor, 2) }})</badge>
                @elseif ($kepulihan->tahap_kepulihan_id == 2)
                    <badge class="badge text-white" style="background-color: darkorange; padding:5px;">{{ $tahap_kepulihan }} (SKOR: {{ number_format($kepulihan->skor, 2) }})</badge>
                @elseif ($kepulihan->tahap_kepulihan_id == 3)
                    <badge class="badge text-white" style="background-color: #ffc107; padding: 5px;">{{ $tahap_kepulihan }} (SKOR: {{ number_format($kepulihan->skor, 2) }})</badge>
                @else
                    <badge class="badge text-white" style="background-color: green; padding:5px;">{{ $tahap_kepulihan }} (SKOR: {{ number_format($kepulihan->skor, 2) }})</badge>
                @endif
            </div>
            <br>
            <div class="mt-10">
                <b>TARIKH MENJAWAB:</b> {{ date('d/m/Y', strtotime($kepulihan->updated_at)) }}
            </div>
            <br>

            <table width="100%" border="1" cellspacing="0" cellpadding="5">
                <tr style="background-color: #CCC">
                    <th>Modal Kepulihan</th>
                    <th>Skor</th>
                    <th>Tahap Kepulihan</th>
                </tr>
                @foreach ($modalData as $modal)
                    <tr style="text-align: center;">
                        <td>Fizikal</td>
                        <td>{{ number_format($modal->modal_fizikal, 2) }}</td>
                        <td>
                            @if($modal->modal_fizikal >= 1.0 && $modal->modal_fizikal <= 1.5)
                                <badge class="badge badge-danger" style="background-color: red; padding:5px; width:250px; display: inline-block;">
                                    SANGAT TIDAK MEMUASKAN
                                </badge>
                            @elseif($modal->modal_fizikal > 1.5 && $modal->modal_fizikal <= 2.5)
                                <badge class="badge" style="background-color: darkorange; padding:5px; width:250px; display: inline-block;">
                                    KURANG MEMUASKAN
                                </badge>
                            @elseif($modal->modal_fizikal > 2.5 && $modal->modal_fizikal <= 3.5)
                                <badge class="badge" style="background-color: #ffc107; padding:5px; width:250px; display: inline-block;">
                                    MEMUASKAN
                                </badge>
                            @elseif($modal->modal_fizikal > 3.5 && $modal->modal_fizikal <= 4.0)
                                <badge class="badge" style="background-color: green; padding:5px; width:250px; display: inline-block;">
                                    SANGAT MEMUASKAN
                                </badge>
                            @endif
                        </td>
                    </tr>
                    <tr style="text-align: center;">
                        <td>Psikologi</td>
                        <td>{{ number_format($modal->modal_psikologi, 2) }}</td>
                        <td>
                            @if($modal->modal_psikologi >= 1.0 && $modal->modal_psikologi <= 1.5)
                                <badge class="badge badge-danger" style="background-color: red; padding:5px; width:250px; display: inline-block;">
                                    SANGAT TIDAK MEMUASKAN
                                </badge>
                            @elseif($modal->modal_psikologi > 1.5 && $modal->modal_psikologi <= 2.5)
                                <badge class="badge" style="background-color: darkorange; padding:5px; width:250px; display: inline-block;">
                                    KURANG MEMUASKAN
                                </badge>
                            @elseif($modal->modal_psikologi > 2.5 && $modal->modal_psikologi <= 3.5)
                                <badge class="badge" style="background-color: #ffc107; padding:5px; width:250px; display: inline-block;">
                                    MEMUASKAN
                                </badge>
                            @elseif($modal->modal_psikologi > 3.5 && $modal->modal_psikologi <= 4.0)
                                <badge class="badge" style="background-color: green; padding:5px; width:250px; display: inline-block;">
                                    SANGAT MEMUASKAN
                                </badge>
                            @endif
                        </td>
                    </tr>
                    <tr style="text-align: center;">
                        <td>Sosial</td>
                        <td>{{ number_format($modal->modal_sosial, 2) }}</td>
                        <td>
                            @if($modal->modal_sosial >= 1.0 && $modal->modal_sosial <= 1.5)
                                <badge class="badge badge-danger" style="background-color: red; padding:5px; width:250px; display: inline-block;">
                                    SANGAT TIDAK MEMUASKAN
                                </badge>
                            @elseif($modal->modal_sosial > 1.5 && $modal->modal_sosial <= 2.5)
                                <badge class="badge" style="background-color: darkorange; padding:5px; width:250px; display: inline-block;">
                                    KURANG MEMUASKAN
                                </badge>
                            @elseif($modal->modal_sosial > 2.5 && $modal->modal_sosial <= 3.5)
                                <badge class="badge" style="background-color: #ffc107; padding:5px; width:250px; display: inline-block;">
                                    MEMUASKAN
                                </badge>
                            @elseif($modal->modal_sosial > 3.5 && $modal->modal_sosial <= 4.0)
                                <badge class="badge" style="background-color: green; padding:5px; width:250px; display: inline-block;">
                                    SANGAT MEMUASKAN
                                </badge>
                            @endif
                        </td>
                    </tr>
                    <tr style="text-align: center;">
                        <td>Persekitaran</td>
                        <td>{{ number_format($modal->modal_persekitaran, 2) }}</td>
                        <td>
                            @if($modal->modal_persekitaran >= 1.0 && $modal->modal_persekitaran <= 1.5)
                                <badge class="badge badge-danger" style="background-color: red; padding:5px; width:250px; display: inline-block;">
                                    SANGAT TIDAK MEMUASKAN
                                </badge>
                            @elseif($modal->modal_persekitaran > 1.5 && $modal->modal_persekitaran <= 2.5)
                                <badge class="badge" style="background-color: darkorange; padding:5px; width:250px; display: inline-block;">
                                    KURANG MEMUASKAN
                                </badge>
                            @elseif($modal->modal_persekitaran > 2.5 && $modal->modal_persekitaran <= 3.5)
                                <badge class="badge" style="background-color: #ffc107; color: black; padding:5px; width:250px; display: inline-block;">
                                    MEMUASKAN
                                </badge>
                            @elseif($modal->modal_persekitaran > 3.5 && $modal->modal_persekitaran <= 4.0)
                                <badge class="badge" style="background-color: green; padding:5px; width:250px; display: inline-block;">
                                    SANGAT MEMUASKAN
                                </badge>
                            @endif
                        </td>
                    </tr>
                    <tr style="text-align: center;">
                        <td>Insaniah</td>
                        <td>{{ number_format($modal->modal_insaniah, 2) }}</td>
                        <td>
                            @if($modal->modal_insaniah >= 1.0 && $modal->modal_insaniah <= 1.5)
                                <badge class="badge badge-danger" style="background-color: red; padding:5px; width:250px; display: inline-block;">
                                    SANGAT TIDAK MEMUASKAN
                                </badge>
                            @elseif($modal->modal_insaniah > 1.5 && $modal->modal_insaniah <= 2.5)
                                <badge class="badge" style="background-color: darkorange; padding:5px; width:250px; display: inline-block;">
                                    KURANG MEMUASKAN
                                </badge>
                            @elseif($modal->modal_insaniah > 2.5 && $modal->modal_insaniah <= 3.5)
                                <badge class="badge" style="background-color: #ffc107; color: black; padding:5px; width:250px; display: inline-block;">
                                    MEMUASKAN
                                </badge>
                            @elseif($modal->modal_insaniah > 3.5 && $modal->modal_insaniah <= 4.0)
                                <badge class="badge" style="background-color: green; padding:5px; width:250px; display: inline-block;">
                                    SANGAT MEMUASKAN
                                </badge>
                            @endif
                        </td>
                    </tr>
                    <tr style="text-align: center;">
                        <td>Strategi Daya Tahan</td>
                        <td>{{ number_format($modal->modal_strategi_daya_tahan, 2) }}</td>
                        <td>
                            @if($modal->modal_strategi_daya_tahan >= 1.0 && $modal->modal_strategi_daya_tahan <= 1.5)
                                <badge class="badge badge-danger" style="background-color: red; padding:5px; width:250px; display: inline-block;">
                                    SANGAT TIDAK MEMUASKAN
                                </badge>
                            @elseif($modal->modal_strategi_daya_tahan > 1.5 && $modal->modal_strategi_daya_tahan <= 2.5)
                                <badge class="badge" style="background-color: darkorange; padding:5px; width:250px; display: inline-block;">
                                    KURANG MEMUASKAN
                                </badge>
                            @elseif($modal->modal_strategi_daya_tahan > 2.5 && $modal->modal_strategi_daya_tahan <= 3.5)
                                <badge class="badge" style="background-color: #ffc107; color: black; padding:5px; width:250px; display: inline-block;">
                                    MEMUASKAN
                                </badge>
                            @elseif($modal->modal_strategi_daya_tahan > 3.5 && $modal->modal_strategi_daya_tahan <= 4.0)
                                <badge class="badge" style="background-color: green; padding:5px; width:250px; display: inline-block;">
                                    SANGAT MEMUASKAN
                                </badge>
                            @endif
                        </td>
                    </tr>
                    <tr style="text-align: center;">
                        <td>Resiliensi</td>
                        <td>{{ number_format($modal->modal_resiliensi, 2) }}</td>
                        <td>
                            @if($modal->modal_resiliensi >= 1.0 && $modal->modal_resiliensi <= 1.5)
                                <badge class="badge badge-danger" style="background-color: red; padding:5px; width:250px; display: inline-block;">
                                    SANGAT TIDAK MEMUASKAN
                                </badge>
                            @elseif($modal->modal_resiliensi > 1.5 && $modal->modal_resiliensi <= 2.5)
                                <badge class="badge" style="background-color: darkorange; padding:5px; width:250px; display: inline-block;">
                                    KURANG MEMUASKAN
                                </badge>
                            @elseif($modal->modal_resiliensi > 2.5 && $modal->modal_resiliensi <= 3.5)
                                <badge class="badge" style="background-color: #ffc107; color: black; padding:5px; width:250px; display: inline-block;">
                                    MEMUASKAN
                                </badge>
                            @elseif($modal->modal_resiliensi > 3.5 && $modal->modal_resiliensi <= 4.0)
                                <badge class="badge" style="background-color: green; padding:5px; width:250px; display: inline-block;">
                                    SANGAT MEMUASKAN
                                </badge>
                            @endif
                        </td>
                    </tr>
                    <tr style="text-align: center;">
                        <td>Spiritual</td>
                        <td>{{ number_format($modal->modal_spiritual, 2) }}</td>
                        <td>
                            @if($modal->modal_spiritual >= 1.0 && $modal->modal_spiritual <= 1.5)
                                <badge class="badge badge-danger" style="background-color: red; padding:5px; width:250px; display: inline-block;">
                                    SANGAT TIDAK MEMUASKAN
                                </badge>
                            @elseif($modal->modal_spiritual > 1.5 && $modal->modal_spiritual <= 2.5)
                                <badge class="badge" style="background-color: darkorange; padding:5px; width:250px; display: inline-block;">
                                    KURANG MEMUASKAN
                                </badge>
                            @elseif($modal->modal_spiritual > 2.5 && $modal->modal_spiritual <= 3.5)
                                <badge class="badge" style="background-color: #ffc107; color: black; padding:5px; width:250px; display: inline-block;">
                                    MEMUASKAN
                                </badge>
                            @elseif($modal->modal_spiritual > 3.5 && $modal->modal_spiritual <= 4.0)
                                <badge class="badge" style="background-color: green; padding:5px; width:250px; display: inline-block;">
                                    SANGAT MEMUASKAN
                                </badge>
                            @endif
                        </td>
                    </tr>
                    <tr style="text-align: center;">
                        <td>Rawatan</td>
                        <td>{{ number_format($modal->modal_rawatan, 2) }}</td>
                        <td>
                            @if($modal->modal_rawatan >= 1.0 && $modal->modal_rawatan <= 1.5)
                                <badge class="badge badge-danger" style="background-color: red; padding:5px; width:250px; display: inline-block;">
                                    SANGAT TIDAK MEMUASKAN
                                </badge>
                            @elseif($modal->modal_rawatan > 1.5 && $modal->modal_rawatan <= 2.5)
                                <badge class="badge" style="background-color: darkorange; padding:5px; width:250px; display: inline-block;">
                                    KURANG MEMUASKAN
                                </badge>
                            @elseif($modal->modal_rawatan > 2.5 && $modal->modal_rawatan <= 3.5)
                                <badge class="badge" style="background-color: #ffc107; color: black; padding:5px; width:250px; display: inline-block;">
                                    MEMUASKAN
                                </badge>
                            @elseif($modal->modal_rawatan > 3.5 && $modal->modal_rawatan <= 4.0)
                                <badge class="badge" style="background-color: green; padding:5px; width:250px; display: inline-block;">
                                    SANGAT MEMUASKAN
                                </badge>
                            @endif
                        </td>
                    </tr>
                    <tr style="text-align: center;">
                        <td>Kesihatan</td>
                        <td>{{ number_format($modal->modal_kesihatan, 2) }}</td>
                        <td>
                            @if($modal->modal_kesihatan >= 1.0 && $modal->modal_kesihatan <= 1.5)
                                <badge class="badge badge-danger" style="background-color: red; padding:5px; width:250px; display: inline-block;">
                                    SANGAT TIDAK MEMUASKAN
                                </badge>
                            @elseif($modal->modal_kesihatan > 1.5 && $modal->modal_kesihatan <= 2.5)
                                <badge class="badge" style="background-color: darkorange; padding:5px; width:250px; display: inline-block;">
                                    KURANG MEMUASKAN
                                </badge>
                            @elseif($modal->modal_kesihatan > 2.5 && $modal->modal_kesihatan <= 3.5)
                                <badge class="badge" style="background-color: #ffc107; color: black; padding:5px; width:250px; display: inline-block;">
                                    MEMUASKAN
                                </badge>
                            @elseif($modal->modal_kesihatan > 3.5 && $modal->modal_kesihatan <= 4.0)
                                <badge class="badge" style="background-color: green; padding:5px; width:250px; display: inline-block;">
                                    SANGAT MEMUASKAN
                                </badge>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
        @endif
    @endforeach
</body>
