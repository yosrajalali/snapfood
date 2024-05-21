<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Cart;
use App\Models\Comment;
use App\Models\Restaurant;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $buyerId = Auth::id();

        $comments = Comment::whereHas('cart', function ($query) use ($buyerId) {
            $query->where('buyer_id', $buyerId)
                ->where('status', 'paid');
        })
            ->where('status', 'approved')
            ->with('cart.foods')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return CommentResource::collection($comments);
    }

    public function store(StoreCommentRequest $request): JsonResponse
    {
        $buyer = Auth::user();
        $cart = Cart::findOrFail($request->cart_id);

        if ($buyer->id !== $cart->buyer_id || $cart->status !== 'paid') {
            return response()->json(['message' => __('response.cart_unauthorized')], 403);
        }

        Comment::create([
            'cart_id' => $cart->id,
            'buyer_id' => $buyer->id,
            'comment' => $request->comment,
            'score' => $request->score,
        ]);

        return response()->json(['msg' =>  __('response.comment.created')]);
    }
}
