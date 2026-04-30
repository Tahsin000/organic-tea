<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; background: #f3f4f6; margin: 0; padding: 20px; color: #1f2937; }
        .wrapper { max-width: 600px; margin: 0 auto; background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
        .header { background: linear-gradient(135deg, #059669, #10b981); color: #fff; padding: 24px 32px; }
        .header h1 { margin: 0; font-size: 22px; }
        .header p { margin: 4px 0 0; opacity: 0.9; font-size: 14px; }
        .section { padding: 20px 32px; }
        .section + .section { border-top: 1px solid #e5e7eb; }
        .section h2 { margin: 0 0 12px; font-size: 16px; color: #059669; }
        table { width: 100%; border-collapse: collapse; }
        th { text-align: left; background: #f9fafb; padding: 10px 12px; font-size: 12px; text-transform: uppercase; color: #6b7280; border-bottom: 1px solid #e5e7eb; }
        td { padding: 10px 12px; font-size: 14px; border-bottom: 1px solid #f3f4f6; }
        .totals { padding: 12px 32px 24px; }
        .totals table td { border: none; padding: 4px 0; }
        .totals .grand-total { font-size: 18px; font-weight: 700; color: #059669; padding-top: 8px; border-top: 2px solid #e5e7eb; }
        .info-list p { margin: 6px 0; font-size: 14px; overflow-wrap: anywhere; word-break: break-word; line-height: 1.5; }
        .info-list strong { color: #374151; }
        .table-wrap { width: 100%; overflow-x: auto; -webkit-overflow-scrolling: touch; }
        .order-table { min-width: 520px; }
        .footer { background: #f9fafb; padding: 16px 32px; text-align: center; font-size: 12px; color: #9ca3af; }
        .badge { display: inline-block; background: #fef3c7; color: #92400e; padding: 3px 10px; border-radius: 999px; font-size: 12px; font-weight: 600; text-transform: uppercase; }

        @media (max-width: 640px) {
            body { padding: 10px; }
            .header, .section, .totals, .footer { padding-left: 16px; padding-right: 16px; }
            .info-list p { margin: 8px 0; }
            th, td { white-space: nowrap; }
        }
    </style>
</head>
<body>
    @php
        $originalSubtotal = $items->sum(function ($item) {
            $original = (float) ($item->original_price ?: $item->unit_price);
            $unit = (float) $item->unit_price;
            return max($original, $unit) * (int) $item->quantity;
        });
        $productSavings = max(0, $originalSubtotal - (float) $order->subtotal);
        $productSavingsPercent = $originalSubtotal > 0
            ? (int) round(($productSavings / $originalSubtotal) * 100)
            : 0;
    @endphp

    <div class="wrapper">
        <div class="header">
            <h1>New Order #{{ $order->id }}</h1>
            <p>Placed on {{ $order->created_at->format('M d, Y H:i') }}</p>
        </div>

        <div class="section">
            <h2>Customer Information</h2>
            <div class="info-list">
                <p><strong>Name:</strong> {{ $order->name }}</p>
                <p><strong>Phone:</strong> {{ $order->phone }}</p>
                @if($order->email)
                    <p><strong>Email:</strong> {{ $order->email }}</p>
                @endif
                <p><strong>Address:</strong> {{ $order->address }}</p>
                <p><strong>City:</strong> {{ ucfirst($order->city) }}</p>
                <p><strong>Payment:</strong> {{ strtoupper($order->payment_method) }}</p>
                <p><strong>Status:</strong> <span class="badge">{{ ucfirst($order->status) }}</span></p>
            </div>
            @if($order->notes)
                <p style="margin-top:12px; overflow-wrap:anywhere; word-break:break-word;"><strong>Notes:</strong> {{ $order->notes }}</p>
            @endif
        </div>

        <div class="section">
            <h2>Order Items</h2>
            <div class="table-wrap">
                <table class="order-table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th style="text-align:center;">Qty</th>
                            <th style="text-align:right;">Unit Price</th>
                            <th style="text-align:right;">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                        <tr>
                            <td style="overflow-wrap:anywhere; word-break:break-word; white-space:normal;">{{ $item->product_name }}</td>
                            <td style="text-align:center;">{{ $item->quantity }}</td>
                            <td style="text-align:right;">&#2547;{{ number_format($item->unit_price, 2) }}</td>
                            <td style="text-align:right;">&#2547;{{ number_format($item->line_total, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="totals">
            <table>
                <tr>
                    <td style="width:60%;">Subtotal</td>
                    <td style="text-align:right;">&#2547;{{ number_format($order->subtotal, 2) }}</td>
                </tr>
                @if($productSavings > 0)
                    <tr>
                        <td>Product Savings{{ $productSavingsPercent > 0 ? ' (' . $productSavingsPercent . '%)' : '' }}</td>
                        <td style="text-align:right; color:#059669;">&#2547;{{ number_format($productSavings, 2) }}</td>
                    </tr>
                @endif
                <tr>
                    <td>Delivery Charge</td>
                    <td style="text-align:right;">&#2547;{{ number_format($order->delivery_charge, 2) }}</td>
                </tr>
                <tr class="grand-total">
                    <td>Total</td>
                    <td style="text-align:right;">&#2547;{{ number_format($order->total, 2) }}</td>
                </tr>
            </table>
        </div>

        <div class="footer">
            <p>Aroma Blend - Automated Order Notification</p>
        </div>
    </div>
</body>
</html>
