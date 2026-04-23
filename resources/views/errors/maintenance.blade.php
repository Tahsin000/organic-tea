@extends('admin.errors.layouts.error')

@section('title', 'Maintenance')

@section('error-content')
<div class="py-4">
    <div class="mb-4">
        <i class="ti ti-tool text-warning" style="font-size: 4rem"></i>
    </div>
    <h1 class="display-3 fw-bold text-dark mb-3">🔧</h1>
    <h4 class="fw-semibold mb-3">Under Maintenance</h4>
    <p class="text-muted mb-4">
        We're currently performing scheduled maintenance. We'll be back shortly. Thank you for your patience.
    </p>
    <a href="{{ url('/') }}" class="btn btn-primary px-4">
        <i class="ti ti-home me-1"></i> Back to Home
    </a>
</div>
@endsection
