@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Dashboard Admin</h4>

    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card text-bg-primary shadow-sm">
                <div class="card-body">
                    <h6 class="card-title">Total Menara</h6>
                    <h3 class="card-text">{{ $totalMenara }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-success shadow-sm">
                <div class="card-body">
                    <h6 class="card-title">Pengajuan Disetujui</h6>
                    <h3 class="card-text">{{ $disetujui }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-warning shadow-sm">
                <div class="card-body">
                    <h6 class="card-title">Pengajuan Menunggu</h6>
                    <h3 class="card-text">{{ $menunggu }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-info shadow-sm">
                <div class="card-body">
                    <h6 class="card-title">Total Pengguna</h6>
                    <h3 class="card-text">{{ $totalUser }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-5">
        <h5>Grafik Pengajuan per Bulan</h5>
        <canvas id="grafikPengajuan" height="100"></canvas>
    </div>

    <div class="table-responsive">
        <h5>Pengajuan Terbaru</h5>
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>Nama Pengguna</th>
                    <th>Jenis Pengajuan</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengajuanTerbaru as $item)
                    <tr>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->jenis }}</td>
                        <td><span class="badge bg-secondary text-capitalize">{{ $item->status }}</span></td>
                        <td>{{ $item->created_at->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada pengajuan terbaru.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('grafikPengajuan').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($bulan),
            datasets: [{
                label: 'Jumlah Pengajuan',
                data: @json($jumlahPengajuan),
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.1)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    precision: 0
                }
            }
        }
    });
</script>
@endpush
