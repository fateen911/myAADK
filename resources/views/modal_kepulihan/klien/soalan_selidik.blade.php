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
            display: flex;
            flex-direction: column;
            align-items: center !important;
            justify-content: center !important;
            margin: 0 auto 0 auto; /* Center horizontally using auto margins */
            width: auto;
            max-width: 600px;
            margin-top: 60px !important;
        }

        .card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .card-body {
            padding: 20px;
            text-align: center;
        }

        .card-header {
            display: flex;
            align-items: center !important; /* Vertically align items */
            padding: 15px;
            margin-top: 15px;
            border-bottom: 1px solid #f0f0f0;
        }

        .profile-icon {
            transform: scale(0.8);
            margin-right: 10px; /* Space between the icon and name */
        }

        .profile-name h2 {
            margin: 0; /* Remove default margin from h2 */
            font-size: 18px; /* Adjust the name font size */
        }

        .card-header .profile-icon {
            font-size: 30px;
            color: #000;
            margin-right: 20px;
        }

        .card-header div {
            flex-grow: 1;
        }

        .status {
            color: white;
            background-color: cornflowerblue;
            padding: 5px 10px;
            border-radius: 15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            width: 80%;
        }

        /* Media Query for Small Screens */
        @media (max-width: 768px) {
            #kt_app_content {
                display: flex;
                justify-content: center;
                align-items: center;
                margin-top: 0;
            }

            .card-flush {
                margin-top: 0px !important;
            }

            .card-header {
                display: flex;
                flex-direction: row; /* Ensure row layout */
                align-items: center; /* Align items vertically in center */
                justify-content: center; /* Center the content horizontally */
                gap: 5px; /*Ad spacing between icon and text */
            }

            .profile-icon {
                transform: scale(0.5); /* Scale down the size */
                margin: 0 !important; /* Reset margins */
            }

            .profile-name h2 {
                font-size: 15px;
                margin: 0;
            }

            .card-body {
                padding: 6px;
                font-size: 12px;
            }

            .status {
                font-size: 12px;
                padding: 8px;
                margin-top: 20px;
                margin-bottom: 20px;
            }

            .error-message {
                font-size: 12px;
            }
        }

        @media (max-width: 425px) {
            #kt_app_content {
                display: flex;
                justify-content: center;
                align-items: center;
                margin-top: 0;
            }

            .card-flush {
                margin-top: 0px !important;
            }

            .card-header {
                display: flex;
                flex-direction: row; /* Ensure row layout */
                align-items: center; /* Align items vertically in center */
                justify-content: center; /* Center the content horizontally */
                padding: 0 !important;
            }

            .profile-icon {
                transform: scale(0.4); /* Scale down the size */
                margin: 0 !important; /* Reset margins */
            }

            .profile-name h2 {
                font-size: 14px;
                margin: 0;
            }

            .status {
                font-size: 12px;
                padding: 8px;
                margin-top: 20px;
                margin-bottom: 20px;
            }

            .error-message {
                font-size: 8px !important;
            }
        }
    </style>
</head>

<!--begin::Page title-->
<div class="page-title flex-column justify-content-center flex-wrap me-3 mb-5">
    <!--begin::Title-->
    <h1 class="page-heading text-dark fw-bold fs-3 flex-column justify-content-center my-0">Modal Kepulihan</h1>
    <!--end::Title-->
    <!--begin::Breadcrumb-->
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">Modal Kepulihan</li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">Soal Selidik</li>
        <!--end::Item-->
    </ul>
    <!--end::Breadcrumb-->
</div>
<!--end::Page title-->

<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-xxl">
        <!--begin::Card flush-->
        <div class="card card-flush">
            <!--begin::Card header-->
            <div class="card-header">
                <i class="fas fa-user profile-icon"></i>
                <div class="profile-name">
                    <h2>{{$klien->nama}}</h2>
                </div>
            </div>
            <!--end::Card header-->

            <!--begin::Card body-->
            <div class="card-body">
                @if(isset($latestRecordKeputusan))
                    @if($latestRecordKeputusan->status == 'Selesai')
                        <p class="text-black fs-5"><b>TARIKH TERAKHIR MENJAWAB SOAL SELIDIK:</b><br> {{ Carbon::parse($latestRecordKeputusan->updated_at)->format('d/m/Y') }}</p>
                        <p class="text-black fs-5"><b>STATUS TERAKHIR MENJAWAB SOAL SELIDIK:</b><br> SELESAI MENJAWAB</p>
                    @else
                        @if ($latestRecordDemografi)
                            <p class="text-black fs-5"><b>TARIKH TERAKHIR MENJAWAB SOAL SELIDIK:</b><br> {{ Carbon::parse($latestRecordDemografi->updated_at)->format('d/m/Y') }}</p>
                            <p class="text-black fs-5"><b>STATUS TERAKHIR MENJAWAB SOAL SELIDIK:</b><br> BELUM SELESAI MENJAWAB</p>
                        @else
                            <p class="text-black fs-5"><b>TARIKH MENJAWAB SOAL SELIDIK:</b></p>
                            <p class="text-black fs-5"><b>STATUS MENJAWAB SOAL SELIDIK:</b><br> BELUM MENJAWAB</p>
                        @endif
                    @endif
                @else
                    @if ($latestRecordDemografi)
                        <p class="text-black fs-5"><b>TARIKH TERAKHIR MENJAWAB SOAL SELIDIK:</b><br> {{ Carbon::parse($latestRecordDemografi->updated_at)->format('d/m/Y') }}</p>
                        <p class="text-black fs-5"><b>STATUS MENJAWAB SOAL SELIDIK:</b><br> BELUM SELESAI MENJAWAB</p>
                    @else
                        <p class="text-black fs-5"><b>TARIKH MENJAWAB SOAL SELIDIK:</b></p>
                        <p class="text-black fs-5"><b>STATUS MENJAWAB SOAL SELIDIK:</b><br> BELUM MENJAWAB</p>
                    @endif
                @endif

                <br>

                @if ($butangMula)
                    <a href="{{ route('klien.soalanDemografi') }}" class="status text-black fs-4 fw-bold">KLIK UNTUK MENJAWAB -></a>
                @else
                    <p style="color:crimson; font-size:14px;">
                        Anda tidak dibenarkan untuk menjawab soal selidik sekarang.<br>Sila cuba selepas 6 bulan dari tarikh terakhir menjawab.
                    </p>
                @endif
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card flush-->
    </div>
    <!--end::Content container-->
</div>
<!--end::Content-->

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

        // Check if there is a flash errors message
        @if(session('errors'))
            Swal.fire({
                icon: 'error',
                title: 'Tidak Berjaya!',
                text: '{!! session('errors') !!}',
                confirmButtonText: 'OK'
            });
        @endif
    });
</script>
@endsection
