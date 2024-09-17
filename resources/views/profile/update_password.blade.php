@extends('layouts._default')

@section('content')
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

        <style>
            .input-group {
                position: relative;
            }

            .input-group .toggle-password {
                position: absolute;
                top: 50%;
                right: 15px; /* Adjust as needed */
                transform: translateY(-50%);
                cursor: pointer;
                z-index: 10; /* Ensure it's higher than other elements */
            }

            .input-group .eye-icon {
                font-size: 1rem;
                color: #6c757d;
            }

            .input-group input {
                padding-right: 40px; /* Space for the icon */
            }

            .input-group input:focus + .toggle-password {
                z-index: 11; /* Ensure the icon remains on top even when typing */
            }

            input.form-control.form-control-solid {
                background-color: #e0e0e0;
                color: #45505b;
            }

            input.form-control.form-control-solid:focus {
                background-color: #d0d0d0;
                color: #333333;
                box-shadow: none;
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
        <div id="kt_app_content_container" class="app-container container-xxl" style="width: 80%;">
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
                                </label>
                                <div class="col-lg-8 fv-row position-relative">
                                    <div class="input-group">
                                        <input type="password" name="current_password" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Kata Laluan Semasa" id="currentPassword" />
                                        <span class="toggle-password" onclick="togglePassword('currentPassword')">
                                            <i class="fa fa-eye-slash eye-icon"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- New Password -->
                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                    <span class="required">Kata Laluan Baharu</span>
                                    <span class="ms-1" data-bs-toggle="tooltip" id="tooltip2">
                                        <i class="ki-duotone ki-information-5 text-gray-500 fs-7"></i>
                                    </span>
                                </label>
                                <div class="col-lg-8 fv-row position-relative">
                                    <div class="input-group">
                                        <input type="password" name="password" class="form-control form-control-lg form-control-solid" placeholder="Kata Laluan Baharu" id="newPassword"/>
                                        <span class="toggle-password" onclick="togglePassword('newPassword')">
                                            <i class="fa fa-eye-slash eye-icon"></i>
                                        </span>
                                    </div>

                                    <!-- Password Requirement List -->
                                    <ul id="password-requirements" class="mt-2 list-unstyled">
                                        <li id="length-requirement" class="text-muted">
                                            <i class="fa fa-circle-check"></i> Minimum aksara
                                        </li>
                                        <li id="lowercase-requirement" class="text-muted">
                                            <i class="fa fa-circle-check"></i> Sekurang-kurangnya mempunyai satu huruf kecil
                                        </li>
                                        <li id="uppercase-requirement" class="text-muted">
                                            <i class="fa fa-circle-check"></i> Sekurang-kurangnya mempunyai satu huruf besar
                                        </li>
                                        <li id="number-requirement" class="text-muted">
                                            <i class="fa fa-circle-check"></i> Sekurang-kurangnya mempunyai satu nombor
                                        </li>
                                        <li id="special-requirement" class="text-muted">
                                            <i class="fa fa-circle-check"></i> Sekurang-kurangnya mempunyai satu simbol
                                        </li>
                                    </ul>
                                </div>
                            </div>                        

                            <!-- Confirm New Password -->
                            <div class="row">
                                <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                    <span class="required">Sahkan Kata Laluan Baharu</span>
                                </label>
                                <div class="col-lg-8 fv-row position-relative">
                                    <div class="input-group">
                                        <input type="password" name="password_confirmation" class="form-control form-control-lg form-control-solid" placeholder="Sahkan Kata Laluan Baharu" id="confirmPassword"/>
                                        <span class="toggle-password" onclick="togglePassword('confirmPassword')">
                                            <i class="fa fa-eye-slash eye-icon"></i>
                                        </span>
                                    </div>
                                    
                                    <!-- Confirm Password Match Requirement -->
                                    <ul id="confirm-password-requirements" class="mt-2 list-unstyled">
                                        <li id="match-requirement" class="text-muted">
                                            <i class="fa fa-circle-check"></i> Sahkan Kata Laluan Baharu mesti sama dengan Kata Laluan Baharu
                                        </li>
                                    </ul>
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

            @if(session('passwordSame'))
                Swal.fire({
                    icon: 'warning',
                    title: 'Semak Kata Laluan Baharu!',
                    text: '{{ session('passwordSame') }}',
                    confirmButtonText: 'OK'
                });
            @endif
        
            @if(session('passwordError'))
                Swal.fire({
                    icon: 'error',
                    title: 'Tidak Berjaya!',
                    text: '{{ session('passwordError') }}',
                    confirmButtonText: 'OK'
                });
            @endif
        });
    </script>

    <script>
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = input.parentElement.querySelector('.toggle-password i');
            
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
            var minLength = tahapPengguna === 2 ? 6 : 12;

            var lengthRequirementText = tahapPengguna === 2 ? "Minimum 6 aksara" : "Minimum 12 aksara";
            document.getElementById('length-requirement').innerHTML = `<i class="fa fa-circle-check text-muted"></i> ${lengthRequirementText}`;

            var passwordInput = document.getElementById('newPassword');
            var confirmPasswordInput = document.getElementById('confirmPassword');
            var matchRequirementItem = document.getElementById('match-requirement');

            function validatePassword() {
                var password = passwordInput.value;
                var confirmPassword = confirmPasswordInput.value;

                var isValidLength = password.length >= minLength;
                var hasLowercase = /[a-z]/.test(password);
                var hasUppercase = /[A-Z]/.test(password);
                var hasNumber = /\d/.test(password);
                var hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(password);

                updateCriteria('length-requirement', isValidLength);
                updateCriteria('lowercase-requirement', hasLowercase);
                updateCriteria('uppercase-requirement', hasUppercase);
                updateCriteria('number-requirement', hasNumber);
                updateCriteria('special-requirement', hasSpecialChar);

                if (confirmPassword !== "") {
                    var passwordsMatch = password === confirmPassword;
                    updateCriteria('match-requirement', passwordsMatch);
                } 
                else {
                    resetCriteria('match-requirement');  // Reset the match requirement if confirmPassword is empty
                }
            }

            function updateCriteria(elementId, isValid) {
                var element = document.getElementById(elementId);
                var icon = element.querySelector('i');

                if (isValid) {
                    icon.classList.remove('fa-circle-o', 'text-muted', 'text-danger');
                    icon.classList.add('fa-circle-check', 'text-success');
                    element.classList.remove('text-muted', 'text-danger');
                    element.classList.add('text-success');
                } else {
                    icon.classList.remove('fa-circle-check', 'text-success');
                    icon.classList.add('fa-circle-o', 'text-danger');
                    element.classList.remove('text-muted', 'text-success');
                    element.classList.add('text-danger');
                }
            }

            function resetCriteria(elementId) {
                var element = document.getElementById(elementId);
                var icon = element.querySelector('i');

                icon.classList.remove('fa-circle-check', 'text-success', 'text-danger');
                icon.classList.add('fa-circle-check', 'text-muted');
                element.classList.remove('text-success', 'text-danger');
                element.classList.add('text-muted');
            }

            passwordInput.addEventListener('input', validatePassword);
            confirmPasswordInput.addEventListener('input', validatePassword);
        });
    </script>
@endsection
