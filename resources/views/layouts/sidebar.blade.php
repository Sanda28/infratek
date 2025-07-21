<div class="sidebar p-3 d-none d-md-block" style="width: 250px;">
    <h4 class="text-white mb-4">Infratek</h4>

    <ul class="nav flex-column">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}"
               class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt me-2"></i> Dashboard
            </a>
        </li>

        @auth
            @if (auth()->user()->role === 'admin')
                <li class="nav-item">
                    <a href="{{ route('admin.menara.index') }}"
                       class="nav-link {{ request()->routeIs('admin.menara.*') ? 'active' : '' }}">
                        <i class="fas fa-broadcast-tower me-2"></i> Data Menara
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.menara.peta') }}"
                       class="nav-link {{ request()->routeIs('admin.menara.peta') ? 'active' : '' }}">
                        <i class="fas fa-map me-2"></i> Peta Menara
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.pengajuan.belum') }}"
                    class="nav-link {{ request()->routeIs('admin.pengajuan.belum') ? 'active' : '' }}">
                        <i class="fas fa-hourglass-half me-2"></i>  Proses Pengajuan
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.pengajuan.index') }}"
                    class="nav-link {{ request()->routeIs('admin.pengajuan.index') ? 'active' : '' }}">
                        <i class="fas fa-check-circle me-2"></i> Pengajuan
                    </a>
                </li>


                <li class="nav-item">
                    <a href="{{ route('admin.user.index') }}"
                       class="nav-link {{ request()->routeIs('admin.user.*') ? 'active' : '' }}">
                        <i class="fas fa-users me-2"></i> Kelola Pengguna
                    </a>
                </li>
            @elseif (auth()->user()->role === 'user')
                <li class="nav-item">
                    <a href="{{ route('user.menara.index') }}"
                       class="nav-link {{ request()->routeIs('user.menara.*') ? 'active' : '' }}">
                        <i class="fas fa-broadcast-tower me-2"></i> Menara Saya
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.menara.peta') }}"
                       class="nav-link {{ request()->routeIs('user.menara.peta') ? 'active' : '' }}">
                        <i class="fas fa-map-marked-alt me-2"></i> Peta Menara
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.pengajuan.index') }}"
                       class="nav-link {{ request()->routeIs('user.pengajuan.*') ? 'active' : '' }}">
                        <i class="fas fa-upload me-2"></i> Pengajuan Menara
                    </a>
                </li>
            @endif
        @endauth

        <li class="nav-item mt-3">
            <a href="{{ route('logout') }}"
               class="nav-link"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt me-2"></i> Logout
            </a>
        </li>
    </ul>
</div>
