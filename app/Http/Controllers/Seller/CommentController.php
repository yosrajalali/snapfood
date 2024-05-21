<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $sellerId = Auth::id();
        $restaurant = Restaurant::where('seller_id', $sellerId)->first();

        if (!$restaurant) {
            return redirect()->back()->with('error', 'Restaurant not found for the current seller.');
        }

        $restaurantId = $restaurant->id;

        $query = Comment::whereHas('cart.foods.restaurant', function ($query) use ($restaurantId) {
            $query->where('id', $restaurantId);
        });

        if ($request->has('food_id') && $request->food_id != '') {
            $foodId = $request->input('food_id');
            $query->whereHas('cart.foods', function ($query) use ($foodId) {
                $query->where('food_id', $foodId);
            });
        }

        $comments = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('seller.comments.index', compact('comments', 'restaurant'));
    }


}
