@extends('layouts.app')
@section('title', 'Data Menara')

@section('content')
<div class="container mt-4">
    <h3>Data Menara</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle" id="menara-table">
            <thead class="table-light text-center">
                <tr>
                    <th>No</th>
                    <th>Site Code</th>
                    <th>Kecamatan</th>
                    <th>Koordinat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($menaras as $index => $m)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $m->site_code }}</td>
                        <td>{{ $m->kecamatan->nama ?? '-' }}</td>
                        <td>{{ $m->latitude }}, {{ $m->longitude }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.menara.show', $m) }}" class="btn btn-sm btn-info mb-1">
                                <i class="fas fa-eye"></i> Detail
                            </a>
                            <a href="{{ route('admin.menara.edit', $m) }}" class="btn btn-sm btn-warning mb-1">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.menara.destroy', $m) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger mb-1">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css" />
@endpush

@push('scripts')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function () {
        $('#menara-table').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
            },
            columnDefs: [
                { orderable: false, targets: [0, 5] }
            ]
        });
    });
</script>
@endpush
