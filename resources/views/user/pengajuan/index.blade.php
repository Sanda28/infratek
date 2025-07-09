@extends('layouts.app')
@section('title', 'Pengajuan Menara')

@section('content')
<div class="container mt-4">
    <h3>Daftar Pengajuan Menara</h3>
    <a href="{{ route('user.pengajuan.create') }}" class="btn btn-primary mb-3">Buat Pengajuan</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Jenis</th>
                    <th>Status</th>
                    <th>Progress Dokumen</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengajuans as $pengajuan)
                    @php
                        $required = config('berkas_menara')[$pengajuan->jenis_pengajuan] ?? [];
                        $total = count($required);
                        $uploaded = $pengajuan->lampiran->count();
                        $progress = $total > 0 ? intval(($uploaded / $total) * 100) : 0;
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ ucfirst($pengajuan->jenis_pengajuan) }}</td>
                        <td>
                            <span class="badge
                                @if($pengajuan->status === 'draft') bg-secondary
                                @elseif($pengajuan->status === 'diproses') bg-warning text-dark
                                @elseif($pengajuan->status === 'disetujui') bg-success
                                @elseif($pengajuan->status === 'ditolak') bg-danger
                                @endif">
                                {{ ucfirst($pengajuan->status) }}
                            </span>
                        </td>
                        <td>
                            <div class="progress" style="height: 18px;">
                                <div class="progress-bar bg-info" role="progressbar" style="width: {{ $progress }}%;" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">
                                    {{ $progress }}%
                                </div>
                            </div>
                            <small class="text-muted">{{ $uploaded }} dari {{ $total }} dokumen</small>
                        </td>
                        <td>{{ $pengajuan->tanggal_pengajuan->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('user.pengajuan.show', $pengajuan) }}" class="btn btn-sm btn-info">Detail</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Belum ada pengajuan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
