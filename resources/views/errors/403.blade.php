@extends('admin.errors.layouts.error')

@section('title', '403 - Forbidden')

@section('error-content')
<div class="py-4">
    <div class="mb-4">
        <i class="ti ti-ban text-danger" style="font-size: 4rem"></i>
    </div>
    <h1 class="display-3 fw-bold text-dark mb-3">403</h1>
    <h4 class="fw-semibold mb-3">Forbidden</h4>
    <p class="text-muted mb-4">
        You don't have permission to access this resource. Contact an administrator if you need access.
    </p>
    <a href="{{ url('/') }}" class="btn btn-primary px-4">
        <i class="ti ti-home me-1"></i> Back to Home
    </a>
</div>
@endsection
