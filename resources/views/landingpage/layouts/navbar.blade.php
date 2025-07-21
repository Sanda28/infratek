<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
  <div class="container px-3 px-md-5">
    <a class="navbar-brand fw-bold" href="{{ url('/') }}">
      Infratek Bogor
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarLanding" aria-controls="navbarLanding" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarLanding">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('home/peta') ? 'active' : '' }}" href="{{ url('home/peta') }}">Peta</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('home/statistik') ? 'active' : '' }}" href="{{ url('home/statistik') }}">Statistik</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-primary ms-lg-3 mt-2 mt-lg-0" href="{{ route('login') }}">
            <i class="fas fa-user-lock me-1"></i> Login
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
