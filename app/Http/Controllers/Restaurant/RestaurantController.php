<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRestaurantRequest;
use App\Models\FoodCategory;
use App\Models\Restaurant;
use App\Models\RestaurantCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class RestaurantController extends Controller
{
    public function create(): View
    {
        $categories = RestaurantCategory::all();
        return view('seller.restaurant.create', compact('categories'));
    }

    public function store(CreateRestaurantRequest $request)
    {
        $validated = $request->validated();
        $seller = Auth::user();

        Restaurant::create([
            'name' => $validated['name'],
            'type' => $validated['type'],
            'phone_number' => $validated['phone_number'],
            'address' => $validated['address'],
            'bank_account_number' => $validated['bank_account_number'],
            'seller_id' => $seller->id,
            'is_complete' =>true,
        ]);

        return redirect()->route('seller.index')->with('success', __('response.restaurant.create'));
    }

    public function edit()
    {
        $restaurant = Auth::user()->restaurant;
        $categories = RestaurantCategory::all();
        return view('seller.restaurant.settings', compact('restaurant', 'categories'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'address' => 'required|string|max:1000',
            'bank_account_number' => 'nullable|string|max:255',
            'delivery_cost' => 'nullable|numeric',
            'operational_hours' => 'array',
            'operational_hours.*' => 'array',  // Ensure each day can hold an array of times
            'operational_hours.*.*' => 'nullable|string', // Validate each time entry
        ]);

        $restaurant = Auth::user()->restaurant;

        // Processing operational hours to ensure empty or null values are not stored
        $operationalHours = array_filter($request->operational_hours, function ($day) {
            return array_filter($day); // Filter out empty arrays for days
        });

        $restaurant->update([
            'name' => $request->name,
            'type' => $request->type,
            'address' => $request->address,
            'bank_account_number' => $request->bank_account_number,
            'delivery_cost' => $request->delivery_cost,
            'operational_hours' => json_encode($operationalHours),
        ]);

        return redirect()->route('seller.index')->with('success', 'تنظیمات رستوران با موفقیت به روز رسانی شد.');
    }


//    public function update(Request $request)
//    {
//        $request->validate([
//            'name' => 'required|string|max:255',
//            'type' => 'required|string|max:255',
//            'address' => 'required|string|max:1000',
//            'bank_account_number' => 'nullable|string|max:255',
//            'delivery_cost' => 'nullable|numeric',
//            'operational_hours' => 'array',
//            'operational_hours.*' => 'nullable|string',
//        ]);
//
//        $restaurant = Auth::user()->restaurant;
//
//        $restaurant->update([
//            'name' => $request->name,
//            'type' => $request->type,
//            'address' => $request->address,
//            'bank_account_number' => $request->bank_account_number,
//            'delivery_cost' => $request->delivery_cost,
//            'operational_hours' => json_encode($request->operational_hours),
//        ]);
//
//        return redirect()->route('seller.index')->with('success', 'تنظیمات رستوران با موفقیت به روز رسانی شد.');
//    }
}
