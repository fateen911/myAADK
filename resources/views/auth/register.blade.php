<x-guest-layout>
    <head>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap CSS -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.1/css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap JS (including Popper.js for tooltips) -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.1/js/bootstrap.bundle.min.js"></script>
    </head>

    <body>
        <div class="text-center">
            <a href="/">
                <x-application-logo class="w-10 h-10 fill-current text-gray-500" />
            </a>
        </div>
    
        <form method="POST" action="{{ route('register') }}" id="pegawai_mohon_daftar_form">
            @csrf
            <!-- Nama -->
            <div class="mt-4">
                <x-input-label for="nama" :value="__('Nama Penuh')" :required="true" />
                <input type="text" class="form-control w-full" placeholder="" id="nama" name="nama" style="text-transform: uppercase;" required/>
                <x-input-error :messages="$errors->get('nama')" class="mt-2" />
            </div>
    
            {{-- No Kad Pengenalan --}}
            <div class="mt-4">
                <x-input-label for="no_kp" :value="__('No. Kad Pengenalan')" :required="true"/>
                {{-- <span class="ms-1" data-bs-toggle="tooltip" title="Masukkan no kad pengenalan tanpa '-'.">
                    <i class="ki-duotone ki-information-2 text-gray-500 fs-6">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                    </i>
                </span> --}}
                <input type="number" class="form-control w-full" placeholder="980406010678" id="no_kp" name="no_kp" inputmode="numeric" pattern="[0-9]*" pattern="\d{12}" maxlength="12" required/>
                <x-input-error :messages="$errors->get('no_kp')" class="mt-2" />
            </div>
      
            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="emelPegawai" :value="__('E-mel')" :required="true"/>
                <div class="input-group">
                    <input type="text" class="form-control w-full" placeholder="contoh12" id="emelPegawai" name="emelPegawai" required />
                    <span class="input-group-text">@adk.gov.my</span>
                </div>
                <x-input-error :messages="$errors->get('emelPegawai')" class="mt-2" />
            </div>
    
            {{-- No Telefon --}}
            <div class="mt-4">
                <x-input-label for="no_tel" :value="__('Nombor Telefon')" :required="true"/>
                {{-- <span class="ms-1" data-bs-toggle="tooltip" title="Masukkan nombor telefon tidak termasuk simbol '-' dan tidak melebihi 11 aksara.">
                    <i class="ki-duotone ki-information-2 text-gray-500 fs-6">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                    </i>
                </span> --}}
                <input type="number" class="form-control w-full" placeholder="0109000000" id="no_tel" name="no_tel" inputmode="numeric" pattern="\d{10,11}" maxlength="11" required />
                <x-input-error :messages="$errors->get('no_tel')" class="mt-2" />
            </div>
    
            <!-- Jawatan -->
            <div class="mt-4">
                <x-input-label for="jawatan" :value="__('Jawatan')" :required="true"/>
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
                <x-input-label for="peranan" :value="__('Peranan')" :required="true"/>
                <select id="peranan" name="peranan" class="form-control w-full" required>
                    <option value="">{{ __('Pilih Peranan') }}</option>
                    @foreach ($tahap->sortBy('jawatan') as $t)
                        <option value="{{ $t->id }}">{{ $t->peranan }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('peranan')" class="mt-2" />
            </div>
    
            <!-- Negeri Bertugas -->
            <div class="mt-4" id="mohon_negeri_field">
                <x-input-label for="negeri_bertugas" :value="__('Negeri Bertugas')" />
                <select id="negeri_bertugas" name="negeri_bertugas" class="form-control w-full">
                    <option value="">{{ __('Pilih Negeri') }}</option>
                    @foreach ($negeri as $item1)
                        <option value="{{ $item1->id }}" data-id="{{ $item1->id }}">{{ $item1->negeri }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('negeri_bertugas')" class="mt-2" />
            </div>
    
            <!-- Daerah Bertugas -->
            <div class="mt-4" id="mohon_daerah_field">
                <x-input-label for="daerah_bertugas" :value="__('Daerah Bertugas')" />
                <select id="daerah_bertugas" name="daerah_bertugas" class="form-control w-full">
                    <option value="">{{ __('Select Daerah') }}</option>
                    @foreach ($daerah as $item2)
                        <option value="{{ $item2->kod_daerah_pejabat }}" data-negeri-id="{{ $item2->negeri_id }}">{{ $item2->daerah }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('daerah_bertugas')" class="mt-2" />
            </div>
    
            <div class="flex items-center justify-center mt-4">
                <x-primary-button type="submit" class="ms-4">
                    {{ __('DAFTAR') }}
                </x-primary-button>
            </div>
    
            <div class="flex items-center justify-center mt-2">
                <a class="underline text-sm text-gray-500 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Klik di sini untuk log masuk?') }}
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
            
                @if(session('error'))
                    Swal.fire({
                        icon: 'error',
                        title: 'Tidak Berjaya!',
                        text: '{{ session('error') }}',
                        confirmButtonText: 'OK'
                    });
                @endif
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const perananField = document.getElementById('peranan');
                const negeriField = document.getElementById('mohon_negeri_field');
                const daerahField = document.getElementById('mohon_daerah_field');
                const negeriSelect = document.getElementById('negeri_bertugas');
                const daerahSelect = document.getElementById('daerah_bertugas');

                // Function to toggle visibility of fields based on peranan
                function toggleFields() {
                    const peranan = parseInt(perananField.value);
                    if (peranan === 3) {
                        negeriField.style.display = 'none';
                        daerahField.style.display = 'none';
                    } else if (peranan === 4) {
                        negeriField.style.display = 'block';
                        daerahField.style.display = 'none';
                    } else if (peranan === 5) {
                        negeriField.style.display = 'block';
                        daerahField.style.display = 'block';
                    } else {
                        negeriField.style.display = 'none';
                        daerahField.style.display = 'none';
                    }
                }

                // Function to filter daerah options based on selected negeri and kod_daerah_pejabat
                function filterDaerahOptions() {
                    const selectedNegeriId = negeriSelect.options[negeriSelect.selectedIndex].getAttribute('data-id');
                    Array.from(daerahSelect.options).forEach(option => {
                        if (option.getAttribute('data-negeri-id') === selectedNegeriId && option.value !== '') {
                            option.style.display = 'block';
                        } else {
                            option.style.display = 'none';
                        }
                    });
                    daerahSelect.value = ''; 
                }

                // Event listeners
                perananField.addEventListener('change', toggleFields);
                negeriSelect.addEventListener('change', filterDaerahOptions);

                // Initial setup
                toggleFields();
                filterDaerahOptions();
            });

            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('pegawai_mohon_daftar_form').addEventListener('submit', function(event) {
                    var emailInput = document.getElementById('emelPegawai').value;
                    if (emailInput.includes('@')) {
                        alert('Sila masukkan hanya nama e-mel pengguna tanpa domain.');
                        event.preventDefault();
                    }
                });
            });
        </script>

        <script>
            document.getElementById('pegawai_mohon_daftar_form').addEventListener('submit', function(e) {
                const noKp = document.getElementById('no_kp').value;
                const noTel = document.getElementById('no_tel').value;
                
                // Check if no_kp is exactly 12 digits
                if (!/^\d{12}$/.test(noKp)) {
                    alert('No Kad Pengenalan mesti tepat 12 digit.');
                    e.preventDefault();
                }
            
                // Check if no_tel is between 10 to 11 digits
                if (!/^\d{10,11}$/.test(noTel)) {
                    alert('Nombor Telefon mesti antara 10 hingga 11 digit.');
                    e.preventDefault();
                }
            });
        </script>  
        
        {{-- <script>
            // Initialize Bootstrap tooltips
            document.addEventListener('DOMContentLoaded', function () {
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });
            });
        </script> --}}
    </body>
</x-guest-layout>