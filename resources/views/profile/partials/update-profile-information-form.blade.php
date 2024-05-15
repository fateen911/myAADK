<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Kemaskini Maklumat Profil Diri') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Kemaskini maklumat profil diri akaun anda.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <!-- Profile Photo Display -->
        <div class="flex items-center space-x-4">
            <div class="relative w-20 h-20 bg-gray-200 overflow-hidden border border-gray-300">
                <!-- Display current profile photo if available -->
                @if ($user->gambar_profil)
                    <img src="{{ asset('assets/gambar_profil/' . $user->gambar_profil) }}" alt="Profile Photo" class="object-cover w-full h-full">
                @else
                    <!-- Display default profile icon if no photo available -->
                    <img src="{{ asset('assets/default.png') }}" alt="Default Profile Photo" class="object-cover w-full h-full">
                @endif
            </div>

            <!-- Profile Photo Upload -->
            <div class="ml-3">
                <input id="gambar_profil" name="gambar_profil" type="file" class="mt-1 block w-full sm" required accept="image/*" />
                <x-input-error class="mt-2" :messages="$errors->get('gambar_profil')" />
            </div>
        </div>

        <div>
            <x-input-label for="name" :value="__('Nama')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="no_kp" :value="__('Nombor Kad Pengenalan')" />
            <x-text-input id="no_kp" name="no_kp" type="text" class="mt-1 block w-full" :value="old('no_kp', $user->no_kp)" required autofocus autocomplete="no_kp" />
            <x-input-error class="mt-2" :messages="$errors->get('no_kp')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('E-mel')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Alamat e-mel anda tidak disahkan.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Klik di sini untuk menghantar semula e-mel pengesahan.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('Pautan pengesahan e-mel baharu telah dihantar ke alamat e-mel anda.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Simpan') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Simpan') }}</p>
            @endif
        </div>
    </form>
</section>
