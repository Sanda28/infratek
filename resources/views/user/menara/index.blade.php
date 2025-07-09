@extends('layouts.app')

@section('title', 'Daftar Menara')

@section('content')
<div class="container mt-4">
    <h4>Daftar Menara Saya</h4>
    <table class="table table-bordered table-striped mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Site Code</th>
                <th>Site Name</th>
                <th>Lokasi</th>
                <th>Kecamatan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($menaras as $index => $menara)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $menara->site_code }}</td>
                    <td>{{ $menara->site_name }}</td>
                    <td>{{ $menara->desa->nama ?? '-' }}</td>
                    <td>{{ $menara->kecamatan->nama ?? '-' }}</td>
                    <td>
                        <a href="{{ route('user.menara.show', $menara->id) }}" class="btn btn-info btn-sm">Detail</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada data menara.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
