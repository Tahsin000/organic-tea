@extends('admin.layouts.app')

@section('title', 'Order #' . $order->id . ' | Aroma Blend Admin')

@section('content')
<div class="container-fluid">
    <div class="page-title-head d-flex align-items-center mb-3">
        <div class="flex-grow-1">
            <h4 class="page-main-title m-0">Order #{{ $order->id }}</h4>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.ecommerce.order-edit', $order) }}" class="btn btn-primary">
                <i class="ti ti-edit me-1"></i> Edit
            </a>
            <a href="{{ route('admin.ecommerce.orders') }}" class="btn btn-soft-secondary">
                <i class="ti ti-arrow-left me-1"></i> Back
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-xl-8">
            <!-- Customer Info -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Customer Information</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless table-sm mb-0">
                                <tr><td class="text-muted" style="width:120px">Name</td><td class="fw-semibold">{{ $order->name }}</td></tr>
                                <tr><td class="text-muted">Phone</td><td>{{ $order->phone }}</td></tr>
                                <tr><td class="text-muted">Email</td><td>{{ $order->email ?? '-' }}</td></tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless table-sm mb-0">
                                <tr><td class="text-muted" style="width:100px">Address</td><td>{{ $order->address }}</td></tr>
                                <tr><td class="text-muted">City</td><td class="text-capitalize">{{ $order->city }}</td></tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Order Items</h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-centered table-hover mb-0">
                        <thead class="bg-light bg-opacity-25">
                            <tr>
                                <th>Product</th>
                                <th>Unit Price</th>
                                <th>Original Price</th>
                                <th>Quantity</th>
                                <th class="text-end">Line Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                            <tr>
                                <td class="fw-semibold">{{ $item->product_name }}</td>
                                <td>&#2547;{{ number_format($item->unit_price, 2) }}</td>
                                <td class="text-muted"><del>&#2547;{{ number_format($item->original_price, 2) }}</del></td>
                                <td>{{ $item->quantity }}</td>
                                <td class="text-end fw-semibold">&#2547;{{ number_format($item->line_total, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            @if($order->notes)
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Notes</h4>
                </div>
                <div class="card-body">
                    <p class="mb-0">{{ $order->notes }}</p>
                </div>
            </div>
            @endif
        </div>

        <div class="col-xl-4">
            <!-- Order Status -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Order Status</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.ecommerce.order-update-status', $order) }}">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <select name="status" class="form-select" onchange="this.form.submit()">
                                @foreach(['pending', 'processing', 'shipped', 'delivered', 'cancelled'] as $status)
                                    <option value="{{ $status }}" {{ $order->status === $status ? 'selected' : '' }}>
                                        {{ ucfirst($status) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                    <span class="badge badge-soft-{{ statusColor($order->status) }} fs-5 text-capitalize">
                        {{ $order->status }}
                    </span>
                </div>
            </div>

            <!-- Payment Summary -->
            <div class="card">
                <div class="card-body">
                    @php
                        $originalTotal = $order->items->sum(function ($item) {
                            $original = (float) ($item->original_price ?: $item->unit_price);
                            $unit = (float) $item->unit_price;
                            return max($original, $unit) * (int) $item->quantity;
                        });
                        $productSavings = max(0, $originalTotal - (float) $order->subtotal);
                        $productSavingsPercent = $originalTotal > 0
                            ? (int) round(($productSavings / $originalTotal) * 100)
                            : 0;
                    @endphp
                    <h5 class="card-title mb-3">Payment Summary</h5>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Subtotal</span>
                        <span>&#2547;{{ number_format($order->subtotal, 2) }}</span>
                    </div>
                    @if($productSavings > 0)
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Product Savings{{ $productSavingsPercent > 0 ? ' (' . $productSavingsPercent . '%)' : '' }}</span>
                            <span class="text-success">&#2547;{{ number_format($productSavings, 2) }}</span>
                        </div>
                    @endif
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Delivery Charge</span>
                        <span>&#2547;{{ number_format($order->delivery_charge, 2) }}</span>
                    </div>
                    <hr />
                    <div class="d-flex justify-content-between">
                        <span class="fw-bold fs-5">Total</span>
                        <span class="fw-bold fs-5 text-primary">&#2547;{{ number_format($order->total, 2) }}</span>
                    </div>
                </div>
            </div>

            <!-- Order Meta -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Order Details</h5>
                    <table class="table table-borderless table-sm mb-0">
                        <tr><td class="text-muted">Order ID</td><td class="fw-semibold">#{{ $order->id }}</td></tr>
                        <tr><td class="text-muted">Payment</td><td class="text-uppercase fw-semibold">{{ $order->payment_method }}</td></tr>
                        @if($order->payment_number)
                        <tr>
                            <td class="text-muted">Sender No.</td>
                            <td>{{ $order->payment_number }}</td>
                        </tr>
                        @endif
                        @if($order->transaction_id)
                        <tr>
                            <td class="text-muted">Trx ID</td>
                            <td><span class="badge badge-soft-info">{{ $order->transaction_id }}</span></td>
                        </tr>
                        @endif
                        @if($order->coupon_code)
                        <tr><td class="text-muted">Coupon</td><td>{{ $order->coupon_code }}</td></tr>
                        @endif
                        <tr><td class="text-muted">Created</td><td>{{ $order->created_at->format('d M Y, h:i A') }}</td></tr>
                        <tr><td class="text-muted">Updated</td><td>{{ $order->updated_at->format('d M Y, h:i A') }}</td></tr>
                    </table>
                </div>
            </div>

            <!-- Delete -->
            <div class="card border-danger">
                <div class="card-body">
                    <h6 class="text-danger mb-2">Danger Zone</h6>
                    <form method="POST" action="{{ route('admin.ecommerce.order-delete', $order) }}" onsubmit="return confirm('Permanently delete order #{{ $order->id }}? This cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="ti ti-trash me-1"></i> Delete Order
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
