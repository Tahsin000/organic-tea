<header class="app-topbar">
    <div class="container-fluid topbar-menu">
        <div class="d-flex align-items-center gap-2">
            <!-- Topbar Brand Logo -->
            <div class="logo-topbar">
                <a href="{{ route('admin.dashboard.ecommerce') }}" class="logo-light">
                    <span class="logo-lg">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="logo" />
                    </span>
                    <span class="logo-sm">
                        <img src="{{ asset('assets/images/logo-sm.png') }}" alt="small logo" />
                    </span>
                </a>
                <a href="{{ route('admin.dashboard.ecommerce') }}" class="logo-dark">
                    <span class="logo-lg">
                        <img src="{{ asset('assets/images/logo-black.png') }}" alt="dark logo" />
                    </span>
                    <span class="logo-sm">
                        <img src="{{ asset('assets/images/logo-sm.png') }}" alt="small logo" />
                    </span>
                </a>
            </div>

            <!-- Sidebar Menu Toggle Button -->
            <button class="sidenav-toggle-button btn btn-primary btn-icon">
                <i class="ti ti-menu-4"></i>
            </button>

            <!-- Horizontal Menu Toggle Button -->
            <button class="topnav-toggle-button px-2" data-bs-toggle="collapse" data-bs-target="#topnav-menu">
                <i class="ti ti-menu-4"></i>
            </button>

            <!-- Live Website -->
            <a href="{{ url('/') }}" target="_blank" class="btn btn-sm btn-soft-primary ms-2">
                <i class="ti ti-external-link me-1"></i> Live Website
            </a>
        </div>

        <div class="d-flex align-items-center gap-2">
            <!-- Theme Toggle -->
            <div id="theme-dropdown" class="topbar-item d-none d-sm-flex">
                <div class="dropdown">
                    <button class="topbar-link" data-bs-toggle="dropdown" type="button" aria-haspopup="false"
                        aria-expanded="false">
                        <i class="ti ti-sun topbar-link-icon d-none" id="theme-icon-light"></i>
                        <i class="ti ti-moon topbar-link-icon d-none" id="theme-icon-dark"></i>
                        <i class="ti ti-sun-moon topbar-link-icon d-none" id="theme-icon-system"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" data-thememode="dropdown">
                        <label class="dropdown-item cursor-pointer">
                            <input class="form-check-input" type="radio" name="data-bs-theme" value="light"
                                style="display: none" />
                            <i class="ti ti-sun align-middle me-1 fs-16"></i>
                            <span class="align-middle">Light</span>
                        </label>
                        <label class="dropdown-item cursor-pointer">
                            <input class="form-check-input" type="radio" name="data-bs-theme" value="dark"
                                style="display: none" />
                            <i class="ti ti-moon align-middle me-1 fs-16"></i>
                            <span class="align-middle">Dark</span>
                        </label>
                        <label class="dropdown-item cursor-pointer">
                            <input class="form-check-input" type="radio" name="data-bs-theme" value="system"
                                style="display: none" />
                            <i class="ti ti-sun-moon align-middle me-1 fs-16"></i>
                            <span class="align-middle">System</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Fullscreen Toggle -->
            <div id="fullscreen-toggler" class="topbar-item d-none d-md-flex">
                <button class="topbar-link" type="button" data-toggle="fullscreen">
                    <i class="ti ti-maximize topbar-link-icon"></i>
                    <i class="ti ti-minimize topbar-link-icon d-none"></i>
                </button>
            </div>

            <!-- User Dropdown -->
            <div id="user-dropdown-detailed" class="topbar-item nav-user">
                <div class="dropdown">
                    <a class="topbar-link dropdown-toggle drop-arrow-none px-2" data-bs-toggle="dropdown"
                        href="#!" aria-haspopup="false" aria-expanded="false">
                        <img src="{{ asset('assets/images/users/user-1.jpg') }}" width="32"
                            class="rounded-circle me-lg-2 d-flex" alt="user-image" />
                        <div class="d-lg-flex align-items-center gap-1 d-none">
                            <span>
                                <h5 class="my-0 lh-1 pro-username">{{ auth()->user()->name ?? 'Admin' }}</h5>
                                <span class="fs-xs lh-1">Admin</span>
                            </span>
                            <i class="ti ti-chevron-down align-middle"></i>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- Header -->
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Welcome back 👋!</h6>
                        </div>

                        <!-- Divider -->
                        <div class="dropdown-divider"></div>

                        <!-- Logout (POST form) -->
                        <form method="POST" action="{{ route('admin.auth.logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item fw-semibold text-danger border-0 bg-transparent">
                                <i class="ti ti-logout me-1 fs-lg align-middle"></i>
                                <span class="align-middle">Log Out</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
