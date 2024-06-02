@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Profil Klien</h2>
    
    <!-- Display client information -->
    <div class="client-info">
        <p><strong>Nama Penuh:</strong> {{ $klien->nama }}</p>
        <p><strong>No KP:</strong> {{ $klien->no_kp }}</p>
        <p><strong>No Telefon:</strong> {{ $klien->no_tel }}</p>
    </div>

    @if($profileUpdateRequest)
    <h3>Permintaan Kemaskini Profil Yang Tertunda</h3>
    <form method="POST" action="{{ route('pegawai.approveUpdate', ['id' => $profileUpdateRequest->id]) }}">
        @csrf
        @method('PATCH')

        <!-- Display requested data changes -->
        @foreach(json_decode($profileUpdateRequest->requested_data, true) as $key => $value)
        <div class="form-group row">
            <label for="{{ $key }}" class="col-md-3 col-form-label text-md-end">{{ ucfirst(str_replace('_', ' ', $key)) }}</label>
            <div class="col-md-6">
                <input type="text" class="form-control" id="{{ $key }}" name="{{ $key }}" value="{{ $value }}" readonly>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-success" name="approve_field" value="{{ $key }}">Lulus</button>
                <button type="submit" class="btn btn-danger" name="reject_field" value="{{ $key }}">Tolak</button>
            </div>
        </div>
        @endforeach
    </form>
    @else
    <h3>Kemaskini Maklumat Klien</h3>
    <form method="POST" action="{{ route('pegawai.updateClient', ['id' => $klien->id]) }}">
        @csrf
        @method('PATCH')

        <!-- Display client data fields for update -->
        <div class="form-group row">
            <label for="nama" class="col-md-3 col-form-label text-md-end">Nama Penuh</label>
            <div class="col-md-6">
                <input type="text" class="form-control" id="nama" name="nama" value="{{ $klien->nama }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="no_tel" class="col-md-3 col-form-label text-md-end">Nombor Telefon</label>
            <div class="col-md-6">
                <input type="text" class="form-control" id="no_tel" name="no_tel" value="{{ $klien->no_tel }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="emel" class="col-md-3 col-form-label text-md-end">Alamat E-mel</label>
            <div class="col-md-6">
                <input type="email" class="form-control" id="emel" name="emel" value="{{ $klien->emel }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="alamat_rumah" class="col-md-3 col-form-label text-md-end">Alamat Rumah</label>
            <div class="col-md-6">
                <textarea class="form-control" id="alamat_rumah" name="alamat_rumah">{{ $klien->alamat_rumah }}</textarea>
            </div>
        </div>
        <div class="form-group row">
            <label for="poskod" class="col-md-3 col-form-label text-md-end">Poskod</label>
            <div class="col-md-6">
                <input type="text" class="form-control" id="poskod" name="poskod" value="{{ $klien->poskod }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="daerah" class="col-md-3 col-form-label text-md-end">Daerah</label>
            <div class="col-md-6">
                <select class="form-control" id="daerah" name="daerah">
                    <option value="">Pilih Daerah</option>
                    @foreach ($daerah as $item)
                        <option value="{{ $item->id }}" {{ $klien->daerah == $item->id ? 'selected' : '' }}>{{ $item->daerah }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="negeri" class="col-md-3 col-form-label text-md-end">Negeri</label>
            <div class="col-md-6">
                <select class="form-control" id="negeri" name="negeri">
                    <option value="">Pilih Negeri</option>
                    @foreach ($negeri as $item)
                        <option value="{{ $item->id }}" {{ $klien->negeri == $item->id ? 'selected' : '' }}>{{ $item->negeri }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="tahap_pendidikan" class="col-md-3 col-form-label text-md-end">Tahap Pendidikan</label>
            <div class="col-md-6">
                <select class="form-control" id="tahap_pendidikan" name="tahap_pendidikan">
                    <option value="">Pilih Tahap Pendidikan</option>
                    <option value="PENDIDIKAN RENDAH" {{ $klien->tahap_pendidikan == 'PENDIDIKAN RENDAH' ? 'selected' : '' }}>PENDIDIKAN RENDAH</option>
                    <option value="PENDIDIKAN MENENGAH" {{ $klien->tahap_pendidikan == 'PENDIDIKAN MENENGAH' ? 'selected' : '' }}>PENDIDIKAN MENENGAH</option>
                    <option value="PENGAJIAN TINGGI" {{ $klien->tahap_pendidikan == 'PENGAJIAN TINGGI' ? 'selected' : '' }}>PENGAJIAN TINGGI</option>
                </select>
            </div>
        </div>
        <!-- Add other fields as needed -->
        <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>
    @endif
</div>
@endsection
