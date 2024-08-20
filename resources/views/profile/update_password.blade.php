@extends('layouts._default')

@section('content')
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

        <style>
            .position-relative {
                position: relative;
            }
    
            .toggle-password {
                position: absolute;
                top: 50%;
                right: 15px;
                transform: translateY(-50%);
                cursor: pointer;
            }
    
            .eye-icon {
                font-size: 1.25rem;
                color: #6c757d;
                padding-right: 10px;
            }
        </style>
    </head>

    <!--begin::Page title-->
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5">
        <!--begin::Title-->
        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Kemaskini</h1>
        <!--end::Title-->
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
            <!--begin::Item-->
            <li class="breadcrumb-item text-muted">
                <a href="../../demo1/dist/index.html" class="text-muted text-hover-primary">Kemaskini</a>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item text-muted">Kata Laluan</li>
            <!--end::Item-->
        </ul>
        <!--end::Breadcrumb-->
    </div>
    <!--end::Page title-->

    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl" style="width: 80%; margin-top: 40px;">
            <!--begin::Sign-in Method-->
            <div class="card mb-5 mb-xl-10">
                <!--begin::Card header-->
                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_signin_method">
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0">Kemaskini Kata Laluan</h3>
                    </div>
                </div>
                <!--end::Card header-->

                <!--begin::Content-->
                <div id="kt_account_settings_signin_method" class="collapse show">
                    <form method="post" action="{{ route('password.update') }}" id="kt_account_profile_details_form" class="form" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <!--begin::Card body-->
                        <div class="card-body border-top p-9">
                            <!-- Current Password -->
                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                    <span class="required">Kata Laluan Semasa</span>
                                    <span class="ms-1" data-bs-toggle="tooltip" id="tooltip1">
                                        <i class="ki-duotone ki-information-5 text-gray-500 fs-7">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                        </i>
                                    </span>
                                </label>
                                <div class="col-lg-8 fv-row position-relative">
                                    <input type="password" name="current_password" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Kata Laluan Terkini" id="currentPassword"/>
                                    <span class="toggle-password" onclick="togglePassword('currentPassword')">
                                        <i class="fa fa-eye-slash eye-icon"></i>
                                    </span>
                                </div>
                            </div>

                            <!-- New Password -->
                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                    <span class="required">Kata Laluan Baharu</span>
                                    <span class="ms-1" data-bs-toggle="tooltip" id="tooltip2">
                                        <i class="ki-duotone ki-information-5 text-gray-500 fs-7">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                        </i>
                                    </span>
                                </label>
                                <div class="col-lg-8 fv-row position-relative">
                                    <input type="password" name="password" class="form-control form-control-lg form-control-solid" placeholder="Kata Laluan Baharu" id="newPassword"/>
                                    <span class="toggle-password" onclick="togglePassword('newPassword')">
                                        <i class="fa fa-eye-slash eye-icon"></i>
                                    </span>
                                </div>
                            </div>

                            <!-- Confirm New Password -->
                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                    <span class="required">Sahkan Kata Laluan Baharu</span>
                                    <span class="ms-1" data-bs-toggle="tooltip" id="tooltip3">
                                        <i class="ki-duotone ki-information-5 text-gray-500 fs-7">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                        </i>
                                    </span>
                                </label>
                                <div class="col-lg-8 fv-row position-relative">
                                    <input type="password" name="password_confirmation" class="form-control form-control-lg form-control-solid" placeholder="Sahkan Kata Laluan Baharu" id="confirmPassword"/>
                                    <span class="toggle-password" onclick="togglePassword('confirmPassword')">
                                        <i class="fa fa-eye-slash eye-icon"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!--end::Card body-->

                        <!--begin::Actions-->
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Simpan</button>
                        </div>
                        <!--end::Actions-->
                    </form>
                </div>
                <!--end::Content-->
            </div>
            <!--end::Sign-in Method-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->

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

            @if(session('message'))
                Swal.fire({
                    icon: 'warning',
                    title: 'Kemaskini Kata Laluan!',
                    text: '{{ session('message') }}',
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

    <script>
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = input.nextElementSibling.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var tahapPengguna = {{ Auth::user()->tahap_pengguna }};
            var tooltips = [
                document.getElementById("tooltip1"),
                document.getElementById("tooltip2"),
                document.getElementById("tooltip3")
            ];
            
            if (tahapPengguna === 2) {
                tooltips.forEach(function(tooltip) {
                    tooltip.setAttribute("title", "Minimum 6 aksara, dan kombinasi huruf besar, huruf kecil, nombor dan simbol.");
                });
            } else {
                tooltips.forEach(function(tooltip) {
                    tooltip.setAttribute("title", "Minimum 12 aksara, dan kombinasi huruf besar, huruf kecil, nombor dan simbol.");
                });
            }

            // Reinitialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        });
    </script>
@endsection
