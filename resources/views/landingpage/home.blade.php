@extends('landingpage.layouts.app')

@section('title', 'Beranda')

@section('content')
<div class="container-fluid p-0">
    <!-- Hero Section -->
    <section class="position-relative" style="height: 500px;">
        <img src="{{ asset('assets/img/beranda.jpg') }}" alt="background" class="w-100 h-100 object-fit-cover">
        <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-50"></div>
        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center text-white text-center px-3">
            <div>
                <h1 class="display-4 fw-bold">Infratek</h1>
                <p class="lead">Selamat datang di Aplikasi Sistem Informasi Kabupaten Bogor</p>
                <a href="{{ url('home/peta') }}" class="btn btn-info btn-lg text-white mt-3">
                    <i class="fas fa-map"></i> Cek Peta Kawasan
                </a>
            </div>
        </div>
    </section>

    <!-- Langkah-langkah -->
    <section class="text-center text-dark py-5">
        <div class="container">
            <h2 class="fw-bold mb-3">Langkah Pengajuan Rekomendasi Menara</h2>
            <p class="lead mb-5">
                Berikut adalah langkah-langkah proses pengajuan untuk penerbitan rekomendasi Menara Telekomunikasi di Kabupaten Bantul
            </p>
            <div class="row g-4">
                @foreach ($steps as $title => $description)
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="bg-white shadow-sm p-4 rounded h-100">
                            <h5 class="fw-bold mb-2">{{ $title }}</h5>
                            <p class="mb-0">{{ $description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
@endsection
