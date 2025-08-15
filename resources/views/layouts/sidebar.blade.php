<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{ config('app.name', 'Laravel') }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

   @if(auth()->check() && auth()->user()->role === 'admin')
        <li class="nav-item {{ request()->is('departements*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('departements.index') }}">
                <i class="fas fa-building"></i>
                <span>Departemen</span>
            </a>
        </li>

        <li class="nav-item {{ request()->is('employees*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('employees.index') }}">
                <i class="fas fa-id-card"></i>
                <span>Karyawan</span>
            </a>
        </li>

        <li class="nav-item {{ request()->is('users*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('users.index') }}">
                <i class="fas fa-users"></i>
                <span>Manajemen Pengguna</span>
            </a>
        </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider">
</ul>
