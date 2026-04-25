<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function index(Request $request)
    {
        $query = Currency::latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%")
                  ->orWhere('symbol', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status === 'active');
        }

        $currencies = $query->paginate(20);

        return view('admin.ecommerce.currencies', compact('currencies'));
    }

    public function create()
    {
        return view('admin.ecommerce.currency-create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code'   => 'required|string|max:10|unique:currencies,code',
            'name'   => 'required|string|max:255',
            'symbol' => 'nullable|string|max:5',
            'status' => 'nullable|in:0,1',
        ]);

        $validated['status'] = $validated['status'] === '1';

        Currency::create($validated);

        return redirect()->route('admin.ecommerce.currencies')
            ->with('success', 'Currency added successfully.');
    }

    public function edit(Currency $currency)
    {
        return view('admin.ecommerce.currency-edit', compact('currency'));
    }

    public function update(Request $request, Currency $currency)
    {
        $validated = $request->validate([
            'code'   => 'required|string|max:10|unique:currencies,code,' . $currency->id,
            'name'   => 'required|string|max:255',
            'symbol' => 'nullable|string|max:5',
            'status' => 'nullable|in:0,1',
        ]);

        $validated['status'] = $validated['status'] === '1';

        $currency->update($validated);

        return redirect()->route('admin.ecommerce.currencies')
            ->with('success', 'Currency updated successfully.');
    }

    public function toggleStatus(Currency $currency)
    {
        $currency->update(['status' => !$currency->status]);

        return back()->with('success', 'Currency status updated.');
    }
}
