<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Menara BTS') }}</title>

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    {{-- Custom Styles --}}
    <style>
        body {
            background-color: #f8f9fc;
        }
        .sidebar {
            background-color: #4e73df;
            color: white;
            min-height: 100vh;
        }
        .sidebar a {
            color: white;
        }
        .sidebar a.active, .sidebar a:hover {
            background-color: rgba(255, 255, 255, 0.15);
            font-weight: bold;
        }
        .footer {
            background-color: #e3e6f0;
            padding: 1rem;
            text-align: center;
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="d-flex flex-column flex-md-row">
        @include('layouts.sidebar')

        <div class="flex-grow-1 d-flex flex-column min-vh-100">
            @include('layouts.navbar')

            <main class="container my-4 flex-grow-1">
                @yield('content')
            </main>

            @include('layouts.footer')
        </div>
    </div>

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
