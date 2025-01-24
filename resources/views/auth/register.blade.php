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
    
        <form method="POST" action="{{ route('register') }}" id="pegawai_mohon_daftar_form" novalidate>
            @csrf
            <!-- Nama -->
            <div class="mt-2">
                <x-input-label for="nama" :value="__('Nama Penuh')" :required="true" />
                <input type="text" class="form-control w-full" placeholder="" id="nama" name="nama" style="text-transform: uppercase;" required/>
                <x-input-error :messages="$errors->get('nama')" class="mt-2" />
            </div>
    
            {{-- No Kad Pengenalan --}}
            <div class="mt-4">
                <x-input-label for="no_kp" :value="__('No. Kad Pengenalan')" :required="true"/>
                <input type="text" class="form-control w-full" placeholder="Contoh: 980406010678" id="no_kp" name="no_kp" inputmode="numeric" maxlength="12" required/>
                <x-input-error :messages="$errors->get('no_kp')" class="mt-2" />
            </div>
      
            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="emelPegawai" :value="__('E-mel')" :required="true"/>
                <div class="input-group">
                    <input type="text" class="form-control w-full" placeholder="contoh12" id="emelPegawai" name="emelPegawai" required />
                    <span class="input-group-text">@aadk.gov.my</span>
                </div>
                <x-input-error :messages="$errors->get('emelPegawai')" class="mt-2" />
            </div>
    
            {{-- No Telefon --}}
            <div class="mt-4">
                <x-input-label for="no_tel" :value="__('No. Telefon')" :required="true"/>
                <input type="text" class="form-control w-full" placeholder="Contoh: 0109000000" id="no_tel" name="no_tel" inputmode="numeric" maxlength="11" required />
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
                <x-input-label for="negeri_bertugas" :value="__('Negeri Bertugas')" :required="true"/>
                <select id="negeri_bertugas" name="negeri_bertugas" class="form-control w-full">
                    <option value="">{{ __('Pilih Negeri') }}</option>
                    @foreach ($negeri as $item1)
                        <option value="{{ $item1->negeri_id }}" data-id="{{ $item1->negeri_id }}">{{ $item1->negeri }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('negeri_bertugas')" class="mt-2" />
            </div>
    
            <!-- Daerah Bertugas -->
            <div class="mt-4" id="mohon_daerah_field">
                <x-input-label for="daerah_bertugas" :value="__('Daerah Bertugas')" :required="true"/>
                <select id="daerah_bertugas" name="daerah_bertugas" class="form-control w-full">
                    <option value="">{{ __('Pilih Daerah') }}</option>
                    @foreach ($daerah as $item2)
                        <option value="{{ $item2->kod }}" data-negeri-id="{{ $item2->negeri_id }}">{{ $item2->daerah }}</option>
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
                        negeriSelect.required = false;
                        daerahSelect.required = false;
                    } else if (peranan === 4) {
                        negeriField.style.display = 'block';
                        daerahField.style.display = 'none';
                        negeriSelect.required = true;
                        daerahSelect.required = false;
                    } else if (peranan === 5) {
                        negeriField.style.display = 'block';
                        daerahField.style.display = 'block';
                        negeriSelect.required = true;
                        daerahSelect.required = true;
                    } else {
                        negeriField.style.display = 'none';
                        daerahField.style.display = 'none';
                        negeriSelect.required = false;
                        daerahSelect.required = false;
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

            // document.addEventListener('DOMContentLoaded', function() {
            //     document.getElementById('pegawai_mohon_daftar_form').addEventListener('submit', function(event) {
            //         const peranan = parseInt(perananField.value);

            //         // Check if required fields are filled based on peranan
            //         if (peranan === 4 && negeriSelect.value === '') { // Pegawai AADK Negeri
            //             alert('Sila pilih Negeri Bertugas untuk Pegawai AADK Negeri.');
            //             event.preventDefault();
            //         } else if (peranan === 5 && (negeriSelect.value === '' || daerahSelect.value === '')) { // Pegawai AADK Daerah
            //             alert('Sila pilih Negeri dan Daerah Bertugas untuk Pegawai AADK Daerah.');
            //             event.preventDefault();
            //         }

            //         var emailInput = document.getElementById('emelPegawai').value;
            //         if (emailInput.includes('@')) {
            //             alert('Sila masukkan hanya nama e-mel pengguna tanpa domain.');
            //             event.preventDefault();
            //         }
            //     });
            // });
        </script>

        <script>
            // Prevent typing numeric characters
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('nama').addEventListener('input', function (e) {
                    this.value = this.value.replace(/[^a-zA-Z\s'@]/g, '');
                });

                // Restrict input to digits by listening for input event
                document.getElementById('no_kp').addEventListener('input', function (e) {
                    this.value = this.value.replace(/\D/g, '');  // Remove non-digit characters
                    if (this.value.length > 12) {                // Limit to 12 digits
                        this.value = this.value.slice(0, 12);
                    }
                });

                document.getElementById('no_tel').addEventListener('input', function (e) {
                    this.value = this.value.replace(/\D/g, '');  // Remove non-digit characters
                    if (this.value.length > 11) {                // Limit to 11 digits
                        this.value = this.value.slice(0, 11);
                    }
                });

                // Add event listener to form submission
                document.getElementById('pegawai_mohon_daftar_form').addEventListener('submit', function(e) {
                    const nama = document.getElementById('nama').value;
                    const noKp = document.getElementById('no_kp').value;
                    const emel = document.getElementById('emelPegawai').value;
                    const noTel = document.getElementById('no_tel').value;
                    const jawatan = document.getElementById('jawatan').value;
                    const peranan = document.getElementById('peranan').value;
                    const negeriBertugas = document.getElementById('negeri_bertugas').value;
                    const daerahBertugas = document.getElementById('daerah_bertugas').value;

                    // Custom validation and error messages
                    if (!nama) {
                        alert('Sila masukkan nama penuh anda.');
                        e.preventDefault(); // Prevent form submission
                        return false;
                    }

                    if (!noKp || noKp.length !== 12) {
                        alert('Sila masukkan no kad pengenalan yang sah (12 digit).');
                        e.preventDefault();
                        return false;
                    }

                    if (!emel) {
                        alert('Sila masukkan domain emel rasmi @aadk.gov.my.');
                        e.preventDefault();
                        return false;
                    }

                    var emailInput = document.getElementById('emelPegawai').value;
                    if (emailInput.includes('@')) {
                        alert('Sila masukkan hanya nama e-mel pengguna tanpa domain.');
                        event.preventDefault();
                    }

                    if (!noTel || noTel.length < 10 || noTel.length > 11) {
                        alert('Bilangan digit nombor telefon mesti antara 10 hingga 11 digit.');
                        e.preventDefault();
                        return false;
                    }

                    if (!jawatan) {
                        alert('Sila pilih jawatan anda bekerja.');
                        e.preventDefault();
                        return false;
                    }

                    if (!peranan) {
                        alert('Sila pilih peranan anda sebagai pengguna sistem ini.');
                        e.preventDefault();
                        return false;
                    }

                    // Validate 'negeri_bertugas' if peranan is 4 or 5
                    if ((peranan == '4' || peranan == '5') && !negeriBertugas) {
                        alert('Sila pilih pejabat AADK negeri yang anda bertugas.');
                        e.preventDefault();
                        return false;
                    }

                    // Validate 'daerah_bertugas' if peranan is 5
                    if (peranan == '5' && !daerahBertugas) {
                        alert('Sila pilih pejabat AADK daerah yang anda bertugas.');
                        e.preventDefault();
                        return false;
                    }
                });
            });
        </script>
    </body>
</x-guest-layout>