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
   

    <!-- Manajemen Group -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseManajemen"
            aria-expanded="true" aria-controls="collapseManajemen">
            <i class="fas fa-fw fa-cogs"></i>
            <span>Manajemen</span>
        </a>
        <div id="collapseManajemen" class="collapse {{ request()->is('departements*') || request()->is('employees*') || request()->is('users*') ? 'show' : '' }}" 
             aria-labelledby="headingManajemen" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->is('departements*') ? 'active' : '' }}" href="{{ route('departements.index') }}">
                    <i class="fas fa-building"></i> Departemen
                </a>
                <a class="collapse-item {{ request()->is('employees*') ? 'active' : '' }}" href="{{ route('employees.index') }}">
                    <i class="fas fa-id-card"></i> Karyawan
                </a>
                <a class="collapse-item {{ request()->is('users*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                    <i class="fas fa-users"></i> Pengguna
                </a>
            </div>
        </div>
    </li>

    <!-- Absensi Group -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAbsensi"
            aria-expanded="true" aria-controls="collapseAbsensi">
            <i class="fas fa-fw fa-calendar"></i>
            <span>Absensi</span>
        </a>
        <div id="collapseAbsensi" class="collapse {{ request()->is('attendances*') || request()->is('attendance-history*') ? 'show' : '' }}" 
             aria-labelledby="headingAbsensi" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->is('attendances') && !request()->is('attendance-history') ? 'active' : '' }}" 
                   href="{{ route('attendances.index') }}">
                    <i class="fas fa-calendar-check"></i> Ringkasan Absensi
                </a>
                <a class="collapse-item {{ request()->is('attendance-history') ? 'active' : '' }}" 
                   href="{{ route('attendances.history') }}">
                    <i class="fas fa-history"></i> Detail Riwayat
                </a>
            </div>
        </div>
    </li>
    @endif

    @if(auth()->check() && auth()->user()->role === 'karyawan')

        <li class="nav-item {{ request()->is('attendances') && !request()->is('attendance-history') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('attendances.index') }}">
                <i class="fas fa-calendar-check"></i>
                <span>Ringkasan Absensi</span>
            </a>
        </li>

        <li class="nav-item {{ request()->is('clock-attendance*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('clock-attendance.show') }}">
                <i class="fas fa-clock"></i>
                <span>Clock In/Out</span>
            </a>
        </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
