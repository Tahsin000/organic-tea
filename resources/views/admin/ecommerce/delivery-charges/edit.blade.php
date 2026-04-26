@extends('admin.layouts.app')

@section('title', 'Edit Delivery Area | Organic Tea Admin')

@section('content')
<div class="container-fluid">
    <div class="page-title-head d-flex align-items-center mb-3">
        <div class="flex-grow-1">
            <h4 class="page-main-title m-0">Edit Delivery Area: {{ $deliveryCharge->area_name }}</h4>
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
            <form action="{{ route('admin.ecommerce.delivery-charges.update', $deliveryCharge) }}" method="POST">
                @csrf @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="area_name" class="form-label">Area Name <span class="text-danger">*</span></label>
                        <input type="text" name="area_name" id="area_name" class="form-control @error('area_name') is-invalid @enderror"
                               value="{{ old('area_name', $deliveryCharge->area_name) }}" required />
                        @error('area_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="area_key" class="form-label">Area Key <span class="text-danger">*</span></label>
                        <input type="text" name="area_key" id="area_key" class="form-control @error('area_key') is-invalid @enderror"
                               value="{{ old('area_key', $deliveryCharge->area_key) }}" required />
                        @error('area_key')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="charge" class="form-label">Delivery Charge (৳) <span class="text-danger">*</span></label>
                        <input type="number" name="charge" id="charge" class="form-control"
                               value="{{ old('charge', $deliveryCharge->charge) }}" min="0" step="0.01" required />
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="sort_order" class="form-label">Sort Order</label>
                        <input type="number" name="sort_order" id="sort_order" class="form-control"
                               value="{{ old('sort_order', $deliveryCharge->sort_order) }}" min="0" />
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Status</label>
                        <div class="d-flex gap-3 mt-1">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_active" value="1"
                                       {{ old('is_active', $deliveryCharge->is_active ? '1' : '0') == '1' ? 'checked' : '' }}>
                                <label class="form-check-label"><span class="badge bg-success">Active</span></label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_active" value="0"
                                       {{ old('is_active', $deliveryCharge->is_active ? '1' : '0') == '0' ? 'checked' : '' }}>
                                <label class="form-check-label"><span class="badge bg-danger">Inactive</span></label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary"><i class="ti ti-check me-1"></i> Update Area</button>
                    <a href="{{ route('admin.ecommerce.delivery-charges.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
