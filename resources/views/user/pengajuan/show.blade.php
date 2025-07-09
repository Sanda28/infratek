@extends('layouts.app')
@section('title', 'Detail Pengajuan')

@section('content')
<div class="container mt-4">
    <h3>Detail Pengajuan</h3>

    <div class="mb-4">
        <strong>Jenis Pengajuan:</strong> {{ ucfirst($pengajuan->jenis_pengajuan) }}<br>
        <strong>Status:</strong> {{ ucfirst($pengajuan->status) }}<br>
        <strong>Tanggal:</strong> {{ $pengajuan->tanggal_pengajuan->format('d-m-Y') }}
    </div>

    {{-- Menampilkan Informasi Menara --}}
    @if ($pengajuan->jenis_pengajuan === 'eksisting' && $pengajuan->menara)
        <h5>Informasi Menara (Eksisting)</h5>
        <ul>
            <li><strong>Site Code:</strong> {{ $pengajuan->menara->site_code }}</li>
            <li><strong>Site Name:</strong> {{ $pengajuan->menara->site_name }}</li>
            <li><strong>Alamat:</strong> {{ $pengajuan->menara->alamat }}</li>
            <li><strong>Koordinat:</strong> {{ $pengajuan->menara->latitude }}, {{ $pengajuan->menara->longitude }}</li>
            <li><strong>Tinggi:</strong> {{ $pengajuan->menara->tinggi_menara }} meter</li>
            <li><strong>IMB:</strong> {{ $pengajuan->menara->imb }}</li>
            <li><strong>Rekom:</strong> {{ $pengajuan->menara->rekom }}</li>
        </ul>

    @elseif ($pengajuan->jenis_pengajuan === 'baru')
        <h5>Form Data Menara Baru</h5>
        <form method="POST" action="{{ route('user.pengajuan.updateMenaraBaru', $pengajuan) }}">
            @csrf
            @method('PUT')

            @php
                $data = $pengajuan->menara_baru_data ?? [];
            @endphp

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Site Code</label>
                    <input type="text" name="site_code" class="form-control" value="{{ $data['site_code'] ?? '' }}" {{ in_array($pengajuan->status, ['disetujui', 'ditolak']) ? 'readonly' : '' }} required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Site Name</label>
                    <input type="text" name="site_name" class="form-control" value="{{ $data['site_name'] ?? '' }}" {{ in_array($pengajuan->status, ['disetujui', 'ditolak']) ? 'readonly' : '' }} required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Kecamatan</label>
                    <select name="kecamatan_id" id="kecamatan_select" class="form-control" {{ in_array($pengajuan->status, ['disetujui', 'ditolak']) ? 'disabled' : '' }}>
                        <option value="">Pilih Kecamatan</option>
                        @foreach($kecamatans as $kec)
                            <option value="{{ $kec->id }}" {{ ($data['kecamatan_id'] ?? '') == $kec->id ? 'selected' : '' }}>{{ $kec->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Desa</label>
                    <select name="desa_id" id="desa_select" class="form-control" {{ empty($data['kecamatan_id']) ? 'disabled' : '' }} {{ in_array($pengajuan->status, ['disetujui', 'ditolak']) ? 'disabled' : '' }}>
                        <option value="">Pilih Desa</option>
                        @foreach($desas as $desa)
                            <option value="{{ $desa->id }}" data-kecamatan="{{ $desa->kecamatan_id }}"
                                {{ ($data['desa_id'] ?? '') == $desa->id ? 'selected' : '' }}>
                                {{ $desa->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-12 mb-3">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control" rows="2" {{ in_array($pengajuan->status, ['disetujui', 'ditolak']) ? 'readonly' : '' }}>{{ $data['alamat'] ?? '' }}</textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Latitude</label>
                    <input type="text" name="latitude" class="form-control" value="{{ $data['latitude'] ?? '' }}" {{ in_array($pengajuan->status, ['disetujui', 'ditolak']) ? 'readonly' : '' }}>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Longitude</label>
                    <input type="text" name="longitude" class="form-control" value="{{ $data['longitude'] ?? '' }}" {{ in_array($pengajuan->status, ['disetujui', 'ditolak']) ? 'readonly' : '' }}>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Tinggi Menara (m)</label>
                    <input type="number" name="tinggi_menara" class="form-control" value="{{ $data['tinggi_menara'] ?? '' }}" {{ in_array($pengajuan->status, ['disetujui', 'ditolak']) ? 'readonly' : '' }}>
                </div>

                <div class="col-md-6 mb-3">
                    <label>IMB</label>
                    <input type="text" name="imb" class="form-control" value="{{ $data['imb'] ?? '-' }}" {{ in_array($pengajuan->status, ['disetujui', 'ditolak']) ? 'readonly' : '' }}>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Rekom</label>
                    <input type="text" name="rekom" class="form-control" value="{{ $data['rekom'] ?? '-' }}" {{ in_array($pengajuan->status, ['disetujui', 'ditolak']) ? 'readonly' : '' }}>
                </div>
            </div>

            @if (!in_array($pengajuan->status, ['disetujui', 'ditolak']))
                <button class="btn btn-primary">Simpan Data Menara Baru</button>
            @endif
        </form>
    @endif

    <hr>

    {{-- Dokumen --}}
    <h5 class="mt-4">Lampiran Dokumen</h5>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Jenis Dokumen</th>
                    <th>File</th>
                    <th>Ganti</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($requiredDocs as $doc)
                    @php
                        $lampiran = $pengajuan->lampiran->firstWhere('tipe', $doc);
                    @endphp
                    <tr>
                        <td>{{ strtoupper(str_replace('_', ' ', $doc)) }}</td>
                        <td>
                            @if ($lampiran)
                                <a href="{{ Storage::url($lampiran->path_file) }}" target="_blank">Lihat</a>
                            @else
                                <span class="text-danger">Belum diunggah</span>
                            @endif
                        </td>
                        <td>
                            @if(!in_array($pengajuan->status, ['disetujui', 'ditolak']))
                                <form method="POST" action="{{ route('user.pengajuan.updateMenaraBaru', $pengajuan) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="tipe" value="{{ $doc }}">
                                    <input type="file" name="file" class="form-control" required>
                                    <button class="btn btn-sm btn-success mt-1">Unggah / Ganti</button>
                                </form>
                            @else
                                <span class="text-muted">Tidak dapat mengunggah</span>
                            @endif
                        </td>
                        <td>
    @if($lampiran)
        <a href="{{ Storage::url($lampiran->path_file) }}" target="_blank">Lihat</a><br>
        @if($lampiran->catatan)
            <small class="text-danger">Catatan: {{ $lampiran->catatan }}</small>
        @endif
    @else
        <span class="text-danger">Belum diunggah</span>
    @endif
</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">
    <a href="{{ route('user.pengajuan.index') }}" class="btn btn-secondary">Kembali</a>
</div>
</div>



@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const kecamatanSelect = document.getElementById('kecamatan_select');
        const desaSelect = document.getElementById('desa_select');

        if (kecamatanSelect) {
            kecamatanSelect.addEventListener('change', function () {
                const selected = this.value;
                desaSelect.disabled = !selected;

                Array.from(desaSelect.options).forEach(opt => {
                    opt.hidden = opt.dataset.kecamatan !== selected && opt.value !== '';
                });

                desaSelect.value = '';
            });

            // Trigger filtering desa saat halaman dimuat
            const selectedKecamatan = '{{ $data['kecamatan_id'] ?? '' }}';
            if (selectedKecamatan) {
                desaSelect.disabled = false;
                Array.from(desaSelect.options).forEach(opt => {
                    opt.hidden = opt.dataset.kecamatan !== selectedKecamatan && opt.value !== '';
                });
            }
        }
    });
</script>
@endpush
