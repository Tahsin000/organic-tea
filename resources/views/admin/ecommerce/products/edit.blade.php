@extends('admin.layouts.app')

@section('title', 'Edit Product | Organic Tea Admin')

@section('content')
<div class="container-fluid">
    <div class="page-title-head d-flex align-items-center mb-3">
        <div class="flex-grow-1">
            <h4 class="page-main-title m-0">Edit Product: {{ $product->name }}</h4>
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

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form action="{{ route('admin.ecommerce.products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header border-light">
                        <h5 class="card-title m-0">Basic Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Product Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $product->name) }}" required />
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" name="slug" id="slug" class="form-control"
                                   value="{{ old('slug', $product->slug) }}" />
                        </div>
                        <div class="mb-3">
                            <label for="desc" class="form-label">Description</label>
                            <textarea name="desc" id="desc" rows="4" class="form-control">{{ old('desc', $product->desc) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Current Images -->
                <div class="card mb-4">
                    <div class="card-header border-light">
                        <h5 class="card-title m-0">Product Images</h5>
                    </div>
                    <div class="card-body">
                        @if($product->images->isNotEmpty())
                            <p class="text-muted small mb-2">Existing images. Click <strong>Set Primary</strong> to make one the thumbnail. Click <strong>Delete</strong> to remove immediately.</p>
                            <div class="d-flex flex-wrap gap-3 mb-4" id="existing-images">
                                @foreach($product->images as $img)
                                <div class="card border text-center position-relative" style="width:130px;" id="img-card-{{ $img->id }}">
                                    <img src="{{ $img->url }}" class="card-img-top" style="height:90px;object-fit:cover;" />
                                    <div class="card-body p-1 d-flex flex-column gap-1">
                                        @if(!$img->is_primary)
                                        <form method="POST" action="{{ route('admin.ecommerce.products.update', $product) }}" class="m-0">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="name" value="{{ $product->name }}">
                                            <input type="hidden" name="price" value="{{ $product->price }}">
                                            <input type="hidden" name="original_price" value="{{ $product->original_price }}">
                                            <input type="hidden" name="stock" value="{{ $product->stock }}">
                                            <input type="hidden" name="primary_image" value="{{ $img->id }}">
                                            <button type="submit" class="btn btn-soft-primary btn-xs w-100" style="font-size:11px;">
                                                <i class="ti ti-star me-1"></i>Set Primary
                                            </button>
                                        </form>
                                        @else
                                            <span class="badge bg-success w-100" style="font-size:11px;"><i class="ti ti-star-filled me-1"></i>Primary</span>
                                        @endif

                                        <form method="POST"
                                              action="{{ route('admin.ecommerce.products.image.destroy', [$product, $img]) }}"
                                              class="m-0 delete-image-form">
                                            @csrf @method('DELETE')
                                            <button type="button" class="btn btn-soft-danger btn-xs w-100 delete-img-btn" style="font-size:11px;"
                                                    data-img-id="{{ $img->id }}">
                                                <i class="ti ti-trash me-1"></i>Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-muted small" id="no-images-msg">No images uploaded. The default product image will be shown.</p>
                        @endif

                        <label class="form-label">Upload New Images <small class="text-muted">(select multiple)</small></label>
                        <input type="file" name="new_images[]" class="form-control" accept="image/*" multiple />
                        <small class="text-muted">JPEG/PNG/WEBP – max 2MB each. First uploaded image becomes primary if none exist.</small>
                        <div id="new-image-preview" class="d-flex flex-wrap gap-2 mt-2"></div>
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
                            @foreach($product->tags as $i => $tag)
                            <div class="row g-2 mb-2 align-items-center tag-row">
                                <div class="col">
                                    <input type="text" name="tags[{{ $i }}][label]" class="form-control form-control-sm"
                                           value="{{ $tag->label }}" placeholder="Tag label" required />
                                </div>
                                <div class="col-auto">
                                    <select name="tags[{{ $i }}][color]" class="form-select form-select-sm">
                                        @foreach(['green','red','amber','blue','purple'] as $c)
                                            <option value="{{ $c }}" {{ $tag->color === $c ? 'selected' : '' }}>{{ ucfirst($c) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <button type="button" class="btn btn-soft-danger btn-sm remove-tag-btn">
                                        <i class="ti ti-x"></i>
                                    </button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <p class="text-muted small" id="no-tags-msg" {{ $product->tags->isNotEmpty() ? 'style=display:none' : '' }}>No tags added.</p>
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
                            <input type="number" name="price" id="price" class="form-control"
                                   value="{{ old('price', $product->price) }}" min="0" step="0.01" required />
                        </div>
                        <div class="mb-3">
                            <label for="original_price" class="form-label">Original Price (৳) <span class="text-danger">*</span></label>
                            <input type="number" name="original_price" id="original_price" class="form-control"
                                   value="{{ old('original_price', $product->original_price) }}" min="0" step="0.01" required />
                        </div>
                        <div class="mb-3">
                            <label for="stock" class="form-label">Stock Quantity <span class="text-danger">*</span></label>
                            <input type="number" name="stock" id="stock" class="form-control"
                                   value="{{ old('stock', $product->stock) }}" min="0" required />
                        </div>
                        <div class="mb-3">
                            <label for="review_count" class="form-label">Review Count</label>
                            <input type="number" name="review_count" id="review_count" class="form-control"
                                   value="{{ old('review_count', $product->review_count) }}" min="0" />
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
                            <input type="text" name="badge" id="badge" class="form-control"
                                   value="{{ old('badge', $product->badge) }}" />
                        </div>
                        <div class="mb-3">
                            <label for="discount_label" class="form-label">Discount Label</label>
                            <input type="text" name="discount_label" id="discount_label" class="form-control"
                                   value="{{ old('discount_label', $product->discount_label) }}" />
                        </div>
                        <div class="mb-3">
                            <label for="sort_order" class="form-label">Sort Order</label>
                            <input type="number" name="sort_order" id="sort_order" class="form-control"
                                   value="{{ old('sort_order', $product->sort_order) }}" min="0" />
                        </div>
                        <div>
                            <label class="form-label">Status</label>
                            <div class="d-flex gap-3 mt-1">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="is_active" id="activeYes" value="1"
                                           {{ old('is_active', $product->is_active ? '1' : '0') == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="activeYes"><span class="badge bg-success">Active</span></label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="is_active" id="activeNo" value="0"
                                           {{ old('is_active', $product->is_active ? '1' : '0') == '0' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="activeNo"><span class="badge bg-danger">Inactive</span></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-check me-1"></i> Update Product
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
// Per-image delete with confirmation
document.querySelectorAll('.delete-img-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
        if (!confirm('Delete this image? This cannot be undone.')) return;
        this.closest('.delete-image-form').submit();
    });
});

// New image preview
document.querySelector('input[name="new_images[]"]').addEventListener('change', function() {
    const container = document.getElementById('new-image-preview');
    container.innerHTML = '';
    Array.from(this.files).forEach(file => {
        const reader = new FileReader();
        reader.onload = e => {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.className = 'rounded border';
            img.style.cssText = 'width:70px;height:70px;object-fit:cover;';
            container.appendChild(img);
        };
        reader.readAsDataURL(file);
    });
});

// Dynamic tags
let tagCount = {{ $product->tags->count() }};
const noTagsMsg = document.getElementById('no-tags-msg');

document.querySelectorAll('.remove-tag-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        this.closest('.tag-row').remove();
        if (!document.querySelector('.tag-row')) noTagsMsg.style.display = '';
    });
});

document.getElementById('add-tag-btn').addEventListener('click', function() {
    noTagsMsg.style.display = 'none';
    const container = document.getElementById('tags-container');
    const idx = tagCount++;
    const row = document.createElement('div');
    row.className = 'row g-2 mb-2 align-items-center tag-row';
    row.innerHTML = `
        <div class="col"><input type="text" name="tags[${idx}][label]" class="form-control form-control-sm" placeholder="Tag label" required /></div>
        <div class="col-auto">
            <select name="tags[${idx}][color]" class="form-select form-select-sm">
                <option value="green">Green</option><option value="red">Red</option>
                <option value="amber">Amber</option><option value="blue">Blue</option>
                <option value="purple">Purple</option>
            </select>
        </div>
        <div class="col-auto"><button type="button" class="btn btn-soft-danger btn-sm remove-tag-btn"><i class="ti ti-x"></i></button></div>
    `;
    row.querySelector('.remove-tag-btn').addEventListener('click', function() {
        row.remove();
        if (!document.querySelector('.tag-row')) noTagsMsg.style.display = '';
    });
    container.appendChild(row);
});
</script>
@endpush
