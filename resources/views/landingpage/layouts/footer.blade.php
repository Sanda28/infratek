<footer class="bg-light text-center text-lg-start mt-5 border-top shadow-sm">
    <div class="container p-4">
        <div class="row">
            <div class="col-lg-6 col-md-12 mb-4">
                <h5 class="text-uppercase fw-bold">Infratek Kabupaten Bogor</h5>
                <p>
                    Sistem informasi pengajuan izin menara BTS. Menyediakan peta interaktif, data statistik, dan layanan publik yang transparan.
                </p>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <h5 class="text-uppercase">Menu</h5>
                <ul class="list-unstyled mb-0">
                    <li><a href="{{ url('/') }}" class="text-dark text-decoration-none">Beranda</a></li>
                    <li><a href="{{ url('home/peta') }}" class="text-dark text-decoration-none">Peta</a></li>
                    <li><a href="{{ url('home/statistik') }}" class="text-dark text-decoration-none">Statistik</a></li>
                    <li><a href="{{ route('login') }}" class="text-dark text-decoration-none">Login</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <h5 class="text-uppercase">Kontak</h5>
                <p class="mb-1">Dinas Komunikasi dan Informatika</p>
                <p class="mb-0">Kabupaten Bogor, Jawa Barat</p>
                <p>Email: <a href="mailto:info@bogorkab.go.id" class="text-dark text-decoration-none">info@bogorkab.go.id</a></p>
            </div>
        </div>
    </div>
    <div class="text-center p-3 bg-dark text-white">
        © {{ date('Y') }} Infratek - Kabupaten Bogor. All rights reserved.
    </div>
</footer>
