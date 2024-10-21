@extends('layouts._default')

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        /* Base styles for all tabs */
        .nav-tabs .nav-item {
            margin-bottom: -1px; /* Prevent bottom margin */
        }

        .nav-link {
            font-size: 16px !important;
            color: #6c757d !important;
            background-color: none;
            border: 1px solid transparent;
            padding: 10px 15px;
            font-family: 'Poppins', sans-serif;
        }

        /* Inactive tabs (flat) */
        .nav-link {
            background-color: transparent;
            color: gray;
            border: none;
            border-bottom: 2px solid transparent;
        }

        /* Active tab with color and shadow */
        .nav-link.active {
            color: darkslateblue !important;
            box-shadow: 0 -4px 12px rgba(0, 123, 255, 0.2);
            background-color: whitesmoke !important; /* Light blue background for active tab */
            color: #8800ff; /* Bold blue font for active tab */
            border-bottom: 2px solid darkslateblue !important; /* Blue underline for active tab */
            font-weight: bold; /* Make font bold */
            border-radius: 4px 4px 0 0; /* Slight rounding at top of active tab */
        }

        /* Add hover effect to inactive tabs */
        .nav-link:hover {
            border-bottom: 2px solid lightgray;
            color: #007bff;
        }

        /* Remove default border */
        .nav-tabs {
            border-bottom: 2px solid lightgray; /* Bottom border for tab container */
        }
    </style>
</head>

@section('content')
    <!--begin::Page title-->
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5">
        <!--begin::Title-->
        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Pelaporan</h1>
        <!--end::Title-->
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
            <!--begin::Item-->
            <li class="breadcrumb-item text-muted">Pelaporan</li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item text-muted">Aktiviti</li>
            <!--end::Item-->
        </ul>
        <!--end::Breadcrumb-->
    </div>
    <!--end::Page title-->

    <div class="card shadow-sm p-5">
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-fluid">

            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berjaya!',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK'
            });
            @endif

            @if(session('passwordUpdateError'))
            Swal.fire({
                icon: 'error',
                title: 'Tidak Berjaya!',
                text: '{{ session('passwordUpdateError') }}',
                confirmButtonText: 'OK'
            });
            @endif
        });
    </script>
@endsection
