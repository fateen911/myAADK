<x-guest-layout>
    <div class="text-center">
        <a href="/">
            <x-application-logo class="w-10 h-10 fill-current text-gray-500" />
        </a>
    </div>

    <!--begin::Heading-->
    <div class="text-center mb-5">
        <!--begin::Title-->
        <h1 class="text-dark fw-bolder mb-4">Lupa Kata Laluan ?</h1>
        <!--end::Title-->

       <div class="mb-2 text-sm text-gray-600 justify-center">
            {{ __('Sila isi maklumat di bawah untuk tetapkan semula kata laluan.') }}
        </div>
    </div>
    <!--begin::Heading-->

    <br>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('check.challenge.form') }}" data-kt-redirect-url="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="negeri_lahir" :value="__('Dimanakah Negeri Lahir Anda ?')" />
            <x-text-input id="negeri_lahir" class="block w-full pr-10" type="text" name="negeri_lahir" :value="old('negeri_lahir')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('negeri_lahir')" class="mt-2" />
        </div>

        <br>

        <div>
            <x-input-label for="nama_ibu" :value="__('Apakah Nama Penuh Ibu Anda ?')" />
            <x-text-input id="nama_ibu" class="block w-full pr-10" type="text" name="nama_ibu" :value="old('nama_ibu')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('nama_ibu')" class="mt-2" />
        </div>

        <div class="flex items-center justify-center mt-3">
            <x-primary-button>
                {{ __('Seterusnya') }}
            </x-primary-button>
        </div>
    </form>

    <div class="text-center">
        <a href="{{ route('password.email') }}">
            <div class="underline mt-3 text-sm text-gray-600 justify-center">
                {{ __('Hantar Emel Pautan Set Semula Kata Laluan?') }}
            </div>
        </a>
    </div>

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
