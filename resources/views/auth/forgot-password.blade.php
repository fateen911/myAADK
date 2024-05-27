<x-guest-layout>
    <div class="text-center">
        <a href="/">
            <x-application-logo class="w-10 h-10 fill-current text-gray-500" />
        </a>
    </div>

    <!--begin::Heading-->
    <div class="text-center mb-10">
        <!--begin::Title-->
        <h1 class="text-dark fw-bolder mb-3">Lupa Kata Laluan ?</h1>
        <!--end::Title-->

       <div class="mb-4 text-sm text-gray-600 justify-center">
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
            <x-input-label for="no_kp" :value="__('No Kad Pengenalan')" />
            <x-text-input id="no_kp" class="block mt-1 w-full pr-10" type="text" name="no_kp" :value="old('no_kp')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('no_kp')" class="mt-2" />
        </div>

        <div class="flex items-center justify-center mt-6">
            <x-primary-button>
                {{ __('Emel Pautan Tetapan Semula Kata Laluan') }}
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
</x-guest-layout>
