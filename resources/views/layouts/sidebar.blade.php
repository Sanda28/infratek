<div class="bg-dark vh-100 sidebar p-3">
    <h4 class="text-white mb-4">Infratek</h4>

    <ul class="nav flex-column">
        {{-- Dashboard --}}
        <li class="nav-item">
            <a href="{{ route('dashboard') }}"
               class="nav-link text-white {{ request()->routeIs('dashboard') ? 'active fw-bold' : '' }}">
                <i class="fas fa-tachometer-alt me-2"></i> Dashboard
            </a>
        </li>

        @auth
            {{-- Menu untuk Admin --}}
            @if (auth()->user()->role === 'admin')
                <li class="nav-item">
                    <a href="{{ route('admin.menara.index') }}"
                    class="nav-link text-white {{ request()->routeIs('admin.menara.index') ? 'active fw-bold' : '' }}">
                        <i class="fas fa-broadcast-tower me-2"></i> Data Menara
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.menara.peta') }}"
                    class="nav-link text-white {{ request()->routeIs('admin.menara.peta') ? 'active fw-bold' : '' }}">
                        <i class="fas fa-map me-2"></i> Peta Menara
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.pengajuan.index') }}"
                       class="nav-link text-white {{ request()->routeIs('admin.pengajuan.index') ? 'active fw-bold' : '' }}">
                        <i class="fas fa-upload me-2"></i> Semua Pengajuan
                    </a>
                </li>

            {{-- Menu untuk User --}}
            @elseif (auth()->user()->role === 'user')
                <li class="nav-item">
                    <a href="{{ route('user.menara.index') }}"
                       class="nav-link text-white {{ request()->routeIs('user.menara.index') ? 'active fw-bold' : '' }}">
                        <i class="fas fa-broadcast-tower me-2"></i> Menara Saya
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.menara.peta') }}"
                    class="nav-link text-white {{ request()->routeIs('user.menara.peta') ? 'active fw-bold' : '' }}">
                        <i class="fas fa-map-marked-alt me-2"></i> Peta Menara
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('user.pengajuan.index') }}"
                       class="nav-link text-white {{ request()->routeIs('user.pengajuan.index') ? 'active fw-bold' : '' }}">
                        <i class="fas fa-upload me-2"></i> Pengajuan Menara
                    </a>
                </li>
            @endif
        @endauth

        {{-- Logout --}}
        <li class="nav-item mt-3">
            <a href="{{ route('logout') }}"
               class="nav-link text-white"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt me-2"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</div>
