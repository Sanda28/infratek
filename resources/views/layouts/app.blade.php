<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Menara BTS') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    {{-- Leaflet CSS --}}


    <style>
        body { background-color: #f8f9fc; }
        .sidebar { background-color: #4e73df; min-height: 100vh; color: white; }
        .sidebar a { color: white; }
        .sidebar a.active { background-color: rgba(255, 255, 255, 0.1); }
    </style>
    @stack('styles')
</head>
<body>
    <div class="d-flex">
        @include('layouts.sidebar')

        <div class="flex-grow-1">
            @include('layouts.navbar')

            <div class="container mt-4">
                @yield('content')
            </div>

            @include('layouts.footer')
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Leaflet JS --}}
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-o9N1j7kP0IjPtd4FjQrKyju1Dp8bqzc3c79SmA+4bGc="
        crossorigin=""></script>

    @stack('scripts')
</body>
</html>
