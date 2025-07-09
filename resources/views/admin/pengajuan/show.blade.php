@extends('layouts.app')
@section('title', 'Detail Pengajuan')

@section('content')
<div class="container mt-4">
    <h3>Detail Pengajuan</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Informasi Umum --}}
    <div class="mb-3">
        <strong>Nama Pengaju:</strong> {{ $pengajuan->user->name }}<br>
        <strong>Jenis Pengajuan:</strong> {{ ucfirst($pengajuan->jenis_pengajuan) }}<br>
        <strong>Status:</strong>
        <span class="badge
            @if($pengajuan->status == 'draft') bg-secondary
            @elseif($pengajuan->status == 'diproses') bg-warning text-dark
            @elseif($pengajuan->status == 'disetujui') bg-success
            @elseif($pengajuan->status == 'ditolak') bg-danger
            @endif">
            {{ ucfirst($pengajuan->status) }}
        </span><br>
        <strong>Tanggal Pengajuan:</strong> {{ $pengajuan->tanggal_pengajuan->format('d-m-Y') }}
    </div>

    {{-- Informasi Menara --}}
    @if($pengajuan->jenis_pengajuan === 'eksisting' && $pengajuan->menara)
        <h5>Informasi Menara (Eksisting)</h5>
        <ul>
            <li><strong>Site Code:</strong> {{ $pengajuan->menara->site_code }}</li>
            <li><strong>Site Name:</strong> {{ $pengajuan->menara->site_name }}</li>
            <li><strong>Alamat:</strong> {{ $pengajuan->menara->alamat }}</li>
            <li><strong>Koordinat:</strong> {{ $pengajuan->menara->latitude }}, {{ $pengajuan->menara->longitude }}</li>
            <li><strong>Tinggi:</strong> {{ $pengajuan->menara->tinggi_menara }} meter</li>
        </ul>
    @elseif($pengajuan->jenis_pengajuan === 'baru')
        <h5>Informasi Menara (Baru)</h5>
        @php $data = $pengajuan->menara_baru_data; @endphp
        <ul>
            <li><strong>Site Code:</strong> {{ $data['site_code'] ?? '-' }}</li>
            <li><strong>Site Name:</strong> {{ $data['site_name'] ?? '-' }}</li>
            <li><strong>Alamat:</strong> {{ $data['alamat'] ?? '-' }}</li>
            <li><strong>Koordinat:</strong> {{ $data['latitude'] ?? '-' }}, {{ $data['longitude'] ?? '-' }}</li>
            <li><strong>Tinggi:</strong> {{ $data['tinggi_menara'] ?? '-' }} meter</li>
        </ul>
    @endif

    {{-- Daftar Lampiran --}}
    <h5 class="mt-4">Lampiran Dokumen</h5>
    <table class="table table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th>Jenis</th>
                <th>File</th>
                <th>Catatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($requiredDocs as $doc)
                @php
                    $lampiran = $pengajuan->lampiran->firstWhere('tipe', $doc);
                @endphp
                <tr>
                    <td>{{ strtoupper(str_replace('_', ' ', $doc)) }}</td>
                    <td>
                        @if($lampiran)
                            <a href="{{ Storage::url($lampiran->path_file) }}" target="_blank">Lihat</a>
                        @else
                            <span class="text-danger">Belum diunggah</span>
                        @endif
                    </td>
                    <td>
                        @if($lampiran)
                            <form action="{{ route('admin.pengajuan.updateCatatanLampiran', $lampiran) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <textarea name="catatan" class="form-control mb-1" rows="2">{{ $lampiran->catatan }}</textarea>
                                <button class="btn btn-sm btn-primary">Simpan Catatan</button>
                            </form>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Verifikasi --}}
    @if(in_array($pengajuan->status, ['draft', 'diproses']))
        <hr>
        <h5>Form Verifikasi</h5>
        <form method="POST" action="{{ route('admin.pengajuan.verifikasi', $pengajuan) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Status Verifikasi</label>
                <select name="status" class="form-control" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="disetujui">Disetujui</option>
                    <option value="ditolak">Ditolak</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Simpan Verifikasi</button>
        </form>
    @endif

    <a href="{{ route('admin.pengajuan.index') }}" class="btn btn-secondary mt-4">Kembali</a>
</div>
@endsection
