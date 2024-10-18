<x-guest-layout>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

        <style>
            .relative {
                position: relative;
            }

            .absolute {
                position: absolute;
                top: 50%;
                right: 10px;
                transform: translateY(-50%);
            }

            .cursor-pointer {
                cursor: pointer;
            }

            .eye-icon {
                font-size: 12px; /* Adjust the size as needed */
            }

            .text-gray-600 {
                color: #718096; /* Adjust the color as needed */
                font-size: 10px; /* 14px */
            }

            .text-success {
                color: #28a745 !important;
            }

            .text-danger {
                color: #dc3545 !important;
            }
        </style>
    </head>

    <div class="text-center">
        <a href="/">
            <x-application-logo class="w-10 h-10 fill-current text-gray-500" />
        </a>
    </div>

    <!--begin::Heading-->
    <div class="text-center">
        <!--begin::Title-->
        <h1 class="text-dark fw-bolder mb-3">Lupa Kata Laluan ?</h1>
        <!--end::Title-->

       <div class="mb-4 text-sm text-gray-700 justify-center">
            {{ __('Sila masukkan kata laluan baharu di bawah.') }}
        </div>
    </div>
    <!--begin::Heading-->

    <form method="POST" action="{{ route('password.store') }}" data-kt-redirect-url="{{ route('login') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Kata Laluan Baharu')" />

            <div class="relative flex items-center">
                <x-text-input id="password" class="block mt-1 w-full pr-10"
                              type="password"
                              name="password"
                              required autocomplete="new-password" />
                <span id="togglePassword" class="absolute right-3 cursor-pointer">
                    <i class="fa fa-eye-slash eye-icon"></i>
                </span>
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />

            <!-- Password Requirement List -->
            <ul id="password-requirements" class="mt-2 list-unstyled">
                <small id="length-requirement" class="text-muted">
                    <i class="fa fa-check-circle"></i> Minimum 12 aksara
                </small>
                <br>
                <small id="lowercase-requirement" class="text-muted">
                    <i class="fa fa-check-circle"></i> Sekurang-kurangnya mempunyai satu huruf kecil
                </small>
                <br>
                <small id="uppercase-requirement" class="text-muted">
                    <i class="fa fa-check-circle"></i> Sekurang-kurangnya mempunyai satu huruf besar
                </small>
                <br>
                <small id="number-requirement" class="text-muted">
                    <i class="fa fa-check-circle"></i> Sekurang-kurangnya mempunyai satu nombor
                </small>
                <br>
                <small id="special-requirement" class="text-muted">
                    <i class="fa fa-check-circle"></i> Sekurang-kurangnya mempunyai satu simbol
                </small>                
            </ul>
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Sahkan Kata Laluan Baharu')" />

            <div class="relative flex items-center">
                <x-text-input id="password_confirmation" class="block mt-1 w-full pr-10"
                              type="password"
                              name="password_confirmation" 
                              required autocomplete="new-password" />

                <span id="togglePasswordConfirmation" class="absolute right-3 cursor-pointer">
                    <i class="fa fa-eye-slash eye-icon"></i>
                </span>
            </div>

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            
            <!-- Confirm Password Match Requirement -->
            <ul id="confirm-password-requirements" class="mt-2 list-unstyled x-input-label">
                <small id="match-requirement" class="text-muted">
                    <i class="fa fa-circle-check"></i> Sahkan Kata Laluan Baharu mesti sama dengan Kata Laluan Baharu
                </small>
            </ul>
        </div>

        <div class="flex items-center justify-center mt-4">
            <x-primary-button>
                {{ __('Tetapkan Semula Kata Laluan') }}
            </x-primary-button>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berjaya!',
                text: ' {!! session('success') !!}',
                confirmButtonText: 'OK'
            });
        @endif
        @if(session('failed'))
            Swal.fire({
                icon: 'error',
                title: 'Tidak Berjaya!',
                text: ' {!! session('failed') !!}',
                confirmButtonText: 'OK'
            });
        @endif
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#password');
        
            const togglePasswordConfirmation = document.querySelector('#togglePasswordConfirmation');
            const passwordConfirmation = document.querySelector('#password_confirmation');
        
            togglePassword.addEventListener('click', function () {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                if (type === 'text') {
                    this.querySelector('i').classList.remove('fa-eye-slash');
                    this.querySelector('i').classList.add('fa-eye');
                } else {
                    this.querySelector('i').classList.remove('fa-eye');
                    this.querySelector('i').classList.add('fa-eye-slash');
                }
            });
        
            togglePasswordConfirmation.addEventListener('click', function () {
                const type = passwordConfirmation.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordConfirmation.setAttribute('type', type);
                if (type === 'text') {
                    this.querySelector('i').classList.remove('fa-eye-slash');
                    this.querySelector('i').classList.add('fa-eye');
                } else {
                    this.querySelector('i').classList.remove('fa-eye');
                    this.querySelector('i').classList.add('fa-eye-slash');
                }
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const minLength = 12;
            var passwordInput = document.getElementById('password');
            var confirmPasswordInput = document.getElementById('password_confirmation');

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
                } else {
                    resetCriteria('match-requirement');  // Reset the match requirement if confirmPassword is empty
                }
            }

            function updateCriteria(elementId, isValid) {
                var element = document.getElementById(elementId);
                var icon = element.querySelector('i');

                if (isValid) {
                    // Add success classes
                    icon.classList.remove('fa-times-circle', 'text-muted', 'text-danger');
                    icon.classList.add('fa-check-circle', 'text-success');
                    
                    element.classList.remove('text-muted', 'text-danger');
                    element.classList.add('text-success');
                } else {
                    // Add danger classes
                    icon.classList.remove('fa-check-circle', 'text-success');
                    icon.classList.add('fa-times-circle', 'text-danger');
                    
                    element.classList.remove('text-muted', 'text-success');
                    element.classList.add('text-danger');
                }
            }

            function resetCriteria(elementId) {
                var element = document.getElementById(elementId);
                var icon = element.querySelector('i');

                // Reset to muted classes
                icon.classList.remove('fa-check-circle', 'text-success', 'text-danger');
                icon.classList.add('fa-check-circle', 'text-muted');
                
                element.classList.remove('text-success', 'text-danger');
                element.classList.add('text-muted');
            }

            passwordInput.addEventListener('input', validatePassword);
            confirmPasswordInput.addEventListener('input', validatePassword);
        });
    </script>
</x-guest-layout>
