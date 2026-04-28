<?php

namespace App\Http\Controllers\Admin;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Models\DeliveryCharge;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('items')->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('id', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->paginate(15);
        $statuses = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];

        return view('admin.ecommerce.orders', compact('orders', 'statuses'));
    }

    public function create()
    {
        $products        = Product::active()->orderBy('sort_order')->get(['id', 'name', 'price', 'original_price', 'slug'])->keyBy('id');
        $deliveryCharges = DeliveryCharge::active()->orderBy('sort_order')->get();
        $paymentMethods  = PaymentMethod::active()->orderBy('sort_order')->get();
        return view('admin.ecommerce.order-create', compact('products', 'deliveryCharges', 'paymentMethods'));
    }

    public function store(Request $request)
    {
        $deliveryCharges   = DeliveryCharge::active()->get()->keyBy('area_key');
        $activeAreaKeys    = $deliveryCharges->keys()->toArray();
        $activePaymentKeys = PaymentMethod::active()->pluck('key')->toArray();

        $validated = $request->validate([
            'name'               => 'required|string|max:255',
            'phone'              => 'required|string|max:20',
            'email'              => 'nullable|email|max:255',
            'address'            => 'required|string',
            'city'               => 'required|string|in:' . implode(',', $activeAreaKeys),
            'payment_method'     => 'required|string|in:' . implode(',', $activePaymentKeys),
            'payment_number'     => 'nullable|string|max:50',
            'transaction_id'     => 'nullable|string|max:100',
            'items'              => 'required|array|min:1',
            'items.*.product_id' => 'required|string',
            'items.*.quantity'   => 'required|integer|min:1',
            'coupon_code'        => 'nullable|string|max:50',
            'notes'              => 'nullable|string|max:500',
        ]);

        // Require transaction fields if the selected method needs them
        $selectedMethod = PaymentMethod::where('key', $validated['payment_method'])->first();
        if ($selectedMethod && $selectedMethod->requires_transaction) {
            $request->validate([
                'payment_number' => 'required|string|max:50',
                'transaction_id' => 'required|string|max:100',
            ]);
        }

        $deliveryCharge = $deliveryCharges->get($validated['city'])?->charge ?? 0;

        $products    = Product::active()->get()->keyBy('id');
        $subtotal    = 0;
        $orderItems  = [];
        foreach ($validated['items'] as $item) {
            $product = $products->get($item['product_id']);
            if (!$product) continue;

            $lineTotal  = $product->price * $item['quantity'];
            $subtotal  += $lineTotal;
            $orderItems[] = [
                'product_id'     => $product->id,
                'product_name'   => $product->name,
                'quantity'       => $item['quantity'],
                'unit_price'     => $product->price,
                'original_price' => $product->original_price,
                'line_total'     => $lineTotal,
            ];
        }

        if (empty($orderItems)) {
            return back()->withErrors(['items' => 'At least one valid product is required.']);
        }

        $order = Order::create([
            'name'            => $validated['name'],
            'phone'           => $validated['phone'],
            'email'           => $validated['email'] ?? null,
            'address'         => $validated['address'],
            'city'            => $validated['city'],
            'delivery_charge' => $deliveryCharge,
            'subtotal'        => $subtotal,
            'discount'        => 0,
            'total'           => $subtotal + $deliveryCharge,
            'payment_method'  => $validated['payment_method'],
            'payment_number'  => $validated['payment_number'] ?? null,
            'transaction_id'  => $validated['transaction_id'] ?? null,
            'status'          => 'pending',
            'coupon_code'     => $validated['coupon_code'] ?? null,
            'notes'           => $validated['notes'] ?? null,
        ]);

        foreach ($orderItems as $itemData) {
            $order->items()->create($itemData);
        }

        return redirect()->route('admin.ecommerce.orders')
            ->with('success', 'Order created successfully.');
    }

    public function show(Order $order)
    {
        $order->load('items');
        return view('admin.ecommerce.order-show', compact('order'));
    }

    public function invoice(Order $order)
    {
        $order->load('items');

        $pdf = Pdf::loadView('admin.ecommerce.orders.invoice', [
            'order' => $order,
            'appName' => config('app.name'),
        ])->setPaper('a4');

        return $pdf->download('invoice-order-' . $order->id . '.pdf');
    }

    public function edit(Order $order)
    {
        $order->load('items');
        $products        = Product::active()->orderBy('sort_order')->get(['id', 'name', 'price', 'original_price', 'slug'])->keyBy('id');
        $deliveryCharges = DeliveryCharge::active()->orderBy('sort_order')->get();
        $paymentMethods  = PaymentMethod::active()->orderBy('sort_order')->get();
        return view('admin.ecommerce.order-edit', compact('order', 'products', 'deliveryCharges', 'paymentMethods'));
    }

    public function update(Request $request, Order $order)
    {
        $deliveryCharges   = DeliveryCharge::active()->get()->keyBy('area_key');
        $activeAreaKeys    = array_unique(array_merge($deliveryCharges->keys()->toArray(), [$order->city]));
        $activePaymentKeys = array_unique(array_merge(PaymentMethod::active()->pluck('key')->toArray(), [$order->payment_method]));

        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'phone'          => 'required|string|max:20',
            'email'          => 'nullable|email|max:255',
            'address'        => 'required|string',
            'city'           => 'required|string|in:' . implode(',', $activeAreaKeys),
            'payment_method' => 'required|string|in:' . implode(',', $activePaymentKeys),
            'payment_number' => 'nullable|string|max:50',
            'transaction_id' => 'nullable|string|max:100',
            'status'         => 'required|string|in:pending,processing,shipped,delivered,cancelled',
            'coupon_code'    => 'nullable|string|max:50',
            'notes'          => 'nullable|string|max:500',
        ]);

        // Require transaction fields if the method needs them
        $selectedMethod = PaymentMethod::where('key', $validated['payment_method'])->first();
        if ($selectedMethod && $selectedMethod->requires_transaction) {
            $request->validate([
                'payment_number' => 'required|string|max:50',
                'transaction_id' => 'required|string|max:100',
            ]);
        }

        $deliveryCharge = $deliveryCharges->get($validated['city'])?->charge ?? $order->delivery_charge;

        $order->update([
            'name'            => $validated['name'],
            'phone'           => $validated['phone'],
            'email'           => $validated['email'] ?? null,
            'address'         => $validated['address'],
            'city'            => $validated['city'],
            'delivery_charge' => $deliveryCharge,
            'payment_method'  => $validated['payment_method'],
            'payment_number'  => $validated['payment_number'] ?? null,
            'transaction_id'  => $validated['transaction_id'] ?? null,
            'status'          => $validated['status'],
            'coupon_code'     => $validated['coupon_code'] ?? null,
            'notes'           => $validated['notes'] ?? null,
        ]);

        return redirect()->route('admin.ecommerce.orders')
            ->with('success', 'Order updated successfully.');
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('admin.ecommerce.orders')
            ->with('success', 'Order deleted successfully.');
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:pending,processing,shipped,delivered,cancelled',
        ]);

        $order->update(['status' => $validated['status']]);

        return back()->with('success', 'Order status updated to ' . $validated['status']);
    }
}
