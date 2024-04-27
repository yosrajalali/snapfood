<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDiscountRequest;
use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function index()
    {
        $discounts = Discount::paginate(5);
        return view('admin.discounts.index', compact('discounts'));
    }

    public function create()
    {
        return view('admin.discounts.create');
    }

    public function store(StoreDiscountRequest $request)
    {
        $request->validated();

        Discount::create([
            'name' => $request->name,
            'percentage' => $request->percentage,
        ]);

        return redirect()->route('admin.discounts.index')->with('success', __('response.discount.create'));
    }

    public function edit(Discount $discount)
    {
        return view('admin.discounts.edit', compact('discount'));
    }

    public function update(Request $request, Discount $discount)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'percentage' => 'required|numeric|min:0|max:100',
        ]);

        $discount->update([
            'name' => $request->name,
            'percentage' => $request->percentage,
        ]);

        return redirect()->route('admin.discounts.index')->with('success', __('response.discount.update'));
    }

    public function destroy(Discount $discount)
    {
        $discount->delete();
        return redirect()->route('admin.discounts.index')->with('success', __('response.discount.delete'));
    }
}
