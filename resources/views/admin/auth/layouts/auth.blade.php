<!DOCTYPE html>
<html lang="en" data-skin="default" data-bs-theme="light">

<head>
    <meta charset="utf-8" />
    <title>@yield('title', 'Admin')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="Organic Tea" />

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

    @yield('content')

    <!-- Vendor js -->
    <script src="{{ asset('assets/js/vendors.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>

</body>

</html>