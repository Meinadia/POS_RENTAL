<div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ url('/') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>

            <li class="nav-header">DATA MOBIL</li>
            <li class="nav-item">
                <a href="{{ route('mobil.index') }}" class="nav-link {{ request()->is('mobil*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-car"></i>
                    <p>Daftar Mobil</p>
                </a>
            </li>

            <li class="nav-header">TRANSAKSI</li>
            <li class="nav-item">
                <a href="{{ route('sewa-mobil.index') }}" class="nav-link {{ request()->is('sewa-mobil*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-handshake"></i>
                    <p>Sewa Mobil</p>
                </a>
            </li>

            <!-- Tombol Logout -->
            <li class="nav-header">Akun</li>
            <li class="nav-item">
                <a href="#" class="nav-link text-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>Logout</p>
                </a>
                <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </nav>
</div>