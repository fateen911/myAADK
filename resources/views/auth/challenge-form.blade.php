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
            {{ __('Sila isikan maklumat di bawah untuk menetapkan semula kata laluan.') }}
        </div>
    </div>
    <!--begin::Heading-->

    <br>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('check.challenge.form') }}" data-kt-redirect-url="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="no_kad_pengenalan" :value="__('No Kad Pengenalan')" />
            <x-text-input id="no_kad_pengenalan" class="block w-full pr-10" type="text" name="no_kad_pengenalan" :value="old('no_kad_pengenalan')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('no_kad_pengenalan')" class="mt-2" />
        </div>

        <br>

        <div>
            <x-input-label for="nama_waris" :value="__('Apakah Nama Penuh Waris Anda ?')" />
            <x-text-input id="nama_waris" class="block w-full pr-10" type="text" name="nama_waris" :value="old('nama_waris')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('nama_waris')" class="mt-2" />
        </div>

        <div class="flex items-center justify-center mt-3">
            <x-primary-button>
                {{ __('Seterusnya') }}
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
