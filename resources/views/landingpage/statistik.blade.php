@extends('landingpage.layouts.app')

@section('title', 'Statistik Menara')

@section('content')
<div class="container-fluid mt-4">
    @if(session('pesan'))
        <div class="alert alert-success">
            {{ session('pesan') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            {!! implode('<br>', $errors->all()) !!}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="mb-3">Statistik Jumlah Menara per Kecamatan</h4>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Kecamatan</th>
                        <th scope="col">Jumlah Menara</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kecamatan as $index => $kec)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $kec->nama }}</td>
                            <td>{{ $jumlahMenara[$kec->id] ?? 0 }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
