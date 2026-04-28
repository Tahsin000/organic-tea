<?php

namespace App\Http\Controllers;

use App\Jobs\SendNewOrderNotification;
use App\Models\DeliveryCharge;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function create(Request $request)
    {
        $products        = $this->getProducts();
        $deliveryCharges = $this->getDeliveryCharges();
        $paymentMethods  = $this->getPaymentMethods();
        $cartItems       = [];

        // Support single product or cart array
        if ($request->filled('product_id')) {
            $product = $products->firstWhere('slug', $request->input('product_id'))
                ?? $products->firstWhere('id', $request->input('product_id'));
            if ($product) {
                $qty = max(1, (int) $request->input('quantity', 1));
                $item = $product->toFrontendArray();
                $item['quantity']   = $qty;
                $item['line_total'] = $product->price * $qty;
                $cartItems[]        = $item;
            }
        }

        return Inertia::render('Checkout', [
            'products'        => $products->keyBy('slug')->map(fn ($p) => $p->toFrontendArray()),
            'cartItems'       => $cartItems,
            'deliveryCharges' => $deliveryCharges,
            'paymentMethods'  => $paymentMethods,
            'captcha'         => $this->getCaptchaConfig(),
        ]);
    }

    public function store(Request $request)
    {
        $captchaEnabled = $this->isCaptchaEnabled();
        $deliveryCharges = DeliveryCharge::active()->get()->keyBy('area_key');
        $activeKeys      = $deliveryCharges->keys()->toArray();

        $activePaymentKeys = PaymentMethod::active()->pluck('key')->toArray();

        $validated = $request->validate([
            'name'             => 'required|string|max:255',
            'phone'            => 'required|string|max:20',
            'email'            => 'nullable|email|max:255',
            'address'          => 'required|string',
            'city'             => 'required|string|in:' . implode(',', $activeKeys),
            'payment_method'   => 'required|string|in:' . implode(',', $activePaymentKeys),
            'payment_number'   => 'nullable|string|max:50',
            'transaction_id'   => 'nullable|string|max:100',
            'items'            => 'required|array|min:1',
            'items.*.product_id' => 'required',
            'items.*.quantity'   => 'required|integer|min:1',
            'captcha_token'    => $captchaEnabled ? 'required|string' : 'nullable|string',
            'coupon_code'      => 'nullable|string|max:50',
            'notes'            => 'nullable|string|max:500',
        ]);

        if ($captchaEnabled && !$this->verifyCaptchaToken((string) $validated['captcha_token'], $request->ip())) {
            return back()->withErrors([
                'captcha_token' => 'Captcha verification failed. Please try again.',
            ])->withInput();
        }

        // Validate transaction info if the selected method requires it
        $selectedMethod = PaymentMethod::where('key', $validated['payment_method'])->first();
        if ($selectedMethod && $selectedMethod->requires_transaction) {
            $request->validate([
                'payment_number' => 'required|string|max:50',
                'transaction_id' => 'required|string|max:100',
            ]);
        }

        $deliveryCharge = $deliveryCharges->get($validated['city'])?->charge ?? 0;

        $rawProductIds = collect($validated['items'])->pluck('product_id')->all();
        $productsById = Product::active()->whereIn('id', $rawProductIds)->get()->keyBy('id');
        $productsBySlug = Product::active()->whereIn('slug', $rawProductIds)->get()->keyBy('slug');

        $orderItems = [];
        $subtotal = 0;
        $savings = 0;

        foreach ($validated['items'] as $item) {
            $product = $productsById->get($item['product_id'])
                ?? $productsBySlug->get($item['product_id'])
                ?? null;

            if (!$product) {
                continue;
            }

            $quantity = (int) $item['quantity'];
            $unitPrice = (float) $product->price;
            $originalPrice = (float) ($product->original_price ?: $product->price);
            $lineTotal = $unitPrice * $quantity;

            $subtotal += $lineTotal;
            $savings += max(0, $originalPrice - $unitPrice) * $quantity;

            $orderItems[] = [
                'product_id'     => $product->id,
                'product_name'   => $product->name,
                'quantity'       => $quantity,
                'unit_price'     => $unitPrice,
                'original_price' => $originalPrice,
                'line_total'     => $lineTotal,
            ];
        }

        if (empty($orderItems)) {
            return back()->withErrors(['items' => 'At least one valid product is required.'])->withInput();
        }

        $total = $subtotal + $deliveryCharge;

        $order = Order::create([
            'name'             => $validated['name'],
            'phone'            => $validated['phone'],
            'email'            => $validated['email'] ?? null,
            'address'          => $validated['address'],
            'city'             => $validated['city'],
            'delivery_charge'  => $deliveryCharge,
            'subtotal'         => $subtotal,
            // Informational product savings (from original price), not deducted again from total.
            'discount'         => $savings,
            'total'            => $total,
            'payment_method'   => $validated['payment_method'],
            'payment_number'   => $validated['payment_number'] ?? null,
            'transaction_id'   => $validated['transaction_id'] ?? null,
            'status'           => 'pending',
            'coupon_code'      => $validated['coupon_code'] ?? null,
            'notes'            => $validated['notes'] ?? null,
        ]);

        foreach ($orderItems as $item) {
            OrderItem::create([
                'order_id'       => $order->id,
                'product_id'     => $item['product_id'],
                'product_name'   => $item['product_name'],
                'quantity'       => $item['quantity'],
                'unit_price'     => $item['unit_price'],
                'original_price' => $item['original_price'],
                'line_total'     => $item['line_total'],
            ]);
        }

        $this->dispatchOrderNotifications($order);

        return redirect()->route('landing')->with('success', 'অর্ডার সফলভাবে সম্পন্ন হয়েছে!');
    }

    private function dispatchOrderNotifications(Order $order): void
    {
        $mailSettings = (User::getSiteSettings())['mail'] ?? null;
        if (!$mailSettings || ($mailSettings['status'] ?? false) !== true) {
            return;
        }

        $emails = $mailSettings['emails'] ?? [];
        foreach ($emails as $emailConfig) {
            if (!empty($emailConfig['email']) && ($emailConfig['active'] ?? false) === true) {
                SendNewOrderNotification::dispatch($order, $emailConfig['email']);
            }
        }
    }

    private function getProducts()
    {
        // Do NOT cache Eloquent Collections — they fail to unserialize from file/db cache.
        // This query is fast (small product catalog) so fresh fetch is fine.
        return Product::active()->with(['images', 'tags'])->orderBy('sort_order')->get();
    }

    private function getDeliveryCharges(): array
    {
        return DeliveryCharge::active()->get()->map(fn ($d) => [
            'key'       => $d->area_key,
            'name'      => $d->area_name,
            'charge'    => (float) $d->charge,
            'is_active' => (bool) $d->is_active,
        ])->values()->toArray();
    }

    private function getPaymentMethods(): array
    {
        return PaymentMethod::active()->get()->map(fn ($m) => $m->toFrontendArray())->values()->toArray();
    }

    private function getCaptchaConfig(): array
    {
        return [
            'enabled'  => $this->isCaptchaEnabled(),
            'site_key' => config('services.recaptcha.site_key'),
        ];
    }

    private function isCaptchaEnabled(): bool
    {
        return filled(config('services.recaptcha.site_key'))
            && filled(config('services.recaptcha.secret_key'));
    }

    private function verifyCaptchaToken(string $token, ?string $ip = null): bool
    {
        $secret = config('services.recaptcha.secret_key');
        if (!filled($secret) || !filled($token)) {
            return false;
        }

        try {
            $payload = [
                'secret'   => $secret,
                'response' => $token,
            ];

            if ($ip) {
                $payload['remoteip'] = $ip;
            }

            $response = Http::asForm()
                ->timeout(10)
                ->post('https://www.google.com/recaptcha/api/siteverify', $payload);

            if (!$response->ok()) {
                return false;
            }

            return (bool) ($response->json('success') ?? false);
        } catch (\Throwable) {
            return false;
        }
    }
}
