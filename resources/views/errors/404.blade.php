@extends('admin.errors.layouts.error')

@section('title', '404 - Not Found')

@section('error-content')
<div class="py-4">
    <div class="mb-4">
        <i class="ti ti-search text-muted" style="font-size: 4rem"></i>
    </div>
    <h1 class="display-3 fw-bold text-dark mb-3">404</h1>
    <h4 class="fw-semibold mb-3">Page Not Found</h4>
    <p class="text-muted mb-4">
        The page you're looking for doesn't exist. It may have been deleted or the URL might be wrong.
    </p>
    <a href="{{ url('/') }}" class="btn btn-primary px-4">
        <i class="ti ti-home me-1"></i> Back to Home
    </a>
</div>
@endsection
