<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRestaurantCatRequest;
use App\Http\Requests\UpdateRestaurantCatRequest;
use App\Models\RestaurantCategory;
use Illuminate\Http\Request;

class RestaurantCategoryController extends Controller
{
    public function index(Request $request)
    {

        $query = RestaurantCategory::query();

        if ($request->filled('search') && $request->search != '') {
            $query->where('category_name', 'LIKE', '%' . $request->search . '%');
        }

        $categories = $query->paginate(5);

        return view('admin.restaurantCategories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.restaurantCategories.create');
    }


    public function store(StoreRestaurantCatRequest $request)
    {
        RestaurantCategory::create($request->validated());

        return redirect()->route('admin.restaurantCategories.index')
            ->with('success', 'Category created successfully.');
    }

    public function edit(RestaurantCategory $restaurantCategory)
    {
        return view('admin.restaurantCategories.edit', compact('restaurantCategory'));
    }


    public function update(UpdateRestaurantCatRequest $request, RestaurantCategory $restaurantCategory)
    {
        $request->validate([
            'category_name' => 'required|string|max:255'
        ]);

        $restaurantCategory->update($request->all());

        return redirect()->route('admin.restaurantCategories.index')
            ->with('success', 'Category updated successfully.');
    }


    public function destroy(RestaurantCategory $restaurantCategory)
    {
        $restaurantCategory->delete();

        return redirect()->route('admin.restaurantCategories.index')
            ->with('success', 'Category deleted successfully.');
    }
}
