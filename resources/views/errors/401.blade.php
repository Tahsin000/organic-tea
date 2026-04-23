@extends('admin.errors.layouts.error')

@section('title', '401 - Unauthorized')

@section('error-content')
<div class="py-4">
    <div class="mb-4">
        <i class="ti ti-shield-lock text-warning" style="font-size: 4rem"></i>
    </div>
    <h1 class="display-3 fw-bold text-dark mb-3">401</h1>
    <h4 class="fw-semibold mb-3">Unauthorized</h4>
    <p class="text-muted mb-4">
        Access denied. Valid authentication credentials are missing or incorrect. Please log in.
    </p>
    <a href="{{ route('admin.auth.sign-in') }}" class="btn btn-primary px-4">
        <i class="ti ti-login me-1"></i> Sign In
    </a>
</div>
@endsection
