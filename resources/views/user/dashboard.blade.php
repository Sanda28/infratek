@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Dashboard Pengguna</h1>

    <div class="row">

        <!-- Menara Saya -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Menara Saya</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlahMenara }}</div>
                    </div>
                    <i class="fas fa-broadcast-tower fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>

        <!-- Pengajuan Saya -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Pengajuan Saya</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlahPengajuan }}</div>
                    </div>
                    <i class="fas fa-upload fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>

        <!-- Status Diterima -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Disetujui</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlahDiterima }}</div>
                    </div>
                    <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>

    </div>

    <!-- Recent Pengajuan -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-primary text-white">
            <h6 class="m-0 font-weight-bold">Riwayat Pengajuan Terakhir</h6>
        </div>
        <div class="card-body">
            @if($pengajuanTerakhir->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Jenis Pengajuan</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengajuanTerakhir as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ ucfirst($item->jenis) }}</td>
                            <td>
                                <span class="badge badge-{{ $item->status == 'disetujui' ? 'success' : ($item->status == 'ditolak' ? 'danger' : 'warning') }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <p class="text-center text-muted">Belum ada pengajuan.</p>
            @endif
        </div>
    </div>
</div>
@endsection
