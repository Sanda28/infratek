@extends('layouts.app')
@section('title', 'Edit Menara')

@section('content')
<div class="container mt-4">
    <h3>Edit Data Menara</h3>
    <form method="POST" action="{{ route('admin.menara.update', $menara) }}">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Site Code</label>
                <input type="text" name="site_code" class="form-control" value="{{ old('site_code', $menara->site_code) }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label>Site Name</label>
                <input type="text" name="site_name" class="form-control" value="{{ old('site_name', $menara->site_name) }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Kecamatan</label>
                <select name="kecamatan_id" class="form-control" required>
                    <option value="">-- Pilih Kecamatan --</option>
                    @foreach($kecamatans as $kec)
                        <option value="{{ $kec->id }}" {{ $kec->id == $menara->kecamatan_id ? 'selected' : '' }}>{{ $kec->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label>Desa</label>
                <select name="desa_id" class="form-control" required>
                    <option value="">-- Pilih Desa --</option>
                    @foreach($desas as $desa)
                        <option value="{{ $desa->id }}" {{ $desa->id == $menara->desa_id ? 'selected' : '' }}>{{ $desa->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-12 mb-3">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control" rows="2">{{ old('alamat', $menara->alamat) }}</textarea>
            </div>

            <div class="col-md-6 mb-3">
                <label>Latitude</label>
                <input type="text" name="latitude" class="form-control" value="{{ old('latitude', $menara->latitude) }}">
            </div>
            <div class="col-md-6 mb-3">
                <label>Longitude</label>
                <input type="text" name="longitude" class="form-control" value="{{ old('longitude', $menara->longitude) }}">
            </div>

            <div class="col-md-6 mb-3">
                <label>Tinggi Menara</label>
                <input type="number" name="tinggi_menara" class="form-control" value="{{ old('tinggi_menara', $menara->tinggi_menara) }}">
            </div>
            <div class="col-md-6 mb-3">
                <label>IMB</label>
                <input type="text" name="imb" class="form-control" value="{{ old('imb', $menara->imb) }}">
            </div>
            <div class="col-md-6 mb-3">
                <label>Rekom</label>
                <input type="text" name="rekom" class="form-control" value="{{ old('rekom', $menara->rekom) }}">
            </div>

            <div class="col-md-6 mb-3">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="aktif" {{ $menara->status === 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ $menara->status === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>
        </div>

        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.menara.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
