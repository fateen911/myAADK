<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <head>
        <style>
            .relative {
                position: relative;
            }

            .absolute {
                position: absolute;
                top: 50%;
                right: 10px; /* Adjust this value if necessary */
                transform: translateY(-50%);
            }

            .cursor-pointer {
                cursor: pointer;
            }

            .pr-10 {
                padding-right: 2.5rem; /* Ensure there is enough space for the icon */
            }

            .eye-icon {
                font-size: 12px; /* Adjust the size as needed */
            }
        </style>
    </head>


    <div class="text-center">
        <a href="/">
            <x-application-logo class="w-10 h-10 fill-current text-gray-500" />
        </a>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- No Kad Pengenalan -->
        <div>
            <x-input-label for="no_kp" :value="__('No. Kad Pengenalan')" />
            <x-text-input id="no_kp" class="block mt-1 w-full pr-10" type="text" name="no_kp" :value="old('no_kp')" required autofocus autocomplete="username" oninput="validateNoKp(this)" />
            <x-input-error :messages="$errors->get('no_kp')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Kata Laluan')" />

            <div class="relative flex items-center">
                <x-text-input id="password" class="block mt-1 w-full pr-10"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
                <span id="togglePassword" class="absolute right-3 cursor-pointer">
                    <i class="fa fa-eye-slash eye-icon"></i>
                </span>
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-2">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-500 hover:text-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Lupa Kata Laluan ?') }}
                </a>
            @endif
        </div>

        <div class="flex items-center justify-center mt-2">
            <x-primary-button class="ms-3">
                {{ __('Log Masuk') }}
            </x-primary-button>
        </div>

        <div class="flex items-center justify-center mt-2">
            <a class="underline text-sm text-gray-500 hover:text-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('register') }}">
                {{ __('Pegawai Baharu ? Klik untuk Mohon Daftar') }}
            </a>
        </div>
    </form>

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

            // @if(session('errors'))
            //     Swal.fire({
            //         icon: 'error',
            //         title: 'Tidak Berjaya!',
            //         text: '{{ session('errors') }}',
            //         confirmButtonText: 'OK'
            //     });
            // @endif
        });
    </script>

    @if ($errors->has('no_kp') || $errors->has('password'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Tidak Berjaya!',
                text: `{!! $errors->first('no_kp') ?? $errors->first('password') !!}`,
                confirmButtonText: 'OK'
            });
        </script>
    @endif

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
        });
    </script>

    <script>
        // Function to validate 'No. Kad Pengenalan' field
        function validateNoKp(input) {
            // Remove all non-numeric characters
            input.value = input.value.replace(/\D/g, '');

            // Ensure the input length is exactly 12 characters
            if (input.value.length > 12) {
                input.value = input.value.slice(0, 12);
            }
        }
    </script>
</x-guest-layout>
