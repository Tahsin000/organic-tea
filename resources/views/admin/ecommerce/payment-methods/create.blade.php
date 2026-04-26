@extends('admin.layouts.app')

@section('title', 'Add Payment Method | Organic Tea Admin')

@section('content')
<div class="container-fluid">
    <div class="page-title-head d-flex align-items-center mb-3">
        <div class="flex-grow-1">
            <h4 class="page-main-title m-0">Add Payment Method</h4>
        </div>
        <div>
            <a href="{{ route('admin.ecommerce.payment-methods.index') }}" class="btn btn-secondary">
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
            <form action="{{ route('admin.ecommerce.payment-methods.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Method Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name') }}" placeholder="e.g. ক্যাশ অন ডেলিভারি" required />
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="key" class="form-label">Method Key <span class="text-danger">*</span>
                            <small class="text-muted">(unique, a-z, hyphens)</small>
                        </label>
                        <input type="text" name="key" id="key" class="form-control @error('key') is-invalid @enderror"
                               value="{{ old('key') }}" placeholder="e.g. cod, bkash, nagad" required />
                        @error('key')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12 mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" rows="2" class="form-control"
                                  placeholder="Short description shown to the customer">{{ old('description') }}</textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Requires Transaction ID?</label>
                        <div class="d-flex gap-3 mt-1">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="requires_transaction" value="1"
                                       {{ old('requires_transaction') == '1' ? 'checked' : '' }}>
                                <label class="form-check-label">
                                    <span class="badge badge-soft-warning">Yes</span> (bKash / Nagad)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="requires_transaction" value="0"
                                       {{ old('requires_transaction', '0') == '0' ? 'checked' : '' }}>
                                <label class="form-check-label">
                                    <span class="badge badge-soft-secondary">No</span> (Cash on Delivery)
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="payment_number" class="form-label">Payment Number
                            <small class="text-muted">(where customer sends money)</small>
                        </label>
                        <input type="text" name="payment_number" id="payment_number" class="form-control"
                               value="{{ old('payment_number') }}" placeholder="e.g. 01700000000" />
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="icon" class="form-label">Icon Name
                            <small class="text-muted">(e.g. banknotes, device-mobile)</small>
                        </label>
                        <input type="text" name="icon" id="icon" class="form-control"
                               value="{{ old('icon') }}" placeholder="banknotes" />
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
                    <button type="submit" class="btn btn-primary"><i class="ti ti-check me-1"></i> Save Method</button>
                    <a href="{{ route('admin.ecommerce.payment-methods.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
