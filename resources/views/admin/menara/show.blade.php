@extends('layouts.app')
@section('title', 'Detail Menara')

@section('content')
<div class="container mt-4">
    <h3>Detail Menara</h3>

    <ul class="list-group mb-4">
        <li class="list-group-item"><strong>Site Code:</strong> {{ $menara->site_code }}</li>
        <li class="list-group-item"><strong>Site Name:</strong> {{ $menara->site_name }}</li>
        <li class="list-group-item"><strong>Kecamatan:</strong> {{ $menara->kecamatan->nama ?? '-' }}</li>
        <li class="list-group-item"><strong>Desa:</strong> {{ $menara->desa->nama ?? '-' }}</li>
        <li class="list-group-item"><strong>Alamat:</strong> {{ $menara->alamat }}</li>
        <li class="list-group-item"><strong>Koordinat:</strong> {{ $menara->latitude }}, {{ $menara->longitude }}</li>
        <li class="list-group-item"><strong>Tinggi:</strong> {{ $menara->tinggi_menara }} meter</li>
        <li class="list-group-item"><strong>Status:</strong> {{ ucfirst($menara->status) }}</li>
        <li class="list-group-item"><strong>IMB:</strong> {{ $menara->imb }}</li>
        <li class="list-group-item"><strong>Rekom:</strong> {{ $menara->rekom }}</li>
    </ul>

    <a href="{{ route('admin.menara.edit', $menara) }}" class="btn btn-warning">Edit</a>
    <a href="{{ route('admin.menara.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
