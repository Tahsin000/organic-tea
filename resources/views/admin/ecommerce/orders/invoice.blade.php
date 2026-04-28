<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $order->id }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #111827;
            margin: 24px;
        }
        .header {
            border-bottom: 2px solid #111827;
            padding-bottom: 10px;
            margin-bottom: 16px;
        }
        .title {
            font-size: 22px;
            font-weight: 700;
            margin: 0;
        }
        .sub {
            margin: 4px 0 0;
            color: #4b5563;
        }
        .meta {
            width: 100%;
            margin-bottom: 16px;
        }
        .meta td {
            vertical-align: top;
            padding: 2px 0;
        }
        .meta .label {
            color: #6b7280;
            width: 120px;
        }
        .section-title {
            font-size: 13px;
            font-weight: 700;
            margin: 10px 0 8px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th {
            background: #f3f4f6;
            border: 1px solid #d1d5db;
            padding: 8px;
            text-align: left;
            font-size: 11px;
            text-transform: uppercase;
            color: #374151;
        }
        td {
            border: 1px solid #e5e7eb;
            padding: 8px;
        }
        .right {
            text-align: right;
        }
        .totals {
            margin-top: 12px;
            width: 300px;
            margin-left: auto;
            border-collapse: collapse;
        }
        .totals td {
            border: none;
            padding: 4px 0;
        }
        .totals .grand td {
            border-top: 2px solid #111827;
            font-size: 14px;
            font-weight: 700;
            padding-top: 8px;
        }
        .footer {
            margin-top: 24px;
            border-top: 1px solid #e5e7eb;
            padding-top: 10px;
            color: #6b7280;
            font-size: 11px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <p class="title">{{ $appName }}</p>
        <p class="sub">Standard Order Invoice</p>
    </div>

    <table class="meta">
        <tr>
            <td style="width: 50%;">
                <div class="section-title">Invoice Details</div>
                <table>
                    <tr><td class="label">Invoice #</td><td>#{{ $order->id }}</td></tr>
                    <tr><td class="label">Date</td><td>{{ $order->created_at->format('d M Y, h:i A') }}</td></tr>
                    <tr><td class="label">Status</td><td>{{ ucfirst($order->status) }}</td></tr>
                    <tr><td class="label">Payment</td><td>{{ strtoupper($order->payment_method) }}</td></tr>
                </table>
            </td>
            <td style="width: 50%; padding-left: 24px;">
                <div class="section-title">Customer</div>
                <table>
                    <tr><td class="label">Name</td><td>{{ $order->name }}</td></tr>
                    <tr><td class="label">Phone</td><td>{{ $order->phone }}</td></tr>
                    <tr><td class="label">Email</td><td>{{ $order->email ?: '-' }}</td></tr>
                    <tr><td class="label">City</td><td>{{ ucfirst($order->city) }}</td></tr>
                    <tr><td class="label">Address</td><td>{{ $order->address }}</td></tr>
                </table>
            </td>
        </tr>
    </table>

    <div class="section-title">Order Items</div>
    <table>
        <thead>
            <tr>
                <th style="width: 42%;">Product</th>
                <th class="right" style="width: 12%;">Qty</th>
                <th class="right" style="width: 18%;">Unit Price</th>
                <th class="right" style="width: 14%;">Original</th>
                <th class="right" style="width: 14%;">Line Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product_name }}</td>
                    <td class="right">{{ $item->quantity }}</td>
                    <td class="right">&#2547;{{ number_format($item->unit_price, 2) }}</td>
                    <td class="right">&#2547;{{ number_format($item->original_price, 2) }}</td>
                    <td class="right">&#2547;{{ number_format($item->line_total, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table class="totals">
        <tr>
            <td>Subtotal</td>
            <td class="right">&#2547;{{ number_format($order->subtotal, 2) }}</td>
        </tr>
        <tr>
            <td>Delivery Charge</td>
            <td class="right">&#2547;{{ number_format($order->delivery_charge, 2) }}</td>
        </tr>
        <tr class="grand">
            <td>Total</td>
            <td class="right">&#2547;{{ number_format($order->total, 2) }}</td>
        </tr>
    </table>

    @if($order->notes)
        <div class="section-title">Notes</div>
        <p>{{ $order->notes }}</p>
    @endif

    <div class="footer">
        Generated by {{ $appName }} on {{ now()->format('d M Y, h:i A') }}
    </div>
</body>
</html>
