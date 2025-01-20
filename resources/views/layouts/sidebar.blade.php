<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('build/images/logo-sm.png') }}" alt="" height="40">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('build/images/logo-dark.png') }}" alt="" height="60">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('build/images/logo-sm.png') }}" alt="" height="40">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('build/images/logo-light.png') }}" alt="" height="60">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span>@lang('translation.menu')</span></li>
                @if(Auth::user()->hasRole('customer'))
                <li class="nav-item">
                    <a class="nav-link menu-link" href="/">
                        <i class="ri-dashboard-2-line"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('delivery') }}">
                        <i class="ri-truck-line"></i> <span>Pengiriman</span>
                    </a>
                </li>
                @endif
                @if(Auth::user()->hasRole('administrator'))
                <li class="nav-item">
                    <a class="nav-link menu-link" href="/">
                        <i class="ri-dashboard-2-line"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('pressure') }}">
                        <i class="ri-bar-chart-line"></i> <span>Tekanan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('delivery') }}">
                        <i class="ri-truck-line"></i> <span>Pengiriman</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('map') }}">
                        <i class="ri-map-line"></i> <span>Peta</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('customer.index') }}">
                        <i class="ri-customer-service-line"></i> <span>Pelanggan</span>
                    </a>
                </li>
            @endif

            <!-- Technician Role -->
            @if(Auth::user()->hasRole('technician'))
            <li class="nav-item">
                <a class="nav-link menu-link" href="/">
                    <i class="ri-dashboard-2-line"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link menu-link" href="pressure">
                    <i class="ri-bar-chart-line"></i> <span>Tekanan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link menu-link" href="temperature">
                    <i class="ri-thermometer-line"></i> <span>Suhu</span>
                </a>
            </li>
            @endif
                

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
