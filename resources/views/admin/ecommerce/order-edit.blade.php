@extends('admin.layouts.app')

@section('title', 'Edit Order #' . $order->id . ' | Aroma Blend Admin')

@section('content')
<div class="container-fluid">
    <div class="page-title-head d-flex align-items-center mb-3">
        <div class="flex-grow-1">
            <h4 class="page-main-title m-0">Edit Order #{{ $order->id }}</h4>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.ecommerce.order-show', $order) }}" class="btn btn-soft-secondary">
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
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Order Information</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.ecommerce.order-update', $order) }}">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $order->name) }}" required />
                                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                                    <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $order->phone) }}" required />
                                    @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $order->email) }}" />
                                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="city" class="form-label">City / Area <span class="text-danger">*</span></label>
                                    <select name="city" id="city" class="form-select @error('city') is-invalid @enderror" required>
                                        <option value="">Select area</option>
                                        @foreach($deliveryCharges as $dc)
                                        <option value="{{ $dc->area_key }}" {{ old('city', $order->city) === $dc->area_key ? 'selected' : '' }}>
                                            {{ $dc->area_name }} (&#2547;{{ number_format($dc->charge, 0) }})
                                        </option>
                                        @endforeach
                                        {{-- Keep saved value if no longer active --}}
                                        @if($order->city && !$deliveryCharges->contains('area_key', $order->city))
                                        <option value="{{ $order->city }}" selected>{{ $order->city }} (inactive)</option>
                                        @endif
                                    </select>
                                    @error('city')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                            <textarea name="address" id="address" rows="3" class="form-control @error('address') is-invalid @enderror" required>{{ old('address', $order->address) }}</textarea>
                            @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="payment_method" class="form-label">Payment Method <span class="text-danger">*</span></label>
                                    <select name="payment_method" id="payment_method" class="form-select @error('payment_method') is-invalid @enderror" required onchange="toggleTransactionFields()">
                                        @foreach($paymentMethods as $pm)
                                        <option value="{{ $pm->key }}"
                                                data-requires="{{ $pm->requires_transaction ? '1' : '0' }}"
                                                {{ old('payment_method', $order->payment_method) === $pm->key ? 'selected' : '' }}>
                                            {{ $pm->name }}
                                        </option>
                                        @endforeach
                                        {{-- Keep saved value if no longer active --}}
                                        @if($order->payment_method && !$paymentMethods->contains('key', $order->payment_method))
                                        <option value="{{ $order->payment_method }}" selected>{{ $order->payment_method }} (inactive)</option>
                                        @endif
                                    </select>
                                    @error('payment_method')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Order Status</label>
                                    <select name="status" id="status" class="form-select">
                                        @foreach(['pending', 'processing', 'shipped', 'delivered', 'cancelled'] as $s)
                                            <option value="{{ $s }}" {{ old('status', $order->status) === $s ? 'selected' : '' }}>
                                                {{ ucfirst($s) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Transaction fields (shown for bKash/Nagad etc.) -->
                        <div id="transaction-fields" style="display:none;">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="payment_number" class="form-label">Sender Number <span class="text-danger">*</span></label>
                                        <input type="text" name="payment_number" id="payment_number" class="form-control @error('payment_number') is-invalid @enderror" value="{{ old('payment_number', $order->payment_number) }}" placeholder="Number used to send payment" />
                                        @error('payment_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="transaction_id" class="form-label">Transaction ID <span class="text-danger">*</span></label>
                                        <input type="text" name="transaction_id" id="transaction_id" class="form-control @error('transaction_id') is-invalid @enderror" value="{{ old('transaction_id', $order->transaction_id) }}" placeholder="e.g. 8N3XXXXXX" />
                                        @error('transaction_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="coupon_code" class="form-label">Coupon Code</label>
                                    <input type="text" name="coupon_code" id="coupon_code" class="form-control" value="{{ old('coupon_code', $order->coupon_code) }}" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="notes" class="form-label">Notes</label>
                                    <textarea name="notes" id="notes" rows="1" class="form-control" placeholder="Optional order notes...">{{ old('notes', $order->notes) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="pt-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-check me-1"></i> Update Order
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <!-- Existing Items -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Order Items</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-sm table-borderless mb-0">
                            <thead class="bg-light bg-opacity-50">
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th class="text-end">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                <tr>
                                    <td>{{ $item->product_name }}</td>
                                    <td>&#2547;{{ number_format($item->unit_price, 2) }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td class="text-end fw-semibold">&#2547;{{ number_format($item->line_total, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-muted fs-sm">
                    To modify items, view details and manage items separately.
                </div>
            </div>

            <!-- Summary -->
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
                    <h5 class="card-title mb-3">Summary</h5>
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
                        <span class="text-muted">Delivery</span>
                        <span>&#2547;{{ number_format($order->delivery_charge, 2) }}</span>
                    </div>
                    <hr />
                    <div class="d-flex justify-content-between">
                        <span class="fw-bold fs-5">Total</span>
                        <span class="fw-bold fs-5 text-primary">&#2547;{{ number_format($order->total, 2) }}</span>
                    </div>
                </div>
            </div>

            <!-- Meta -->
            <div class="card">
                <div class="card-body">
                    <table class="table table-borderless table-sm mb-0">
                        <tr><td class="text-muted">Order ID</td><td>#{{ $order->id }}</td></tr>
                        <tr><td class="text-muted">Created</td><td>{{ $order->created_at->format('d M Y') }}</td></tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function toggleTransactionFields() {
    const sel = document.getElementById('payment_method');
    const opt = sel.options[sel.selectedIndex];
    const requires = opt && opt.dataset.requires === '1';
    const block = document.getElementById('transaction-fields');
    block.style.display = requires ? '' : 'none';
    document.getElementById('payment_number').required = requires;
    document.getElementById('transaction_id').required = requires;
}

document.addEventListener('DOMContentLoaded', function () {
    toggleTransactionFields();
});
</script>
@endpush
@endsection
