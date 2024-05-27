<x-guest-layout>
    <head>
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
        </style>
    </head>

    <!--begin::Heading-->
    <div class="text-center mb-10">
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

        <!-- Email Address -->
        {{-- <div>
            <x-input-label for="email" :value="__('Emel')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div> --}}

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Kata Laluan')" />

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
        </div>

        <small class="text-gray-600">Minimum 12 aksara, dan kombinasi huruf besar, huruf kecil, nombor dan simbol.</small>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Sahkan Kata Laluan')" />

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
        </div>

        <small class="text-gray-600">Minimum 12 aksara, dan kombinasi huruf besar, huruf kecil, nombor dan simbol.</small>

        <div class="flex items-center justify-center mt-4">
            <x-primary-button>
                {{ __('Tetapkan Semula Kata Laluan') }}
            </x-primary-button>
        </div>
    </form>

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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
</x-guest-layout>
