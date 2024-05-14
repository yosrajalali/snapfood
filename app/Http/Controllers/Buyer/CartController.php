<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddToCartRequest;
use App\Http\Requests\PayCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Http\Resources\CartResource;
use App\Http\Resources\GetCartResource;
use App\Models\Cart;
use App\Models\Food;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{

    public function index(Request $request)
    {
        $carts = Cart::where('buyer_id', Auth::id())->with('food.restaurant')->get();
        return CartResource::collection($carts);
    }
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

//    public function index(Request $request)
//    {
//        $buyerId = Auth::id(); // Get the authenticated buyer's ID
//
//        // Fetch carts with related food and restaurant data
//        $carts = Cart::where('buyer_id', $buyerId)
//            ->with(['foods' => function ($query) {
//                $query->with(['restaurant']); // Ensure restaurant data is loaded with foods
//            }])
//            ->get();
//
//        return CartResource::collection($carts);
//    }
//
//
//    public function addToCart(AddToCartRequest $request)
//    {
//        $buyerId = Auth::id();
//        $foodId = $request->food_id;
//        $additionalCount = $request->count;
//
//        // Retrieve the cart for the buyer or create a new one
//        $cart = Cart::firstOrCreate(['buyer_id' => $buyerId]);
//
//        // Attempt to retrieve the pivot entry for the food in the cart
//        $pivot = $cart->foods()->where('food_id', $foodId)->first();
//
//        if ($pivot) {
//            // Food is already in the cart, update the count
//            $newCount = $pivot->pivot->count + $additionalCount;
//            $cart->foods()->updateExistingPivot($foodId, ['count' => $newCount]);
//        } else {
//            // Food is not in the cart, add it with the initial count
//            $cart->foods()->attach($foodId, ['count' => $additionalCount]);
//        }
//
//        return response()->json([
//            'message' => 'Food added or updated in cart successfully',
//            'cart_id' => $cart->id,
//            'new_count' => $pivot ? $newCount : $additionalCount  // Return the updated count if the food was already in the cart
//        ]);
//    }


    public function updateCart(UpdateCartRequest $request)
    {
        $buyer = Auth::user();

        $cart = Cart::where('buyer_id', $buyer->id)
            ->where('food_id', $request->food_id)
            ->first();

        if (!$cart) {
            return response()->json(['msg' => 'Cart item does not exist'], 404);
        }

        // Update the existing cart item to the new count value
        $cart->update([
            'count' => $request->count // Directly set the count to the new value
        ]);

        return response()->json([
            'msg' => 'Cart updated successfully',
            'cart_id' => $cart->id
        ]);
    }

    public function show(Request $request, $cartId)
    {
        $buyer = Auth::guard('buyer')->user();

        $cart = Cart::where('id', $cartId)
            ->where('buyer_id', $buyer->id)
            ->first();

        if (!$cart) {
            return response()->json(['message' => 'Cart not found'], 404);
        }

        return new GetCartResource($cart);
    }

    public function pay(PayCartRequest $request, Cart $cart)
    {
        if ($request->user()->id !== $cart->buyer_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        DB::beginTransaction();
        try {

            $total = $cart->count * $cart->food->price;

            $paymentSuccessful = true;

            if (!$paymentSuccessful) {
                throw new \Exception('Payment failed');
            }


            //$cart->update(['status' => 'paid']);

            DB::commit();

            return new JsonResponse([
                'message' => 'Payment successful',
                'total_paid' => $total
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return new JsonResponse(['message' => 'Payment failed: ' . $e->getMessage()], 400);
        }
    }


}
