@extends('admin.layouts.app')

@section('title', 'Add Delivery Area | Aroma Blend Admin')

@section('content')
<div class="container-fluid">
    <div class="page-title-head d-flex align-items-center mb-3">
        <div class="flex-grow-1">
            <h4 class="page-main-title m-0">Add Delivery Area</h4>
        </div>
        <div>
            <a href="{{ route('admin.ecommerce.delivery-charges.index') }}" class="btn btn-secondary">
                <i class="ti ti-arrow-left me-1"></i> Back
            </a>
        </div>
    </div>

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.ecommerce.delivery-charges.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="area_name" class="form-label">Area Name <span class="text-danger">*</span>
                            <small class="text-muted">(shown to customer)</small>
                        </label>
                        <input type="text" name="area_name" id="area_name" class="form-control @error('area_name') is-invalid @enderror"
                               value="{{ old('area_name') }}" placeholder="e.g. ঢাকা" required />
                        @error('area_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="area_key" class="form-label">Area Key <span class="text-danger">*</span>
                            <small class="text-muted">(unique identifier, a-z, hyphens only)</small>
                        </label>
                        <input type="text" name="area_key" id="area_key" class="form-control @error('area_key') is-invalid @enderror"
                               value="{{ old('area_key') }}" placeholder="e.g. dhaka" required />
                        @error('area_key')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="charge" class="form-label">Delivery Charge (৳) <span class="text-danger">*</span></label>
                        <input type="number" name="charge" id="charge" class="form-control @error('charge') is-invalid @enderror"
                               value="{{ old('charge', 60) }}" min="0" step="0.01" required />
                        @error('charge')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="sort_order" class="form-label">Sort Order</label>
                        <input type="number" name="sort_order" id="sort_order" class="form-control"
                               value="{{ old('sort_order', 0) }}" min="0" />
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Status</label>
                        <div class="d-flex gap-3 mt-1">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_active" value="1"
                                       {{ old('is_active', '1') == '1' ? 'checked' : '' }}>
                                <label class="form-check-label"><span class="badge bg-success">Active</span></label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_active" value="0"
                                       {{ old('is_active') == '0' ? 'checked' : '' }}>
                                <label class="form-check-label"><span class="badge bg-danger">Inactive</span></label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary"><i class="ti ti-check me-1"></i> Save Area</button>
                    <a href="{{ route('admin.ecommerce.delivery-charges.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
