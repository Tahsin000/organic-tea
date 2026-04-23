<!-- Sidebar -->
<div class="sidenav-menu">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard.ecommerce') }}" class="logo">
        <span class="logo logo-light">
            <span class="logo-lg"><img src="{{ asset('assets/images/logo.png') }}" alt="logo" /></span>
            <span class="logo-sm"><img src="{{ asset('assets/images/logo-sm.png') }}" alt="small logo" /></span>
        </span>
        <span class="logo logo-dark">
            <span class="logo-lg"><img src="{{ asset('assets/images/logo-black.png') }}" alt="dark logo" /></span>
            <span class="logo-sm"><img src="{{ asset('assets/images/logo-sm.png') }}" alt="small logo" /></span>
        </span>
    </a>

    <!-- Sidebar Hover Menu Toggle Button -->
    <button class="button-on-hover">
        <span class="btn-on-hover-icon"></span>
    </button>

    <!-- Full Sidebar Menu Close Button -->
    <button class="button-close-offcanvas">
        <i class="ti ti-menu-4 align-middle"></i>
    </button>

    <div class="scrollbar" data-simplebar="">
        <!-- User Profile -->
        <div id="user-profile-settings" class="sidenav-user" style="background: url(assets/images/user-bg-pattern.svg)">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <a href="#!" class="link-reset">
                        <img src="{{ asset('assets/images/users/user-1.jpg') }}" alt="user-image"
                            class="rounded-circle mb-2 avatar-md" />
                        <span class="sidenav-user-name fw-bold">{{ auth()->user()->name ?? 'Admin' }}</span>
                        <span class="fs-12 fw-semibold">Admin</span>
                    </a>
                </div>
                <div>
                    <a class="dropdown-toggle drop-arrow-none link-reset sidenav-user-set-icon"
                        data-bs-toggle="dropdown" data-bs-offset="0,12" href="#!" aria-haspopup="false"
                        aria-expanded="false">
                        <i class="ti ti-settings fs-24 align-middle ms-1"></i>
                    </a>
                    <div class="dropdown-menu">
                        <!-- Settings -->
                        <a href="{{ route('admin.dashboard.ecommerce') }}" class="dropdown-item">
                            <i class="ti ti-settings-2 me-1 fs-lg align-middle"></i>
                            <span class="align-middle">Account Settings</span>
                        </a>
                        <!-- Divider -->
                        <div class="dropdown-divider"></div>
                        <!-- Logout (POST form) -->
                        <form method="POST" action="{{ route('admin.auth.logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger fw-semibold border-0 bg-transparent">
                                <i class="ti ti-logout me-1 fs-lg align-middle"></i>
                                <span class="align-middle">Log Out</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!--- Sidenav Menu -->
        <div id="sidenav-menu">
            <ul class="side-nav">
                <li class="side-nav-title mt-2">Main</li>

                <!-- Dashboard -->
                <li class="side-nav-item">
                    <a href="{{ route('admin.dashboard.ecommerce') }}" class="side-nav-link {{ request()->routeIs('admin.dashboard.*') ? 'active' : '' }}">
                        <span class="menu-icon"><i class="ti ti-dashboard"></i></span>
                        <span class="menu-text">Dashboard</span>
                    </a>
                </li>

                <!-- Orders -->
                <li class="side-nav-item">
                    <a href="{{ route('admin.ecommerce.orders') }}" class="side-nav-link {{ request()->routeIs('admin.ecommerce.orders') ? 'active' : '' }}">
                        <span class="menu-icon"><i class="ti ti-shopping-cart"></i></span>
                        <span class="menu-text">Order Table</span>
                    </a>
                </li>

                <!-- Products -->
                <li class="side-nav-item">
                    <a href="{{ route('admin.ecommerce.products') }}" class="side-nav-link {{ request()->routeIs('admin.ecommerce.products') ? 'active' : '' }}">
                        <span class="menu-icon"><i class="ti ti-package"></i></span>
                        <span class="menu-text">Product Table</span>
                    </a>
                </li>

                <!-- Settings -->
                <li class="side-nav-item">
                    <a href="{{ route('admin.ecommerce.settings') }}" class="side-nav-link {{ request()->routeIs('admin.ecommerce.settings') ? 'active' : '' }}">
                        <span class="menu-icon"><i class="ti ti-settings"></i></span>
                        <span class="menu-text">Settings</span>
                    </a>
                </li>

                <!-- Live Website -->
                <li class="side-nav-item">
                    <a href="{{ url('/') }}" target="_blank" class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-external-link"></i></span>
                        <span class="menu-text">Live Website</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
