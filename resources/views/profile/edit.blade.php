@extends('layouts._default')

@section('content')
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

        input.form-control.form-control-solid.custom-form {
            background-color: #e0e0e0;
            color: #45505b;
        }

        input.form-control.form-control-solid:focus.custom-form {
            background-color: #d0d0d0;
            color: #333333;
            box-shadow: none;
        }
    </style>

    <!--begin::Page title-->
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
        <!--begin::Title-->
        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Akaun Pengguna</h1>
        <!--end::Title-->
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
            <!--begin::Item-->
            <li class="breadcrumb-item text-muted">Akaun Pengguna</li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item text-muted">Kemaskini</li>
            <!--end::Item-->
        </ul>
        <!--end::Breadcrumb-->
    </div>
    <!--end::Page title-->
    
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid pt-5">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <!--begin::Basic info-->
            <div class="card mb-5 mb-xl-10">
                <!--begin::Card header-->
                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0">Kemaskini Profil Pengguna</h3>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--begin::Card header-->
                <!--begin::Content-->
                <div id="kt_account_settings_profile_details" class="collapse show">
                    <!--begin::Form-->
                    <form method="post" action="{{ route('profile.update') }}" id="kt_account_profile_details_form" class="form" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        @if(Auth::user()->tahap_pengguna == 2)
                            {{-- KLIEN --}}
                            <!--begin::Card body-->
                            <div class="card-body border-top p-9">
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Nama Penuh</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="name" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Nama Penuh" value="{{ $user->name }}" readonly/>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">No. Kad Pengenalan</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="number" name="no_kp" class="form-control form-control-lg form-control-solid" placeholder="No Kad Pengenalan" value="{{ $user->no_kp }}" inputmode="numeric" readonly/>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">E-mel</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="email" name="email" class="form-control form-control-lg form-control-solid custom-form" placeholder="Emel" value="{{ $user->email }}" />
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Card body-->
                        @else
                            {{-- PEGAWAI --}}
                            <!--begin::Card body-->
                            <div class="card-body border-top p-9">
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Gambar Profil</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <!--begin::Image input-->
                                        <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('assets/default.png')">
                                            <!--begin::Preview existing avatar-->
                                            @if(Auth::user()->gambar_profil !== null)
                                                <div class="image-input-wrapper w-125px h-125px" style="background-image: url('/assets/gambar_profil/{{$user->gambar_profil}}')"></div>
                                            @else
                                                <div class="image-input-wrapper w-125px h-125px" style="background-image: url(assets/default.png)"></div>
                                            @endif
                                            <!--end::Preview existing avatar-->
                                            <!--begin::Label-->
                                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Tukar Gambar">
                                                <i class="ki-duotone ki-pencil fs-7">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                                <!--begin::Inputs-->
                                                <input type="file" name="gambar_profil" accept=".png, .jpg, .jpeg" />
                                                <input type="hidden" name="gambar_profil" />
                                                <!--end::Inputs-->
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Cancel-->
                                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Batal">
                                                <i class="ki-duotone ki-cross fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                            <!--end::Cancel-->
                                            <!--begin::Remove-->
                                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Buang gambar">
                                                <i class="ki-duotone ki-cross fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                            <input type="hidden" name="remove_gambar_profil" id="remove_gambar_profil" value="0">
                                            <!--end::Remove-->
                                        </div>
                                        <!--end::Image input-->
                                        <!--begin::Hint-->
                                        <div class="form-text">Format fail yang dibenarkan untuk dimuat naik: png, jpg, jpeg.</div>
                                        <!--end::Hint-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Nama Penuh</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="name" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Nama Penuh" value="{{ $user->name }}" readonly/>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">No. Kad Pengenalan</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="number" name="no_kp" class="form-control form-control-lg form-control-solid" placeholder="No Kad Pengenalan" value="{{ $user->no_kp }}" inputmode="numeric" readonly/>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Peranan</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        @php
                                            $peranan = DB::table('tahap_pengguna')->where('id', $user->tahap_pengguna)->value('peranan');
                                        @endphp
                                        <input type="text" name="peranan" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" value="{{ $peranan }}" readonly/>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">E-mel</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="email" name="email" class="form-control form-control-lg form-control-solid" placeholder="Emel" value="{{ $user->email }}" readonly/>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Card body-->
                        @endif


                        <!--begin::Actions-->
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Simpan</button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Basic info-->  

            <!--begin::Sign-in Method-->
            <div class="card mb-xl-10">
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
                                        <input type="password" name="current_password" class="form-control form-control-lg form-control-solid custom-form" placeholder="Kata Laluan Semasa" id="currentPassword" />
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
                                </label>
                                <div class="col-lg-8 fv-row position-relative">
                                    <div class="input-group">
                                        <input type="password" name="password" class="form-control form-control-lg form-control-solid custom-form" placeholder="Kata Laluan Baharu" id="newPassword"/>
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
                                        <input type="password" name="password_confirmation" class="form-control form-control-lg form-control-solid custom-form" placeholder="Sahkan Kata Laluan Baharu" id="confirmPassword"/>
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

            <!--begin::Deactivate Account-->
            {{-- <div class="card">
                <!--begin::Card header-->
                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_deactivate" aria-expanded="true" aria-controls="kt_account_deactivate">
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0">Padam Akaun</h3>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Content-->
                <div id="kt_account_settings_deactivate" class="collapse show">
                    <!--begin::Form-->
                    <form id="kt_account_deactivate_form" class="form">
                        <!--begin::Card body-->
                        <div class="card-body border-top p-9">
                            <!--begin::Notice-->
                            <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-9 p-6">
                                <!--begin::Icon-->
                                <i class="ki-duotone ki-information fs-2tx text-warning me-4">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                                <!--end::Icon-->
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-stack flex-grow-1">
                                    <!--begin::Content-->
                                    <div class="fw-semibold">
                                        <h4 class="text-gray-900 fw-bold">You Are Deactivating Your Account</h4>
                                        <div class="fs-6 text-gray-700">For extra security, this requires you to confirm your email or phone number when you reset yousignr password.
                                        <br />
                                        <a class="fw-bold" href="#">Learn more</a></div>
                                    </div>
                                    <!--end::Content-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Notice-->
                            <!--begin::Form input row-->
                            <div class="form-check form-check-solid fv-row">
                                <input name="deactivate" class="form-check-input" type="checkbox" value="" id="deactivate" />
                                <label class="form-check-label fw-semibold ps-2 fs-6" for="deactivate">I confirm my account deactivation</label>
                            </div>
                            <!--end::Form input row-->
                        </div>
                        <!--end::Card body-->
                        <!--begin::Card footer-->
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <button id="kt_account_deactivate_account_submit" type="submit" class="btn btn-danger fw-semibold">Deactivate Account</button>
                        </div>
                        <!--end::Card footer-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Content-->
            </div> --}}
            <!--end::Deactivate Account-->
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

            // Check if there is a flash error message
            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Tidak Berjaya!',
                    text: '{!! session('error') !!}',
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

    <script>
        document.querySelector('[data-kt-image-input-action="remove"]').addEventListener('click', function() {
            document.getElementById('remove_gambar_profil').value = 1;
        });
    </script>
@endsection
