<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/dashboard') }}">

        <div class="sidebar-brand-text mx-3">
            {{-- <img src="{{asset('Tempo/assets/img/icon.png')}}" alt="" class="img-fluid"> --}}
            <p>Parkir-App</p>
        </div>
    </a>

    <!-- Divider -->
    {{-- <hr class="sidebar-divider my-0"> --}}
    <!-- Nav Item - Dashboard -->
    <hr class="sidebar-divider">
    @if (Auth::user()->level == 'master')
    <li class="nav-item">
        <div class="sidebar-heading">
            Master Data
        </div>
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-folder"></i>
            <span>Master Data</span>
        </a>
        <div id="collapseTwo" class="collapse @yield('content-menu')" aria-labelledby="headingTwo"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Content</h6>
                <a class="collapse-item @yield('content-kategori-items')" href="{{ url('admin/kategori_items') }}">Kategori Bus</a>
            </div>
        </div>
    </li>         
    @else
        {{-- <li class="nav-item">
                <a href="{{url('/dashboard')}}" class="nav-link @yield('menu-dashboard')">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a> 
            </li> --}}
    @endif

    <!-- Divider -->
    {{-- <hr class="sidebar-divider"> --}}
    @if (Auth::user()->level == 'adminkadilangu' || Auth::user()->level == 'admintembiring')
        <!-- Heading -->
        <div class="sidebar-heading">
            Parkir-App
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link @yield('parkir-in')" href="{{ url('admin/parkir_in/create') }}">
                <i class="fas fa-car-side"></i>
                <span>Parkir Masuk</span></a>
        </li>
        
        @endif
    <hr class="sidebar-divider">
        <div class="sidebar-heading">
            Report
        </div>
        <li class="nav-item">
            <a class="nav-link @yield('laporan')" href="{{ url('admin/laporan') }}">
                <i class="fas fa-file-alt"></i>
                <span>Laporan</span></a>
        </li>
    @if (Auth::user()->level == 'master')
        <!-- Divider -->
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            Management Users
        </div>
        <li class="nav-item">
            <a class="nav-link @yield('management-users')" href="{{ url('admin/users_management') }}">
                <i class="fas fa-fw fa-users"></i>
                <span>Management Users</span></a>
        </li>
    @endif
     <!-- Divider -->
     <hr class="sidebar-divider my-0">
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline pt-4">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
