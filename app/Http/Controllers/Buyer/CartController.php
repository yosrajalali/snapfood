<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddToCartRequest;
use App\Http\Requests\PayCartRequest;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Http\Resources\CartResource;
use App\Http\Resources\GetCartResource;
use App\Models\Cart;
use App\Models\Comment;
use App\Models\Food;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{

    public function index(Request $request): AnonymousResourceCollection
    {
        $carts = Cart::where('buyer_id', Auth::id())->with('food.restaurant')->get();
        return CartResource::collection($carts);
    }
    public function addToCart(AddToCartRequest $request): JsonResponse
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

    public function updateCart(UpdateCartRequest $request): JsonResponse
    {
        $buyer = Auth::user();

        $cart = Cart::where('buyer_id', $buyer->id)
            ->where('food_id', $request->food_id)
            ->first();

        if (!$cart) {
            return response()->json(['msg' => 'Cart item does not exist'], 404);
        }

        $cart->update([
            'count' => $request->count
        ]);

        return response()->json([
            'msg' => 'Cart updated successfully',
            'cart_id' => $cart->id
        ]);
    }

    public function show(Request $request, $cartId): JsonResponse|GetCartResource
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


    public function pay(PayCartRequest $request, $cartId): JsonResponse
    {
        $cart = Cart::with('food.restaurant')->find($cartId);

        if (!$cart || $cart->buyer_id != Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        DB::beginTransaction();
        try {
            $total = $cart->count * $cart->food->price;

            $paymentSuccessful = true;

            if (!$paymentSuccessful) {
                throw new \Exception('Payment failed');
            }

            $order = new Order([
                'buyer_id' => $cart->buyer_id,
                'restaurant_id' => $cart->food->restaurant->id,
                'total_price' => $total,
                'status_id' => 1,
            ]);
            $order->save();

            // Add order items from cart
//            $order->items()->create([
//                'food_id' => $cart->food_id,
//                'quantity' => $cart->count,
//                'price' => $cart->food->price
//            ]);

            $cart->delete();

            DB::commit();

            return new JsonResponse([
                'message' => 'Payment successful and order created',
                'order_id' => $order->id,
                'total_paid' => $total
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return new JsonResponse(['message' => 'Payment failed: ' . $e->getMessage()], 400);
        }
    }

}
