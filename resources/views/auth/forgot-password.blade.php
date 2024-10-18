<x-guest-layout>
    <div class="text-center">
        <a href="/">
            <x-application-logo class="w-10 h-10 fill-current text-gray-500" />
        </a>
    </div>

    <!--begin::Heading-->
    <div class="text-center mb-2">
        <!--begin::Title-->
        <h1 class="text-dark fw-bolder mb-4">Lupa Kata Laluan ?</h1>
        <!--end::Title-->

       <div class="text-sm text-gray-600 justify-center">
            {{ __('Sila masukkan No. Kad Pengenalan anda untuk menetapkan semula kata laluan.') }}
        </div>
    </div>
    <!--begin::Heading-->

    <br>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" data-kt-redirect-url="{{ route('login') }}">
        @csrf

        <div>
            <x-text-input 
                id="no_kp" 
                class="block w-full pr-10" 
                type="text" 
                name="no_kp" 
                :value="old('no_kp')" 
                required 
                autofocus 
                autocomplete="no_kp" 
                placeholder="{{ __('No Kad Pengenalan') }}"
                oninput="validateInput(this)"
            />
            <x-input-error :messages="$errors->get('no_kp')" class="mt-2" />
        </div>

        <div class="flex items-center justify-center mt-3">
            <x-primary-button>
                {{ __('Tetapan Semula Kata Laluan') }}
            </x-primary-button>
        </div>
    </form>

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

    <script>
        function validateInput(input) {
            // Remove any non-numeric characters from the input
            input.value = input.value.replace(/\D/g, '');

            // Limit the input to a maximum of 12 digits
            if (input.value.length > 12) {
                input.value = input.value.slice(0, 12);
            }

            // Optional: Update the error message dynamically
            const errorElement = document.getElementById('no_kp_error');
            if (input.value.length < 12) {
                errorElement.textContent = 'No Kad Pengenalan mesti mempunyai 12 digit.';
            } else {
                errorElement.textContent = ''; // Clear the error message when valid
            }
        }
    </script>
</x-guest-layout>
