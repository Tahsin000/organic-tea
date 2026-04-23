@extends('admin.errors.layouts.error')

@section('title', '408 - Request Timeout')

@section('error-content')
<div class="py-4">
    <div class="mb-4">
        <i class="ti ti-clock-hour-9 text-warning" style="font-size: 4rem"></i>
    </div>
    <h1 class="display-3 fw-bold text-dark mb-3">408</h1>
    <h4 class="fw-semibold mb-3">Request Timeout</h4>
    <p class="text-muted mb-4">
        The server timed out waiting for your request. Please try again.
    </p>
    <a href="{{ url('/') }}" class="btn btn-primary px-4">
        <i class="ti ti-refresh me-1"></i> Try Again
    </a>
</div>
@endsection
