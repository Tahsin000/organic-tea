@extends('admin.auth.layouts.auth')

@section('content')
<div class="position-absolute top-0 end-0">
    <img src="{{ asset('assets/images/auth-card-bg.svg') }}" class="auth-card-bg-img" alt="auth-card-bg">
</div>
<div class="position-absolute bottom-0 start-0" style="transform: rotate(180deg)">
    <img src="{{ asset('assets/images/auth-card-bg.svg') }}" class="auth-card-bg-img" alt="auth-card-bg">
</div>
<div class="auth-box overflow-hidden align-items-center d-flex" style="padding: 1rem">
    <div class="container" style="padding: 0">
        <div class="row justify-content-center">
            <div class="col-11 col-sm-10 col-md-8 col-lg-6 col-xl-5">
                <div class="card p-3 p-sm-4">
                    <div class="auth-brand text-center mb-2">
                        <a href="index.html" class="logo-dark">
                            <img src="{{ asset('assets/images/logo-black.png') }}" alt="dark logo">
                        </a>
                        <a href="index.html" class="logo-light">
                            <img src="{{ asset('assets/images/logo.png') }}" alt="logo">
                        </a>
                        <h4 class="fw-bold text-dark mt-3 fs-5 fs-sm-4">Great to see you here 👋</h4>
                        <p class="text-muted w-lg-75 mx-auto">Let's get you signed in. Enter your email and password to continue.</p>
                    </div>
                   
                   

                    @if ($errors->any())
                        <div class="alert alert-danger mb-3">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.auth.login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="userEmail" class="form-label">
                                Email address
                                <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <input type="email" class="form-control" id="userEmail" name="email" placeholder="you@example.com" required value="{{ old('email') }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="userPassword" class="form-label">
                                Password
                                <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="userPassword" name="password" placeholder="••••••••" required>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="form-check">
                                <input class="form-check-input form-check-input-light fs-14" type="checkbox" name="remember" id="rememberMe">
                                <label class="form-check-label" for="rememberMe">Keep me signed in</label>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary fw-semibold py-2">Sign In</button>
                        </div>
                    </form>

                    <p class="text-muted text-center mt-4 mb-0">
                        ©<script>document.write(new Date().getFullYear())</script> Organic Tea - Admin Panel
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
