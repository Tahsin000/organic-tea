@extends('admin.layouts.app')

@section('title', 'Edit Review | Organic Tea Admin')

@section('content')
<div class="container-fluid">
    <div class="page-title-head d-flex align-items-center mb-3">
        <div class="flex-grow-1">
            <h4 class="page-main-title m-0">Edit Review</h4>
        </div>
        <div>
            <a href="{{ route('admin.ecommerce.reviews') }}" class="btn btn-secondary">
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
            <form action="{{ route('admin.ecommerce.review-update', $review) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="product_id" class="form-label">Linked Product <span class="text-muted fw-normal">(optional)</span></label>
                    <select name="product_id" id="product_id" class="form-select @error('product_id') is-invalid @enderror">
                        <option value="">— General review (not product-specific) —</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" {{ old('product_id', $review->product_id) == $product->id ? 'selected' : '' }}>
                                {{ $product->name }}
                            </option>
                        @endforeach
                    </select>
                    <small class="text-muted">Linked reviews appear on the product detail page.</small>
                    @error('product_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Reviewer Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $review->name) }}" required />
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="location" class="form-label">Location</label>
                    <input type="text" name="location" id="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location', $review->location) }}" />
                    @error('location')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="text" class="form-label">Review Text <span class="text-danger">*</span></label>
                    <textarea name="text" id="text" rows="4" class="form-control @error('text') is-invalid @enderror" required>{{ old('text', $review->text) }}</textarea>
                    @error('text')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Reviewer Image (optional)</label>
                    @if($review->image)
                        <div class="mb-2">
                            <img src="{{ $review->image_url }}" alt="Current image" class="rounded" style="max-height:100px;" />
                            <p class="text-muted small mb-0">Current image</p>
                        </div>
                    @endif
                    <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*" />
                    <small class="text-muted">Upload new image to replace. JPEG, PNG, JPG, WEBP - max 200KB</small>
                    <div id="image-preview" class="mt-2"></div>
                    @error('image')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="stars" class="form-label">Star Rating <span class="text-danger">*</span></label>
                        <select name="stars" id="stars" class="form-select @error('stars') is-invalid @enderror" required>
                            @for($i = 5; $i >= 1; $i--)
                                <option value="{{ $i }}" {{ old('stars', $review->stars) == $i ? 'selected' : '' }}>{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                            @endfor
                        </select>
                        @error('stars')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status</label>
                        <div class="d-flex gap-3 mt-1">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="statusActive" value="1" {{ old('status', $review->status ? '1' : '0') == '1' ? 'checked' : '' }}>
                                <label class="form-check-label" for="statusActive">
                                    <span class="badge bg-success">Active</span> - visible on landing page
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="statusInactive" value="0" {{ old('status', $review->status ? '1' : '0') == '0' ? 'checked' : '' }}>
                                <label class="form-check-label" for="statusInactive">
                                    <span class="badge bg-danger">Inactive</span> - hidden
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-check me-1"></i> Update Review
                    </button>
                    <a href="{{ route('admin.ecommerce.reviews') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
(function(){
    const input = document.getElementById('image');
    if (!input) return;
    const preview = document.getElementById('image-preview');
    input.addEventListener('change', function(){
        const file = this.files[0];
        if (!file) { preview.innerHTML = ''; return; }
        if (file.size > 200 * 1024) {
            preview.innerHTML = '<span class="text-danger fs-sm">File exceeds 200KB limit.</span>';
            this.value = '';
            return;
        }
        const reader = new FileReader();
        reader.onload = function(e){
            preview.innerHTML = '<img src="'+e.target.result+'" alt="Preview" class="rounded mt-2" style="max-height:120px;" />';
        };
        reader.readAsDataURL(file);
    });
})();
</script>
@endpush
