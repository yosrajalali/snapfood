<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddToCartRequest;
use App\Http\Requests\PayCartRequest;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Http\Resources\CartResource;
use App\Http\Resources\GetCartResource;
use App\Mail\OrderCreatedMail;
use App\Models\Cart;
use App\Models\Comment;
use App\Models\Food;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{

    public function index(Request $request): AnonymousResourceCollection
    {
        $carts = Cart::where('buyer_id', Auth::id())
            ->with('foods.restaurant')
            ->paginate(10);

        return CartResource::collection($carts);
    }

    public function addToCart(AddToCartRequest $request): JsonResponse
    {
        $buyer = Auth::user();
        $food = Food::findOrFail($request->food_id);

        $restaurant = $food->restaurant;
        if (!$restaurant->is_open) {
            return response()->json([
                'msg' => __('response.restaurant.closed')
            ], 403);
        }

        $restaurantId = $food->restaurant_id;
        $cart = Cart::where('buyer_id', $buyer->id)
            ->where('restaurant_id', $restaurantId)
            ->where('status', 'unpaid')
            ->first();

        if ($cart) {
            $cartFood = $cart->foods()->where('food_id', $request->food_id)->first();
            if ($cartFood) {
                $cartFood->pivot->count += $request->count;
                $cartFood->pivot->save();
            } else {
                $cart->foods()->attach($request->food_id, ['count' => $request->count]);
            }
        } else {
            $cart = Cart::create([
                'buyer_id' => $buyer->id,
                'restaurant_id' => $restaurantId,
                'status' => 'unpaid'
            ]);


            $cart->foods()->attach($request->food_id, ['count' => $request->count]);
        }

        return response()->json([
            'msg' => __('response.cart.food_added'),
            'data' => new CartResource($cart)
        ],200);
    }

    public function updateCart(UpdateCartRequest $request, $cartId): JsonResponse
    {
        $buyer = Auth::user();
        $cart = Cart::where('id', $cartId)->where('buyer_id', $buyer->id)->first();

        if (!$cart) {
            return response()->json(['msg' => __('response.cart.not_exist')], 404);
        }

        if ($cart->status === 'paid') {
            return response()->json(['msg' => __('response.cart.paid_error')]);
        }

        $restaurant = $cart->restaurant;

        if (!$restaurant->is_open) {
            return response()->json(['msg' => __('response.restaurant.closed')], 403);
        }

        $food = $cart->foods()->where('food_id', $request->food_id)->first();

        if (!$food) {
            return response()->json(['msg' => __('response.cart.food_not_exist')], 404);
        }

        $cart->foods()->updateExistingPivot($request->food_id, [
            'count' => $request->count
        ]);


        return response()->json([
            'message' => __('response.cart.update'),
            'data' => new CartResource($cart)
        ], 200);
    }


    public function show(Request $request, $cartId): JsonResponse|GetCartResource
    {
        $buyer = Auth::guard('buyer')->user();

        $cart = Cart::with('foods.restaurant')
        ->where('id', $cartId)
            ->where('buyer_id', $buyer->id)
            ->first();

        if (!$cart) {
            return response()->json(['message' => 'Cart not found'], 404);
        }

        return new GetCartResource($cart);
    }

    public function pay(PayCartRequest $request, $cartId): JsonResponse
    {
        $cart = Cart::with('foods.restaurant', 'foods.discount')->find($cartId);

        if (!$cart || $cart->buyer_id != Auth::id()) {
            return response()->json(['message' => __('response.cart_unauthorized')], 403);
        }

        if ($cart->status === 'paid') {
            return response()->json(['message' => __('response.cart.paid_error')], 422);
        }

        $restaurant = $cart->restaurant;

        if (!$restaurant->is_open) {
            return response()->json(['msg' => __('response.restaurant.closed')], 403);
        }

        DB::beginTransaction();
        try {
            $total = 0;
            foreach ($cart->foods as $food) {
                $discount = $food->discount ? (1 - ($food->discount->percentage / 100)) : 1;
                $total += $food->pivot->count * $food->price * $discount;
            }

            $paymentSuccessful = true;

            if (!$paymentSuccessful) {
                throw new \Exception('Payment failed');
            }

            $order = new Order([
                'cart_id' => $cart->id,
                'restaurant_id' => $cart->restaurant->id,
                'total_price' => $total,
                'status_id' => 1,
            ]);
            $order->save();

            $cart->update(['status' => 'paid']);

            Mail::to($cart->buyer->email)->send(new OrderCreatedMail($order));

            DB::commit();

            return new JsonResponse([
                'message' => __('response.cart.successful_payment'),
                'order_id' => $order->id,
                'total_paid' => $total
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return new JsonResponse(['message' => 'Payment failed: ' . $e->getMessage()], 400);
        }
    }
}

