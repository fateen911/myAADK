@extends('layouts.app')

@section('content')
    {{-- <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Akaun Profil') }}
            </h2>
        </x-slot> --}}
        
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    {{-- </x-app-layout> --}}
@endsection

{{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get the client address fields
            const clientAddress = document.getElementById('alamat_rumah_klien').textContent.trim();
            const clientPoskod = document.getElementById('poskod_klien').textContent.trim();
            const clientDaerah = document.getElementById('daerah_klien').textContent.trim();
            const clientNegeri = document.getElementById('negeri_klien').textContent.trim();

            // Function to copy address fields for Bapa
            function alamatBapa() {
                const checkbox = document.getElementById('alamat_bapa_sama');
                if (checkbox.checked) {
                    document.getElementById('alamat_bapa').value = clientAddress;
                    document.getElementById('poskod_bapa').value = clientPoskod;
                    document.getElementById('daerah_bapa').value = clientDaerah;
                    document.getElementById('negeri_bapa').value = clientNegeri;
                } else {
                    // Clear the fields if the checkbox is unchecked
                    document.getElementById('alamat_bapa').value = '';
                    document.getElementById('poskod_bapa').value = '';
                    document.getElementById('daerah_bapa').value = '';
                    document.getElementById('negeri_bapa').value = '';
                }
            }

            // Function to copy address fields for Ibu
            function alamatIbu() {
                const checkbox = document.getElementById('alamat_ibu_sama');
                if (checkbox.checked) {
                    document.getElementById('alamat_ibu').value = clientAddress;
                    document.getElementById('poskod_ibu').value = clientPoskod;
                    document.getElementById('daerah_ibu').value = clientDaerah;
                    document.getElementById('negeri_ibu').value = clientNegeri;
                } else {
                    // Clear the fields if the checkbox is unchecked
                    document.getElementById('alamat_ibu').value = '';
                    document.getElementById('poskod_ibu').value = '';
                    document.getElementById('daerah_ibu').value = '';
                    document.getElementById('negeri_ibu').value = '';
                }
            }

            // Function to copy address fields for Penjaga
            function alamatPenjaga() {
                const checkbox = document.getElementById('alamat_penjaga_sama');
                if (checkbox.checked) {
                    document.getElementById('alamat_penjaga').value = clientAddress;
                    document.getElementById('poskod_penjaga').value = clientPoskod;
                    document.getElementById('daerah_penjaga').value = clientDaerah;
                    document.getElementById('negeri_penjaga').value = clientNegeri;
                } else {
                    // Clear the fields if the checkbox is unchecked
                    document.getElementById('alamat_penjaga').value = '';
                    document.getElementById('poskod_penjaga').value = '';
                    document.getElementById('daerah_penjaga').value = '';
                    document.getElementById('negeri_penjaga').value = '';
                }
            }

            // Add event listeners for the checkboxes
            document.getElementById('alamat_bapa_sama').addEventListener('change', alamatBapa);
            document.getElementById('alamat_ibu_sama').addEventListener('change', alamatIbu);
            document.getElementById('alamat_penjaga_sama').addEventListener('change', alamatPenjaga);
        });
    </script> --}}
    
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function () {
            var statusSelect = document.getElementById('status_perkahwinan');
            var pasanganFields = document.getElementById('pasangan-fields');
        
            function togglePasanganFields() {
                console.log('Status Perkahwinan changed to: ', statusSelect.value); // Debugging line
                if (statusSelect.value === 'BERKAHWIN') {
                    pasanganFields.style.display = 'block';
                } else {
                    pasanganFields.style.display = 'none';
                }
            }
        
            // Initialize the visibility on page load
            togglePasanganFields();
        
            // Listen for changes on the status select
            statusSelect.addEventListener('change', function() {
                console.log('Change event detected'); // Debugging line
                togglePasanganFields();
            });
        });
    </script>  --}}
