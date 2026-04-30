@extends('admin.layouts.app')

@section('title', 'Products | Aroma Blend Admin')

@section('content')
<div class="container-fluid">
    <div class="page-title-head d-flex align-items-center mb-3">
        <div class="flex-grow-1">
            <h4 class="page-main-title m-0">Products</h4>
        </div>
        <div>
            <a href="{{ route('admin.ecommerce.products.create') }}" class="btn btn-primary">
                <i class="ti ti-plus me-1"></i> Add Product
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header border-light justify-content-between">
            <div class="d-flex flex-wrap gap-2 align-items-center">
                <form method="GET" action="{{ route('admin.ecommerce.products.index') }}" class="d-flex flex-wrap gap-2 align-items-center">
                    <div class="app-search">
                        <input type="text" name="search" class="form-control" placeholder="Search products..." value="{{ request('search') }}" />
                        <i class="ti ti-search app-search-icon text-muted"></i>
                    </div>
                    <div>
                        <select name="status" class="form-select form-control my-1 my-md-0">
                            <option value="">All Status</option>
                            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-soft-primary btn-sm">
                        <i class="ti ti-filter-2 me-1"></i> Filter
                    </button>
                    @if(request('search') || request('status'))
                        <a href="{{ route('admin.ecommerce.products.index') }}" class="btn btn-soft-danger btn-sm">
                            <i class="ti ti-x me-1"></i> Clear
                        </a>
                    @endif
                </form>
            </div>
            <div class="ms-auto">
                <span class="text-muted fs-sm">{{ $products->total() }} total products</span>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-custom table-centered table-hover w-100 mb-0">
                <thead class="bg-light bg-opacity-25 thead-sm">
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price / Original</th>
                        <th>Stock</th>
                        <th>Badge</th>
                        <th>Status</th>
                        <th class="text-center">Hero</th>
                        <th>Sort</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr>
                        <td><span class="fw-semibold">#{{ $product->id }}</span></td>
                        <td>
                            <img src="{{ $product->thumbnail_url }}" alt="{{ $product->name }}"
                                 class="rounded" style="width:50px;height:50px;object-fit:cover;" />
                        </td>
                        <td>
                            <div>
                                <span class="fw-semibold">{{ $product->name }}</span>
                                <small class="d-block text-muted">{{ $product->slug }}</small>
                            </div>
                        </td>
                        <td>
                            <span class="fw-bold text-success">৳{{ number_format($product->price) }}</span>
                            <span class="text-muted text-decoration-line-through ms-1 small">৳{{ number_format($product->original_price) }}</span>
                            <span class="badge bg-danger ms-1">{{ $product->discount_percent }}% off</span>
                        </td>
                        <td>
                            @if($product->stock <= 10)
                                <span class="badge badge-soft-danger">{{ $product->stock }} left!</span>
                            @elseif($product->stock <= 30)
                                <span class="badge badge-soft-warning">{{ $product->stock }}</span>
                            @else
                                <span class="badge badge-soft-success">{{ $product->stock }}</span>
                            @endif
                        </td>
                        <td>
                            @if($product->badge)
                                <span class="badge bg-light text-dark">{{ $product->badge }}</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('admin.ecommerce.products.toggle', $product) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                @if($product->is_active)
                                    <button type="submit" class="badge badge-soft-success border-0" title="Click to deactivate">Active</button>
                                @else
                                    <button type="submit" class="badge badge-soft-danger border-0" title="Click to activate">Inactive</button>
                                @endif
                            </form>
                        </td>
                        <td class="text-center">
                            <form action="{{ route('admin.ecommerce.products.highlight', $product) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                @if($product->highlight)
                                    <button type="submit" class="btn btn-warning btn-icon btn-sm" title="Hero product (click to remove)">
                                        <i class="ti ti-star-filled fs-lg"></i>
                                    </button>
                                @else
                                    <button type="submit" class="btn btn-default btn-icon btn-sm" title="Set as hero product">
                                        <i class="ti ti-star fs-lg"></i>
                                    </button>
                                @endif
                            </form>
                        </td>
                        <td>{{ $product->sort_order }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-1">
                                <a href="{{ route('admin.ecommerce.products.edit', $product) }}"
                                   class="btn btn-default btn-icon btn-sm" title="Edit">
                                    <i class="ti ti-edit fs-lg"></i>
                                </a>
                                <button type="button" class="btn btn-default btn-icon btn-sm"
                                        data-bs-toggle="modal" data-bs-target="#deleteProductModal"
                                        data-product-id="{{ $product->id }}" data-product-name="{{ $product->name }}"
                                        title="Delete">
                                    <i class="ti ti-trash fs-lg"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-4">
                            <div class="text-muted">
                                <i class="ti ti-package-off fs-1"></i>
                                <p class="mt-2">No products found</p>
                                <a href="{{ route('admin.ecommerce.products.create') }}" class="btn btn-primary btn-sm">
                                    <i class="ti ti-plus me-1"></i> Add Product
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer border-0">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted fs-sm">
                    Showing {{ $products->firstItem() ?? 0 }} to {{ $products->lastItem() ?? 0 }} of {{ $products->total() }} results
                </div>
                <div>{{ $products->links('pagination::bootstrap-5') }}</div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Product Modal -->
<div class="modal fade" id="deleteProductModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Product</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="mb-0">Are you sure you want to delete <strong id="delete-product-name"></strong>?
                This will also remove all product images from storage. This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                <form id="delete-product-form" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="ti ti-trash me-1"></i> Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('deleteProductModal').addEventListener('show.bs.modal', function (e) {
    var btn = e.relatedTarget;
    document.getElementById('delete-product-name').textContent = btn.getAttribute('data-product-name');
    document.getElementById('delete-product-form').action = '/admin/ecommerce/products-manage/' + btn.getAttribute('data-product-id');
});
</script>
@endpush
