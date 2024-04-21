<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RestaurantCategory;
use Illuminate\Http\Request;

class RestaurantCategoryController extends Controller
{
    public function index()
    {
        $categories = RestaurantCategory::all();
        return view('admin.restaurantCategories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255'
        ]);

        RestaurantCategory::create($request->all());

        return redirect()->route('admin.restaurantcategories.index')
            ->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(RestaurantCategory $restaurantCategory)
    {
        return view('admin.categories.show', compact('restaurantCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RestaurantCategory $restaurantCategory)
    {
        return view('admin.categories.edit', compact('restaurantCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RestaurantCategory $restaurantCategory)
    {
        $request->validate([
            'category_name' => 'required|string|max:255'
        ]);

        $restaurantCategory->update($request->all());

        return redirect()->route('admin.restaurantcategories.index')
            ->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RestaurantCategory $restaurantCategory)
    {
        $restaurantCategory->delete();

        return redirect()->route('admin.restaurantcategories.index')
            ->with('success', 'Category deleted successfully.');
    }
}
