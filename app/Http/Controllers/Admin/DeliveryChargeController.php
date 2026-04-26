<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeliveryCharge;
use Illuminate\Http\Request;

class DeliveryChargeController extends Controller
{
    public function index(Request $request)
    {
        $query = DeliveryCharge::latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('area_name', 'like', "%{$search}%")
                  ->orWhere('area_key', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $charges = $query->paginate(20)->withQueryString();

        return view('admin.ecommerce.delivery-charges.index', compact('charges'));
    }

    public function create()
    {
        return view('admin.ecommerce.delivery-charges.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'area_name'  => 'required|string|max:255',
            'area_key'   => 'required|string|max:100|unique:delivery_charges,area_key|alpha_dash',
            'charge'     => 'required|numeric|min:0',
            'is_active'  => 'nullable|in:0,1',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $validated['is_active']  = ($validated['is_active'] ?? '0') === '1';
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        DeliveryCharge::create($validated);

        return redirect()->route('admin.ecommerce.delivery-charges.index')
            ->with('success', 'Delivery area added successfully.');
    }

    public function edit(DeliveryCharge $deliveryCharge)
    {
        return view('admin.ecommerce.delivery-charges.edit', compact('deliveryCharge'));
    }

    public function update(Request $request, DeliveryCharge $deliveryCharge)
    {
        $validated = $request->validate([
            'area_name'  => 'required|string|max:255',
            'area_key'   => 'required|string|max:100|unique:delivery_charges,area_key,' . $deliveryCharge->id . '|alpha_dash',
            'charge'     => 'required|numeric|min:0',
            'is_active'  => 'nullable|in:0,1',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $validated['is_active']  = ($validated['is_active'] ?? '0') === '1';
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        $deliveryCharge->update($validated);

        return redirect()->route('admin.ecommerce.delivery-charges.index')
            ->with('success', 'Delivery area updated successfully.');
    }

    public function destroy(DeliveryCharge $deliveryCharge)
    {
        $deliveryCharge->delete();

        return redirect()->route('admin.ecommerce.delivery-charges.index')
            ->with('success', 'Delivery area deleted successfully.');
    }

    public function toggleStatus(DeliveryCharge $deliveryCharge)
    {
        $deliveryCharge->update(['is_active' => !$deliveryCharge->is_active]);
        return back()->with('success', 'Delivery area status updated.');
    }
}
