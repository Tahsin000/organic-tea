@extends('admin.layouts.app')

@section('title', 'Orders | Organic Tea Admin')

@section('content')
<div class="container-fluid">
    <div class="page-title-head d-flex align-items-center mb-3">
        <div class="flex-grow-1">
            <h4 class="page-main-title m-0">Orders</h4>
        </div>
        <div>
            <a href="{{ route('admin.ecommerce.order-create') }}" class="btn btn-primary">
                <i class="ti ti-plus me-1"></i> Add Order
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
                <form method="GET" action="{{ route('admin.ecommerce.orders') }}" class="d-flex flex-wrap gap-2 align-items-center">
                    <div class="app-search">
                        <input type="text" name="search" class="form-control" placeholder="Search..." value="{{ request('search') }}" />
                        <i class="ti ti-search app-search-icon text-muted"></i>
                    </div>

                    <div>
                        <select name="status" class="form-select form-control my-1 my-md-0">
                            <option value="">All Status</option>
                            @foreach($statuses as $s)
                                <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>
                                    {{ ucfirst($s) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-soft-primary btn-sm">
                        <i class="ti ti-filter-2 me-1"></i> Filter
                    </button>

                    @if(request('search') || request('status'))
                        <a href="{{ route('admin.ecommerce.orders') }}" class="btn btn-soft-danger btn-sm">
                            <i class="ti ti-x me-1"></i> Clear
                        </a>
                    @endif
                </form>
            </div>

            <div class="ms-auto">
                <span class="text-muted fs-sm">{{ $orders->total() }} total orders</span>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-custom table-centered table-hover w-100 mb-0">
                <thead class="bg-light bg-opacity-25 thead-sm">
                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>Phone</th>
                        <th>City</th>
                        <th>Payment</th>
                        <th>Total</th>
                        <th>Items</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td><span class="fw-semibold">#{{ $order->id }}</span></td>
                        <td>{{ $order->name }}</td>
                        <td>{{ $order->phone }}</td>
                        <td class="text-capitalize">{{ $order->city }}</td>
                        <td class="text-uppercase">
                            {{ $order->payment_method }}
                            @if($order->transaction_id)
                                <br><small class="text-muted" title="Transaction ID: {{ $order->transaction_id }}">Trx: {{ Str::limit($order->transaction_id, 10) }}</small>
                            @endif
                        </td>
                        <td class="fw-semibold">৳{{ number_format($order->total, 2) }}</td>
                        <td><span class="badge badge-soft-primary">{{ $order->items->count() }}</span></td>
                        <td>
                            <span class="badge badge-soft-{{ statusColor($order->status) }} text-capitalize">
                                {{ $order->status }}
                            </span>
                        </td>
                        <td>{{ $order->created_at->format('d M, Y') }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-1">
                                <a href="{{ route('admin.ecommerce.order-show', $order) }}" class="btn btn-default btn-icon btn-sm" title="View" data-bs-toggle="tooltip" data-bs-placement="top">
                                    <i class="ti ti-eye fs-lg"></i>
                                </a>
                                <a href="{{ route('admin.ecommerce.order-edit', $order) }}" class="btn btn-default btn-icon btn-sm" title="Edit" data-bs-toggle="tooltip" data-bs-placement="top">
                                    <i class="ti ti-edit fs-lg"></i>
                                </a>
                                <button type="button" class="btn btn-default btn-icon btn-sm delete-order-btn" title="Delete" data-bs-toggle="modal" data-bs-target="#deleteOrderModal" data-order-id="{{ $order->id }}" data-order-name="{{ $order->name }}">
                                    <i class="ti ti-trash fs-lg"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="text-center py-4">
                            <div class="text-muted">
                                <i class="ti ti-shopping-cart-off fs-1"></i>
                                <p class="mt-2">No orders found</p>
                                <a href="{{ route('admin.ecommerce.order-create') }}" class="btn btn-primary btn-sm">
                                    <i class="ti ti-plus me-1"></i> Create Order
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
                    Showing {{ $orders->firstItem() ?? 0 }} to {{ $orders->lastItem() ?? 0 }} of {{ $orders->total() }} results
                </div>
                <div>
                    {{ $orders->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Order Modal -->
<div class="modal fade" id="deleteOrderModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Order</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-0">Are you sure you want to delete order <strong id="delete-order-ref"></strong>? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                <form id="delete-order-form" method="POST">
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
document.getElementById('deleteOrderModal').addEventListener('show.bs.modal', function (e) {
    var button = e.relatedTarget;
    var orderId = button.getAttribute('data-order-id');
    var orderName = button.getAttribute('data-order-name');
    document.getElementById('delete-order-ref').textContent = '#' + orderId + ' - ' + orderName;
    document.getElementById('delete-order-form').action = '/admin/ecommerce/orders/' + orderId;
});
</script>
@endpush
