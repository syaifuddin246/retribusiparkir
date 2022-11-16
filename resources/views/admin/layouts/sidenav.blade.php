<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('admin/dashboard') }}">

        <div class="sidebar-brand-text mx-3">
            {{-- <img src="{{asset('Tempo/assets/img/icon.png')}}" alt="" class="img-fluid"> --}}
            <p>Parkir-App</p>
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link @yield('menu-dashboard')"
            @if (Auth::user()->level == 'masteradmin' || Auth::user()->level == 'admin') href="{{ url('admin/dashboard') }}"
            @else
            href="{{ url('user/dashboard') }}" 
            @endif>
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">



    @if (Auth::user()->level == 'masteradmin' || Auth::user()->level == 'admin')
        <!-- Heading -->
        <div class="sidebar-heading">
            Content
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-folder"></i>
                <span>Parkir App</span>
            </a>
            <div id="collapseTwo" class="collapse @yield('content-menu')" aria-labelledby="headingTwo"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Content</h6>
                    <a class="collapse-item @yield('content-berita')" href="{{ url('admin/berita') }}">Berita</a>
                </div>
            </div>
        </li>
    
    @endif
    @if (Auth::user()->level == 'masteradmin')
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

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
