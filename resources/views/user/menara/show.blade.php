@extends('layouts.app')

@section('title', 'Detail Menara')

@section('content')
<div class="container mt-4">
    <h4>Detail Menara: {{ $menara->site_name }}</h4>
    <div class="card mt-3">
        <div class="card-body">
            <p><strong>Site Code:</strong> {{ $menara->site_code }}</p>
            <p><strong>Desa:</strong> {{ $menara->desa->nama ?? '-' }}</p>
            <p><strong>Kecamatan:</strong> {{ $menara->kecamatan->nama ?? '-' }}</p>
            <p><strong>Alamat:</strong> {{ $menara->alamat }}</p>
            <p><strong>Koordinat:</strong> {{ $menara->latitude }}, {{ $menara->longitude }}</p>
            <p><strong>Tinggi Menara:</strong> {{ $menara->tinggi_menara }} meter</p>
            <p><strong>IMB:</strong> {{ $menara->imb }}</p>
            <p><strong>Rekomendasi:</strong> {{ $menara->rekom }}</p>
            <p><strong>Tahun Rekomendasi:</strong> {{ $menara->tahun_rekom }}</p>
            @if ($menara->image)
                <p><strong>Gambar Menara:</strong><br>
                    <img src="{{ asset('storage/' . $menara->image) }}" width="200" class="img-thumbnail">
                </p>
            @endif
        </div>
    </div>
</div>
@endsection
