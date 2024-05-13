<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFoodRequest;
use App\Http\Requests\UpdateFoodRequest;
use App\Models\Discount;
use App\Models\Food;
use App\Models\FoodCategory;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class FoodController extends Controller
{
    public function index(Request $request): View
    {
        $seller = Auth::user();
        $restaurantId = $seller->restaurant->id;

        $query = Food::where('restaurant_id', $restaurantId);

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('category_id')) {

            $query->whereHas('categories', function ($query) use ($request) {
                $query->where('food_categories.id', $request->category_id);
            });
        }

        $foods = $query->paginate(5);
        $categories = FoodCategory::all();

        return view('seller.foods.index', compact('foods', 'categories'));
    }


    public function create(): View
    {
        $categories = FoodCategory::all();


        return view('seller.foods.create', compact('categories'));
    }

    public function store(StoreFoodRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $restaurant = Auth::user()->restaurant;


        $imagePath = null;
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $imagePath = $request->file('image')->store('foods', 'public'); // Store image in 'storage/app/public/foods'
            $imagePath = '/storage/' . $imagePath;
        }

        $food = new Food([
            'restaurant_id' => $restaurant->id,
            'name' => $validated['name'],
            'price' => $validated['price'],
            'ingredients' => $validated['ingredients'] ?? null,
            'image' => $imagePath
        ]);
        $food->save();

        // Attaching categories to the food item
        if (isset($validated['category_ids'])) {
            $food->categories()->attach($validated['category_ids']);
        }

        return redirect()->route('seller.foods.index')->with('success', __('response.food.create'));
    }


    public function edit(Food $food): View
    {
        $categories = FoodCategory::all();
        $discounts = Discount::all();
        $restaurant = Auth::user()->restaurant;

        return view('seller.foods.edit', compact('food', 'categories', 'discounts', 'restaurant'));
    }

    public function update(UpdateFoodRequest $request, Food $food): RedirectResponse
    {
        $validated = $request->validated();

        $food->update($validated);

        if (isset($validated['category_ids'])) {
            $food->categories()->sync($validated['category_ids']);
        }

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $path = $request->file('image')->store('foods', 'public');
            $food->image = '/storage/' . $path;
            $food->save();
        }
        return redirect()->route('seller.foods.index')->with('success', __('response.food.update'));
    }

    public function destroy($id): RedirectResponse
    {
        $food = Food::query()->findOrFail($id);

        if ($food->image) {
            Storage::delete($food->image);
        }

        $food->delete();

        return redirect()->route('seller.foods.index')->with('success', __('response.food.delete'));
    }

    public function toggleFoodParty($id): RedirectResponse
    {
        $food = Food::findOrFail($id);
        $food->food_party = !$food->food_party;
        $food->save();

        return back()->with('success', __('response.toggle.food_party'));
    }

}
