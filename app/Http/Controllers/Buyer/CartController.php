<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddToCartRequest;
use App\Models\Cart;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(AddToCartRequest $request)
    {
        $buyer = Auth::user();

        $cart = Cart::where('buyer_id', $buyer->id)->where('food_id', $request->food_id)->first();

        if ($cart) {

            $cart->count += $request->count;
            $cart->save();
        } else {

            $cart = Cart::create([
                'buyer_id' => $buyer->id,
                'food_id' => $request->food_id,
                'count' => $request->count
            ]);
        }

        return response()->json([
            'msg' => 'food added to cart successfully',
            'cart_id' => $cart->id
        ]);
    }

}
