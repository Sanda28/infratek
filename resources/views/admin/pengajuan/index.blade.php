@extends('layouts.app')
@section('title', 'Verifikasi Pengajuan Menara')

@section('content')
<div class="container mt-4">
    <h3>Daftar Pengajuan Menara</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Jenis</th>
                    <th>User</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pengajuans as $pengajuan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ ucfirst($pengajuan->jenis_pengajuan) }}</td>
                        <td>{{ $pengajuan->user->name }}</td>
                        <td>
                            <span class="badge
                                @if($pengajuan->status == 'draft') bg-secondary
                                @elseif($pengajuan->status == 'diproses') bg-warning text-dark
                                @elseif($pengajuan->status == 'disetujui') bg-success
                                @elseif($pengajuan->status == 'ditolak') bg-danger
                                @endif">
                                {{ ucfirst($pengajuan->status) }}
                            </span>
                        </td>
                        <td>{{ $pengajuan->tanggal_pengajuan->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('admin.pengajuan.show', $pengajuan) }}" class="btn btn-sm btn-info">Lihat</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
