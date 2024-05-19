<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Http\Resources\FoodCategoryResource;
use App\Http\Resources\RestaurantListingResource;
use App\Http\Resources\RestaurantResource;
use App\Models\FoodCategory;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function show($restaurantId)
    {
        $restaurant = Restaurant::find($restaurantId);

        if (!$restaurant) {
            return response()->json(['message' => 'Restaurant not found'], 404);
        }

        return new RestaurantResource($restaurant);
    }

    public function index(Request $request)
    {
        $query = Restaurant::query();

        // Filter by is_open
        if ($request->has('is_open')) {
            $query->where('is_open', $request->is_open);
        }

        // Filter by type
        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        $restaurants = $query->paginate(10);

        return RestaurantListingResource::collection($restaurants);
    }

    public function getFoods(Restaurant $restaurant)
    {
        $categories = FoodCategory::whereHas('foods', function ($query) use ($restaurant) {
            $query->where('restaurant_id', $restaurant->id);
        })->with(['foods' => function ($query) use ($restaurant) {
            $query->where('restaurant_id', $restaurant->id);
        }])->get();


        if ($categories->isEmpty()) {
            return response()->json(['message' => 'This restaurant does not have any food'], 404);
        }

        return FoodCategoryResource::collection($categories);
    }

}
