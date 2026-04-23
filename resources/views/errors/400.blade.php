@extends('admin.errors.layouts.error')

@section('title', '400 - Bad Request')

@section('error-content')
<div class="py-4">
    <div class="mb-4">
        <i class="ti ti-circle-x text-danger" style="font-size: 4rem"></i>
    </div>
    <h1 class="display-3 fw-bold text-dark mb-3">400</h1>
    <h4 class="fw-semibold mb-3">Bad Request</h4>
    <p class="text-muted mb-4">
        The server cannot understand the request due to malformed syntax. Check the URL or clear your cookies.
    </p>
    <a href="{{ url('/') }}" class="btn btn-primary px-4">
        <i class="ti ti-home me-1"></i> Back to Home
    </a>
</div>
@endsection
