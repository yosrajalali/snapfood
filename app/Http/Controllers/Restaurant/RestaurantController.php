<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRestaurantRequest;
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
}
