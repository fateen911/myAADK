<x-guest-layout>
    <head>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

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
            <input type="text" class="form-control w-full" placeholder="" id="name" name="name"/>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        {{-- No Kad Pengenalan --}}
        <div class="mt-4">
            <x-input-label for="no_kp" :value="__('No Kad Pengenalan')"/>
            <input type="text" maxlength="12" class="form-control w-full" placeholder="" id="no_kp" name="no_kp" />
            <x-input-error :messages="$errors->get('no_kp')" class="mt-2" />
        </div>
  
        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="emailPegawai" :value="__('Emel')" />
            <div class="input-group">
                <input type="text" class="form-control w-full" placeholder="contoh12" id="emailPegawai" name="emailPegawai" required />
                <span class="input-group-text">@adk.gov.my</span>
                <input type="hidden" id="emel" name="emel" />
            </div>
            <x-input-error :messages="$errors->get('emailPegawai')" class="mt-2" />
        </div>

        {{-- No Telefon --}}
        <div class="mt-4">
            <x-input-label for="no_tel" :value="__('Nombor Telefon')"/>
            <input type="text" maxlength="11" class="form-control w-full" placeholder="" id="no_tel" name="no_tel" />
            <x-input-error :messages="$errors->get('no_tel')" class="mt-2" />
        </div>

        <!-- Jawatan -->
        <div class="mt-4">
            <x-input-label for="jawatan" :value="__('Jawatan')" />
            <select id="jawatan" name="jawatan" class="form-control w-full" required>
                <option value="">{{ __('Pilih Jawatan') }}</option>
                @foreach ($jawatan as $j)
                    <option value="{{ $j->id }}">{{ $j->jawatan_gred }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('jawatan')" class="mt-2" />
        </div>

        <!-- Peranan -->
        <div class="mt-4">
            <x-input-label for="peranan" :value="__('Peranan')" />
            <select id="peranan" name="peranan" class="form-control w-full" required>
                <option value="">{{ __('Pilih Peranan') }}</option>
                @foreach ($tahap->sortBy('jawatan') as $t)
                    <option value="{{ $t->id }}">{{ $t->peranan }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('peranan')" class="mt-2" />
        </div>

        <!-- Negeri Bertugas -->
        <div class="mt-4">
            <x-input-label for="negeri_bertugas" :value="__('Negeri Bertugas')" />
            <select id="negeri_bertugas" name="negeri_bertugas" class="form-control w-full" required>
                <option value="">{{ __('Pilih Negeri') }}</option>
                @foreach ($negeri as $item1)
                    <option value="{{ $item1->id }}" data-id="{{ $item1->id }}">{{ $item1->negeri }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('negeri_bertugas')" class="mt-2" />
        </div>

        <!-- Daerah Bertugas -->
        <div class="mt-4">
            <x-input-label for="daerah_bertugas" :value="__('Daerah Bertugas')" />
            <select id="daerah_bertugas" name="daerah_bertugas" class="form-control w-full" required>
                <option value="">{{ __('Select Daerah') }}</option>
                @foreach ($daerah as $item2)
                    <option value="{{ $item2->id }}" data-negeri-id="{{ $item2->negeri_id }}">{{ $item2->daerah }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('daerah_bertugas')" class="mt-2" />
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

    {{-- <form method="POST" action="{{ route('register') }}">
        @csrf
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nama')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="{{ __('Faris Hakim bin Mohd') }}"/>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- No Kad Pengenalan -->
        <div class="mt-4">
            <x-input-label for="no_kp" :value="__('No Kad Pengenalan')"/>
            <x-text-input id="no_kp" class="block mt-1 w-full" type="text" name="no_kp" :value="old('no_kp')" required autofocus autocomplete="no_kp" placeholder="{{ __('xxxxxxxxxxxx') }}"/>
            <x-input-error :messages="$errors->get('no_kp')" class="mt-2" />
        </div>
  
        <!-- EmailPegawai Address -->
        <div class="mt-4">
            <x-input-label for="emailPegawai" :value="__('Emel')" />
            <x-text-input id="emailPegawai" class="block mt-1 w-full" type="emailPegawai" name="emailPegawai" :value="old('emailPegawai')" required autocomplete="username" placeholder="{{ __('faris@gmail.com') }}"/>
            <x-input-error :messages="$errors->get('emailPegawai')" class="mt-2" />
        </div>

        <!-- No Telefon -->
        <div class="mt-4">
            <x-input-label for="no_tel" :value="__('Nombor Telefon')"/>
            <x-text-input id="no_tel" class="block mt-1 w-full" type="text" name="no_tel" :value="old('no_tel')" required autofocus autocomplete="no_tel" placeholder="{{ __('xxxxxxxxxxxx') }}"/>
            <x-input-error :messages="$errors->get('no_tel')" class="mt-2" />
        </div>

        <!-- Jawatan -->
        <div class="mt-4">
            <x-input-label for="jawatan" :value="__('Jawatan')" />
            <x-text-input id="jawatan" class="block mt-1 w-full" type="jawatan" name="jawatan" :value="old('jawatan')" required/>
            <x-input-error :messages="$errors->get('jawatan')" class="mt-2" />
        </div>

        <!-- Peranan -->
        <div class="mt-4">
            <x-input-label for="peranan" :value="__('Peranan')" />
            <x-text-input id="peranan" class="block mt-1 w-full" type="peranan" name="peranan" :value="old('peranan')" required/>
            <x-input-error :messages="$errors->get('peranan')" class="mt-2" />
        </div>

        <!-- Negeri Bertugas -->
        <div class="mt-4">
            <x-input-label for="negeri_bertugas" :value="__('Negeri Bertugas')" />
            <x-text-input id="negeri_bertugas" class="block mt-1 w-full" type="negeri_bertugas" name="negeri_bertugas" :value="old('negeri_bertugas')" required/>
            <x-input-error :messages="$errors->get('negeri_bertugas')" class="mt-2" />
        </div>

        <!-- Daerah Bertugas -->
        <div class="mt-4">
            <x-input-label for="daerah_bertugas" :value="__('Daerah Bertugas')" />
            <x-text-input id="daerah_bertugas" class="block mt-1 w-full" type="daerah_bertugas" name="daerah_bertugas" :value="old('daerah_bertugas')" required/>
            <x-input-error :messages="$errors->get('daerah_bertugas')" class="mt-2" />
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
    </form> --}}

    {{-- <script>
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
    </script> --}}
</x-guest-layout>
