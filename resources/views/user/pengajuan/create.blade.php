@extends('layouts.app')
@section('title', 'Buat Pengajuan Menara')

@section('content')
<div class="container mt-4">
    <h3>Buat Pengajuan Menara</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops!</strong> Ada error:<br>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('user.pengajuan.store') }}">
        @csrf

        {{-- Jenis Pengajuan --}}
        <div class="mb-3">
            <label for="jenis_pengajuan" class="form-label">Jenis Pengajuan</label>
            <select name="jenis_pengajuan" id="jenis_pengajuan" class="form-control" required onchange="toggleJenis(this.value)">
                <option value="">-- Pilih Jenis --</option>
                <option value="baru" {{ old('jenis_pengajuan') === 'baru' ? 'selected' : '' }}>Baru</option>
                <option value="eksisting" {{ old('jenis_pengajuan') === 'eksisting' ? 'selected' : '' }}>Eksisting</option>
            </select>
        </div>

        {{-- Menara Eksisting --}}
        <div class="mb-3" id="menara_field" style="display: none">
            <label for="menara_id" class="form-label">Pilih Menara</label>
            <select name="menara_id" class="form-control">
                <option value="">-- Pilih Menara --</option>
                @foreach($menaras as $m)
                    <option value="{{ $m->id }}" {{ old('menara_id') == $m->id ? 'selected' : '' }}>
                        {{ $m->site_name }} ({{ $m->site_code }})
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Menara Baru --}}
        <div id="menara_baru_fields" style="display: none;">
            <h5 class="mt-4">Informasi Menara Baru</h5>

            <div class="mb-3">
                <label class="form-label">Site Code</label>
                <input type="text" name="site_code" class="form-control" value="{{ old('site_code') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Site Name</label>
                <input type="text" name="site_name" class="form-control" value="{{ old('site_name') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Latitude</label>
                <input type="text" name="latitude" class="form-control" value="{{ old('latitude') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Longitude</label>
                <input type="text" name="longitude" class="form-control" value="{{ old('longitude') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Tinggi Menara (meter)</label>
                <input type="number" name="tinggi_menara" class="form-control" value="{{ old('tinggi_menara') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat Menara</label>
                <textarea name="alamat" class="form-control">{{ old('alamat') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Kecamatan</label>
                <select name="kecamatan_id" id="kecamatan_select" class="form-control">
                    <option value="">-- Pilih Kecamatan --</option>
                    @foreach($kecamatans as $kec)
                        <option value="{{ $kec->id }}" {{ old('kecamatan_id') == $kec->id ? 'selected' : '' }}>{{ $kec->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Desa</label>
                <select name="desa_id" id="desa_select" class="form-control" disabled>
                    <option value="">-- Pilih Desa --</option>
                    @foreach($desas as $desa)
                        <option value="{{ $desa->id }}" data-kecamatan="{{ $desa->kecamatan_id }}"
                            {{ old('desa_id') == $desa->id ? 'selected' : '' }}>
                            {{ $desa->nama }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Kirim Pengajuan</button>
    </form>
</div>
@endsection

@push('scripts')
<script>
    function toggleJenis(jenis) {
        const menaraField = document.getElementById('menara_field');
        const menaraBaruFields = document.getElementById('menara_baru_fields');

        if (jenis === 'eksisting') {
            menaraField.style.display = 'block';
            menaraBaruFields.style.display = 'none';
        } else if (jenis === 'baru') {
            menaraField.style.display = 'none';
            menaraBaruFields.style.display = 'block';
        } else {
            menaraField.style.display = 'none';
            menaraBaruFields.style.display = 'none';
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        const jenis = '{{ old('jenis_pengajuan') }}';
        if (jenis) toggleJenis(jenis);

        const kecamatanSelect = document.getElementById('kecamatan_select');
        const desaSelect = document.getElementById('desa_select');
        const selectedKecamatan = '{{ old('kecamatan_id') }}';

        if (selectedKecamatan) {
            desaSelect.disabled = false;
            Array.from(desaSelect.options).forEach(opt => {
                opt.hidden = opt.dataset.kecamatan !== selectedKecamatan;
            });
        }

        kecamatanSelect?.addEventListener('change', function () {
            const selected = this.value;
            desaSelect.disabled = !selected;
            Array.from(desaSelect.options).forEach(opt => {
                opt.hidden = opt.dataset.kecamatan !== selected;
            });
            desaSelect.value = '';
        });
    });
</script>
@endpush
