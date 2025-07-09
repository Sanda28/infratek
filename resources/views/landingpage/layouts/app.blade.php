<!doctype html>
<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>InfraTek | @yield('title', 'Dashboard')</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- Leaflet & Esri Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>
    <script src="https://unpkg.com/esri-leaflet@3.0.10/dist/esri-leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@3.1.4/dist/esri-leaflet-geocoder.css" crossorigin="" />
    <script src="https://unpkg.com/esri-leaflet-geocoder@3.1.4/dist/esri-leaflet-geocoder.js" crossorigin=""></script>

    <!-- Custom Styles (optional) -->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

        .navbar.scrolled {
            background-color: #fff !important;
            transition: background-color 0.3s ease-in-out;
        }
    </style>

    @stack('styles')
</head>
<body data-bs-spy="scroll" data-bs-target="#navScroll">
    <!-- Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column min-vh-100">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand fw-bold text-primary" href="{{ url('/') }}">
                    <i class="fas fa-broadcast-tower"></i> INFRATEK
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav ms-auto">
                        <a class="nav-item nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                            <i class="fas fa-home"></i> Beranda
                        </a>
                        <a class="nav-item nav-link" href="{{ url('home/peta') }}">
                            <i class="fas fa-map-marked-alt"></i> Peta
                        </a>
                        <a class="nav-item nav-link" href="{{ url('home/statistik') }}">
                            <i class="fas fa-chart-bar"></i> Statistik
                        </a>
                    </div>
                    <a class="btn btn-sm btn-info ms-lg-3" href="{{ url('login') }}">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </a>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="flex-grow-1 pt-5 mt-4">
            @yield('content')
        </main>
    </div>

    <!-- Scroll Shadow Navbar JS -->
    <script>
        const header = document.querySelector(".navbar");
        const add_class_on_scroll = () => header.classList.add("scrolled", "shadow-sm");
        const remove_class_on_scroll = () => header.classList.remove("scrolled", "shadow-sm");

        window.addEventListener('scroll', function () {
            window.scrollY >= header.offsetHeight
                ? add_class_on_scroll()
                : remove_class_on_scroll();
        });
    </script>

    <!-- Bootstrap JS (with Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>
</html>
