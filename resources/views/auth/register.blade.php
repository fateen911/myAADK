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
                font-size: 11px; /* 14px */
            }
        </style>
    </head>

    <div class="text-center">
        <a href="/">
            <x-application-logo class="w-10 h-10 fill-current text-gray-500" />
        </a>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nama')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="{{ __('Faris Hakim bin Mohd') }}"/>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        {{-- No Kad Pengenalan --}}
        <div class="mt-4">
            <x-input-label for="no_kp" :value="__('No Kad Pengenalan')"/>
            <x-text-input id="no_kp" class="block mt-1 w-full" type="text" name="no_kp" :value="old('no_kp')" required autofocus autocomplete="no_kp" placeholder="{{ __('xxxxxxxxxxxx') }}"/>
            <x-input-error :messages="$errors->get('no_kp')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Emel')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="{{ __('faris@gmail.com') }}"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Kata Laluan')" />

            <div class="relative flex items-center">
                <x-text-input id="password" class="block mt-1 w-full pr-10"
                              type="password"
                              name="password"
                              required autocomplete="new-password" 
                              placeholder="{{ __('Testing1234#') }}" />
                <span id="togglePassword" class="absolute right-3 cursor-pointer">
                    <i class="fa fa-eye-slash eye-icon"></i>
                </span>
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />

            <small class="text-gray-600">Minimum 12 aksara, dan kombinasi huruf besar, huruf kecil, nombor dan simbol.</small>
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Sahkan Kata Laluan')" />

            <div class="relative flex items-center">
                <x-text-input id="password_confirmation" class="block mt-1 w-full pr-10"
                              type="password"
                              name="password_confirmation" 
                              required autocomplete="new-password" 
                              placeholder="{{ __('Testing1234#') }}" />

                <span id="togglePasswordConfirmation" class="absolute right-3 cursor-pointer">
                    <i class="fa fa-eye-slash eye-icon"></i>
                </span>
            </div>

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-center mt-4">
            <x-primary-button class="ms-4">
                {{ __('DAFTAR') }}
            </x-primary-button>
        </div>

        <div class="flex items-center justify-center mt-2">
            <a class="underline text-sm text-gray-500 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Klik di sini untuk log masuk?') }}
            </a>
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
</x-guest-layout>
