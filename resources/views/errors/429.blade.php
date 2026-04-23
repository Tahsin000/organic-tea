@extends('admin.errors.layouts.error')

@section('title', '429 - Too Many Requests')

@section('error-content')
<div class="py-4">
    <div class="mb-4">
        <i class="ti ti-repeat text-warning" style="font-size: 4rem"></i>
    </div>
    <h1 class="display-3 fw-bold text-dark mb-3">429</h1>
    <h4 class="fw-semibold mb-3">Too Many Requests</h4>
    <p class="text-muted mb-4">
        You've sent too many requests in a short time. Please wait a moment and try again.
    </p>
    <a href="{{ url('/') }}" class="btn btn-primary px-4">
        <i class="ti ti-home me-1"></i> Back to Home
    </a>
</div>
@endsection
