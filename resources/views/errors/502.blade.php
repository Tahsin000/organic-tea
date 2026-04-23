@extends('admin.errors.layouts.error')

@section('title', '502 - Bad Gateway')

@section('error-content')
<div class="py-4">
    <div class="mb-4">
        <i class="ti ti-network text-danger" style="font-size: 4rem"></i>
    </div>
    <h1 class="display-3 fw-bold text-dark mb-3">502</h1>
    <h4 class="fw-semibold mb-3">Bad Gateway</h4>
    <p class="text-muted mb-4">
        The server received an invalid response from an upstream server. Please try again later.
    </p>
    <a href="{{ url('/') }}" class="btn btn-primary px-4">
        <i class="ti ti-refresh me-1"></i> Try Again
    </a>
</div>
@endsection
