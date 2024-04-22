<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFoodCatRequest;

use App\Http\Requests\UpdateFoodCatRequest;
use App\Http\Requests\UpdateRestaurantCatRequest;
use App\Models\FoodCategory;

use Illuminate\Http\Request;

class FoodCategoryController extends Controller
{
    public function index(Request $request)
    {

        $query = FoodCategory::query();

        if ($request->filled('search') && $request->search != '') {
            $query->where('category_name', 'LIKE', '%' . $request->search . '%');
        }

        $categories = $query->paginate(5);

        return view('admin.foodCategories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.foodCategories.create');
    }


    public function store(StoreFoodCatRequest $request)
    {

        FoodCategory::create($request->validated());

        return redirect()->route('admin.foodCategories.index')
            ->with('success', __('category.create'));
    }

    public function edit(FoodCategory $foodCategory)
    {
        return view('admin.foodCategories.edit', compact('foodCategory'));
    }


    public function update(UpdateFoodCatRequest $request, FoodCategory $foodCategory)
    {
        $foodCategory->update($request->validated());

        return redirect()->route('admin.foodCategories.index')
            ->with('success', __('category.update'));
    }


    public function destroy(FoodCategory $foodCategory)
    {
        $foodCategory->delete();

        return redirect()->route('admin.foodCategories.index')
            ->with('success', __('category.destroy'));
    }
}
