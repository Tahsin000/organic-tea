@extends('admin.layouts.app')

@section('title', 'Payment Methods | Aroma Blend Admin')

@section('content')
<div class="container-fluid">
    <div class="page-title-head d-flex align-items-center mb-3">
        <div class="flex-grow-1">
            <h4 class="page-main-title m-0">Payment Methods</h4>
        </div>
        <div>
            <a href="{{ route('admin.ecommerce.payment-methods.create') }}" class="btn btn-primary">
                <i class="ti ti-plus me-1"></i> Add Method
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="alert alert-info alert-dismissible fade show">
        <i class="ti ti-info-circle me-1"></i>
        Only <strong>Active</strong> payment methods appear on the checkout page. Methods with
        <em>Requires Transaction</em> enabled will ask the customer for their sender number and transaction ID.
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>

    <div class="card">
        <div class="card-header border-light justify-content-between">
            <div class="d-flex flex-wrap gap-2 align-items-center">
                <form method="GET" action="{{ route('admin.ecommerce.payment-methods.index') }}" class="d-flex gap-2">
                    <div class="app-search">
                        <input type="text" name="search" class="form-control" placeholder="Search..." value="{{ request('search') }}" />
                        <i class="ti ti-search app-search-icon text-muted"></i>
                    </div>
                    <select name="status" class="form-select form-control">
                        <option value="">All</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    <button type="submit" class="btn btn-soft-primary btn-sm"><i class="ti ti-filter-2 me-1"></i> Filter</button>
                    @if(request()->anyFilled(['search','status']))
                        <a href="{{ route('admin.ecommerce.payment-methods.index') }}" class="btn btn-soft-danger btn-sm"><i class="ti ti-x me-1"></i> Clear</a>
                    @endif
                </form>
            </div>
            <div class="ms-auto"><span class="text-muted fs-sm">{{ $methods->total() }} methods</span></div>
        </div>

        <div class="table-responsive">
            <table class="table table-custom table-centered table-hover w-100 mb-0">
                <thead class="bg-light bg-opacity-25 thead-sm">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Key</th>
                        <th>Requires Txn</th>
                        <th>Payment Number</th>
                        <th>Sort</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($methods as $method)
                    <tr>
                        <td><span class="fw-semibold">#{{ $method->id }}</span></td>
                        <td class="fw-semibold">{{ $method->name }}</td>
                        <td><code>{{ $method->key }}</code></td>
                        <td>
                            @if($method->requires_transaction)
                                <span class="badge badge-soft-warning">Yes</span>
                            @else
                                <span class="badge badge-soft-secondary">No</span>
                            @endif
                        </td>
                        <td>{{ $method->payment_number ?? '-' }}</td>
                        <td>{{ $method->sort_order }}</td>
                        <td>
                            <form action="{{ route('admin.ecommerce.payment-methods.toggle', $method) }}" method="POST" class="d-inline">
                                @csrf @method('PATCH')
                                @if($method->is_active)
                                    <button type="submit" class="badge badge-soft-success border-0">Active</button>
                                @else
                                    <button type="submit" class="badge badge-soft-danger border-0">Inactive</button>
                                @endif
                            </form>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-1">
                                <a href="{{ route('admin.ecommerce.payment-methods.edit', $method) }}"
                                   class="btn btn-default btn-icon btn-sm" title="Edit">
                                    <i class="ti ti-edit fs-lg"></i>
                                </a>
                                <button type="button" class="btn btn-default btn-icon btn-sm"
                                        data-bs-toggle="modal" data-bs-target="#deleteModal"
                                        data-id="{{ $method->id }}" data-name="{{ $method->name }}"
                                        title="Delete">
                                    <i class="ti ti-trash fs-lg"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-4">
                            <div class="text-muted">
                                <i class="ti ti-credit-card-off fs-1"></i>
                                <p class="mt-2">No payment methods found</p>
                                <a href="{{ route('admin.ecommerce.payment-methods.create') }}" class="btn btn-primary btn-sm">
                                    <i class="ti ti-plus me-1"></i> Add Method
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
                <div class="text-muted fs-sm">Showing {{ $methods->firstItem() ?? 0 }} to {{ $methods->lastItem() ?? 0 }} of {{ $methods->total() }}</div>
                <div>{{ $methods->links('pagination::bootstrap-5') }}</div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Payment Method</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="mb-0">Are you sure you want to delete <strong id="delete-name"></strong>? This cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                <form id="delete-form" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm"><i class="ti ti-trash me-1"></i> Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('deleteModal').addEventListener('show.bs.modal', function(e) {
    var btn = e.relatedTarget;
    document.getElementById('delete-name').textContent = btn.getAttribute('data-name');
    document.getElementById('delete-form').action = '/admin/ecommerce/payment-methods/' + btn.getAttribute('data-id');
});
</script>
@endpush
