@extends('admin.errors.layouts.error')

@section('title', '500 - Internal Server Error')

@section('error-content')
<div class="py-4">
    <div class="mb-4">
        <i class="ti ti-alert-circle text-danger" style="font-size: 4rem"></i>
    </div>
    <h1 class="display-3 fw-bold text-dark mb-3">500</h1>
    <h4 class="fw-semibold mb-3">Internal Server Error</h4>
    <p class="text-muted mb-4">
        Something went wrong on our end. Our team has been notified. Please try again later.
    </p>
    <a href="{{ url('/') }}" class="btn btn-primary px-4">
        <i class="ti ti-home me-1"></i> Back to Home
    </a>
</div>
@endsection
