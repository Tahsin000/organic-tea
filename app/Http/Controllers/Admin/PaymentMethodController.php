<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    public function index(Request $request)
    {
        $query = PaymentMethod::latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('key', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $methods = $query->paginate(20)->withQueryString();

        return view('admin.ecommerce.payment-methods.index', compact('methods'));
    }

    public function create()
    {
        return view('admin.ecommerce.payment-methods.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'                 => 'required|string|max:255',
            'key'                  => 'required|string|max:100|unique:payment_methods,key|alpha_dash',
            'description'          => 'nullable|string',
            'requires_transaction' => 'nullable|in:0,1',
            'payment_number'       => 'nullable|string|max:50',
            'icon'                 => 'nullable|string|max:100',
            'is_active'            => 'nullable|in:0,1',
            'sort_order'           => 'nullable|integer|min:0',
        ]);

        $validated['requires_transaction'] = ($validated['requires_transaction'] ?? '0') === '1';
        $validated['is_active']            = ($validated['is_active'] ?? '0') === '1';
        $validated['sort_order']           = $validated['sort_order'] ?? 0;

        PaymentMethod::create($validated);

        return redirect()->route('admin.ecommerce.payment-methods.index')
            ->with('success', 'Payment method added successfully.');
    }

    public function edit(PaymentMethod $paymentMethod)
    {
        return view('admin.ecommerce.payment-methods.edit', compact('paymentMethod'));
    }

    public function update(Request $request, PaymentMethod $paymentMethod)
    {
        $validated = $request->validate([
            'name'                 => 'required|string|max:255',
            'key'                  => 'required|string|max:100|unique:payment_methods,key,' . $paymentMethod->id . '|alpha_dash',
            'description'          => 'nullable|string',
            'requires_transaction' => 'nullable|in:0,1',
            'payment_number'       => 'nullable|string|max:50',
            'icon'                 => 'nullable|string|max:100',
            'is_active'            => 'nullable|in:0,1',
            'sort_order'           => 'nullable|integer|min:0',
        ]);

        $validated['requires_transaction'] = ($validated['requires_transaction'] ?? '0') === '1';
        $validated['is_active']            = ($validated['is_active'] ?? '0') === '1';
        $validated['sort_order']           = $validated['sort_order'] ?? 0;

        $paymentMethod->update($validated);

        return redirect()->route('admin.ecommerce.payment-methods.index')
            ->with('success', 'Payment method updated successfully.');
    }

    public function destroy(PaymentMethod $paymentMethod)
    {
        $paymentMethod->delete();

        return redirect()->route('admin.ecommerce.payment-methods.index')
            ->with('success', 'Payment method deleted successfully.');
    }

    public function toggleStatus(PaymentMethod $paymentMethod)
    {
        $paymentMethod->update(['is_active' => !$paymentMethod->is_active]);
        return back()->with('success', 'Payment method status updated.');
    }
}
