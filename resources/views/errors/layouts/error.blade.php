<!DOCTYPE html>
<html lang="en" data-skin="default" data-bs-theme="light">

<head>
    <meta charset="utf-8" />
    <title>@yield('title', 'Error')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />

    <!-- Theme Config Js -->
    <script src="{{ asset('assets/js/config.js') }}"></script>

    <!-- Vendor css -->
    <link href="{{ asset('assets/css/vendors.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link id="app-style" href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>

    <div class="position-absolute top-0 end-0">
        <img src="{{ asset('assets/images/auth-card-bg.svg') }}" class="auth-card-bg-img" alt="bg">
    </div>
    <div class="position-absolute bottom-0 start-0" style="transform: rotate(180deg)">
        <img src="{{ asset('assets/images/auth-card-bg.svg') }}" class="auth-card-bg-img" alt="bg">
    </div>

    <div class="auth-box overflow-hidden align-items-center d-flex" style="padding: 1rem">
        <div class="container" style="padding: 0">
            <div class="row justify-content-center">
                <div class="col-11 col-sm-10 col-md-8 col-lg-6 col-xl-5">
                    <div class="card p-3 p-sm-4">
                        <div class="text-center">
                            @yield('error-content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Vendor js -->
    <script src="{{ asset('assets/js/vendors.min.js') }}"></script>
    <!-- App js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>

</body>

</html>
