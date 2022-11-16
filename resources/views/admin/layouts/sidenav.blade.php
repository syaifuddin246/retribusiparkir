<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/dashboard') }}">

        <div class="sidebar-brand-text mx-3">
            {{-- <img src="{{asset('Tempo/assets/img/icon.png')}}" alt="" class="img-fluid"> --}}
            <p>Parkir-App</p>
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        @if (Auth::user()->level == 'master')
            <a href="{{url('master_data')}}" class="nav-link @yield('menu-masterdata')">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Master Data</span>
            </a>            
        @else
            <a href="{{url('/dashboard')}}" class="nav-link @yield('menu-dashboard')">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a> 
        @endif
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">



    @if (Auth::user()->level == 'master' || Auth::user()->level == 'admin')
        <!-- Heading -->
        <div class="sidebar-heading">
            Parkir-App
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link @yield('parkir-in')" href="{{ url('admin/users_management') }}">
                <i class="fas fa-fw fa-in"></i>
                <span>Parkir Masuk</span></a>
        </li>
    
    @endif
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

        <hr class="sidebar-divider d-none d-md-block">
    @endif
     <!-- Divider -->
     <hr class="sidebar-divider my-0">
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline pt-4">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
