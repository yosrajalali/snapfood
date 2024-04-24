<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFoodRequest;
use App\Http\Requests\UpdateFoodRequest;
use App\Models\Food;
use App\Models\FoodCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class FoodController extends Controller
{
    public function index(Request $request): View
    {
        $query = Food::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
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

        $path = null;
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $path = $validated['image']->store('foods', 'public'); // Storing image in 'storage/app/public/foods'
        }

         Food::query()->create([
             'restaurant_id' => $restaurant->id,
             'name' => $validated['name'],
             'category_id' => $validated['category_id'],
             'price' => $validated['price'],
             'ingredients' => $validated['ingredients'] ?? null,
             'image' => '/storage/' . $path
        ]);

        return redirect()->route('seller.foods.index')->with('success', __('response.food.create'));
    }

    public function edit(Food $food): View
    {
        $categories = FoodCategory::all();
        return view('seller.foods.edit', compact('food', 'categories'));
    }

    public function update(UpdateFoodRequest $request, Food $food): RedirectResponse
    {
        $validated = $request->validated();

        $food->update($validated);
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
}
