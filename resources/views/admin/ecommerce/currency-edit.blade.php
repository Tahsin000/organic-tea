@extends('admin.layouts.app')

@section('title', 'Edit Currency | Aroma Blend Admin')

@section('content')
<div class="container-fluid">
    <div class="page-title-head d-flex align-items-center mb-3">
        <div class="flex-grow-1">
            <h4 class="page-main-title m-0">Edit Currency</h4>
        </div>
        <div>
            <a href="{{ route('admin.ecommerce.currencies') }}" class="btn btn-secondary">
                <i class="ti ti-arrow-left me-1"></i> Back
            </a>
        </div>
    </div>

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <ul class="mb-0">
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.ecommerce.currency-update', $currency) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="code" class="form-label">Currency Code <span class="text-danger">*</span></label>
                        <input type="text" name="code" id="code" class="form-control @error('code') is-invalid @enderror" value="{{ old('code', $currency->code) }}" placeholder="BDT" maxlength="10" required />
                        <small class="text-muted">ISO 4217 code (e.g., BDT, USD, EUR)</small>
                        @error('code')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="symbol" class="form-label">Symbol</label>
                        <input type="text" name="symbol" id="symbol" class="form-control @error('symbol') is-invalid @enderror" value="{{ old('symbol', $currency->symbol) }}" placeholder="৳" maxlength="5" />
                        @error('symbol')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Status</label>
                        <div class="d-flex gap-3 mt-1">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="statusActive" value="1" {{ old('status', $currency->status ? '1' : '0') == '1' ? 'checked' : '' }}>
                                <label class="form-check-label" for="statusActive">
                                    <span class="badge bg-success">Active</span>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="statusInactive" value="0" {{ old('status', $currency->status ? '1' : '0') == '0' ? 'checked' : '' }}>
                                <label class="form-check-label" for="statusInactive">
                                    <span class="badge bg-danger">Inactive</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Currency Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $currency->name) }}" placeholder="Bangladeshi Taka" required />
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-check me-1"></i> Update Currency
                    </button>
                    <a href="{{ route('admin.ecommerce.currencies') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
