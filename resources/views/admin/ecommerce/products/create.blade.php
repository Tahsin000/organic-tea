@extends('admin.layouts.app')

@section('title', 'Add Product | Organic Tea Admin')

@section('content')
<div class="container-fluid">
    <div class="page-title-head d-flex align-items-center mb-3">
        <div class="flex-grow-1">
            <h4 class="page-main-title m-0">Add Product</h4>
        </div>
        <div>
            <a href="{{ route('admin.ecommerce.products.index') }}" class="btn btn-secondary">
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

    <form action="{{ route('admin.ecommerce.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <!-- Main Info -->
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header border-light">
                        <h5 class="card-title m-0">Basic Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Product Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name') }}" required />
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug <small class="text-muted">(auto-generated if empty)</small></label>
                            <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror"
                                   value="{{ old('slug') }}" placeholder="e.g. green-tea" />
                            @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="desc" class="form-label">Description</label>
                            <textarea name="desc" id="desc" rows="4" class="form-control @error('desc') is-invalid @enderror">{{ old('desc') }}</textarea>
                            @error('desc')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <!-- Images -->
                <div class="card mb-4">
                    <div class="card-header border-light">
                        <h5 class="card-title m-0">Product Images</h5>
                        <small class="text-muted">First image will be set as primary. JPEG/PNG/WEBP - max 2MB each.
                        If no image is uploaded, the default product image will be used.</small>
                    </div>
                    <div class="card-body">
                        <input type="file" name="images[]" id="images" class="form-control @error('images.*') is-invalid @enderror"
                               accept="image/*" multiple />
                        @error('images.*')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        <div id="image-preview-container" class="d-flex flex-wrap gap-2 mt-3"></div>
                    </div>
                </div>

                <!-- Tags -->
                <div class="card mb-4">
                    <div class="card-header border-light d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0">Product Tags / Labels</h5>
                        <button type="button" class="btn btn-soft-primary btn-sm" id="add-tag-btn">
                            <i class="ti ti-plus me-1"></i> Add Tag
                        </button>
                    </div>
                    <div class="card-body">
                        <div id="tags-container">
                            <!-- Tags will be added dynamically -->
                        </div>
                        <p class="text-muted small" id="no-tags-msg">No tags added. Tags appear as badges on the product detail page.</p>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-header border-light">
                        <h5 class="card-title m-0">Pricing & Stock</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="price" class="form-label">Sale Price (৳) <span class="text-danger">*</span></label>
                            <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror"
                                   value="{{ old('price') }}" min="0" step="0.01" required />
                            @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="original_price" class="form-label">Original Price (৳) <span class="text-danger">*</span></label>
                            <input type="number" name="original_price" id="original_price" class="form-control @error('original_price') is-invalid @enderror"
                                   value="{{ old('original_price') }}" min="0" step="0.01" required />
                            @error('original_price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="stock" class="form-label">Stock Quantity <span class="text-danger">*</span></label>
                            <input type="number" name="stock" id="stock" class="form-control @error('stock') is-invalid @enderror"
                                   value="{{ old('stock', 0) }}" min="0" required />
                            @error('stock')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="review_count" class="form-label">Review Count <small class="text-muted">(displayed total)</small></label>
                            <input type="number" name="review_count" id="review_count" class="form-control"
                                   value="{{ old('review_count', 0) }}" min="0" />
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header border-light">
                        <h5 class="card-title m-0">Display Options</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="badge" class="form-label">Badge Label</label>
                            <input type="text" name="badge" id="badge" class="form-control" value="{{ old('badge') }}"
                                   placeholder="e.g. Best Seller, New, Limited" />
                        </div>
                        <div class="mb-3">
                            <label for="discount_label" class="form-label">Discount Label</label>
                            <input type="text" name="discount_label" id="discount_label" class="form-control"
                                   value="{{ old('discount_label') }}" placeholder="e.g. Extra 20% off on first order" />
                        </div>
                        <div class="mb-3">
                            <label for="sort_order" class="form-label">Sort Order</label>
                            <input type="number" name="sort_order" id="sort_order" class="form-control"
                                   value="{{ old('sort_order', 0) }}" min="0" />
                        </div>
                        <div>
                            <label class="form-label">Status</label>
                            <div class="d-flex gap-3 mt-1">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="is_active" id="activeYes" value="1"
                                           {{ old('is_active', '1') == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="activeYes">
                                        <span class="badge bg-success">Active</span>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="is_active" id="activeNo" value="0"
                                           {{ old('is_active') == '0' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="activeNo">
                                        <span class="badge bg-danger">Inactive</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-check me-1"></i> Save Product
                    </button>
                    <a href="{{ route('admin.ecommerce.products.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
// Image preview
document.getElementById('images').addEventListener('change', function() {
    const container = document.getElementById('image-preview-container');
    container.innerHTML = '';
    Array.from(this.files).forEach((file, i) => {
        const reader = new FileReader();
        reader.onload = function(e) {
            const div = document.createElement('div');
            div.className = 'position-relative';
            div.innerHTML = `<img src="${e.target.result}" class="rounded border" style="width:80px;height:80px;object-fit:cover;" />
                ${i === 0 ? '<span class="badge bg-success position-absolute top-0 start-0" style="font-size:9px;">Primary</span>' : ''}`;
            container.appendChild(div);
        };
        reader.readAsDataURL(file);
    });
});

// Dynamic tags
let tagCount = 0;
const noTagsMsg = document.getElementById('no-tags-msg');

document.getElementById('add-tag-btn').addEventListener('click', function() {
    noTagsMsg.style.display = 'none';
    const container = document.getElementById('tags-container');
    const idx = tagCount++;
    const row = document.createElement('div');
    row.className = 'row g-2 mb-2 align-items-center tag-row';
    row.innerHTML = `
        <div class="col">
            <input type="text" name="tags[${idx}][label]" class="form-control form-control-sm" placeholder="Tag label" required />
        </div>
        <div class="col-auto">
            <select name="tags[${idx}][color]" class="form-select form-select-sm">
                <option value="green">Green</option>
                <option value="red">Red</option>
                <option value="amber">Amber</option>
                <option value="blue">Blue</option>
                <option value="purple">Purple</option>
            </select>
        </div>
        <div class="col-auto">
            <button type="button" class="btn btn-soft-danger btn-sm remove-tag-btn">
                <i class="ti ti-x"></i>
            </button>
        </div>
    `;
    row.querySelector('.remove-tag-btn').addEventListener('click', function() {
        row.remove();
        if (!container.querySelector('.tag-row')) noTagsMsg.style.display = '';
    });
    container.appendChild(row);
});
</script>
@endpush
