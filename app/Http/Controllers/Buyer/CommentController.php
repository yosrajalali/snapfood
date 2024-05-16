<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Cart;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request): JsonResponse
    {
        $buyer = Auth::user();
        $cart = Cart::findOrFail($request->cart_id);

        if ($buyer->id !== $cart->buyer_id || $cart->status !== 'paid') {
            return response()->json(['message' => 'Unauthorized or cart not eligible for commenting'], 403);
        }

        Comment::create([
            'cart_id' => $cart->id,
            'buyer_id' => $buyer->id,
            'comment' => $request->comment,
            'score' => $request->score,
        ]);

        return response()->json(['msg' => 'comment created successfully']);
    }

    public function index(Request $request)
    {
        $buyerId = Auth::id();

        $comments = Comment::whereHas('cart', function ($query) use ($buyerId) {
            $query->where('buyer_id', $buyerId)
                ->where('status', 'paid');
        })->with('cart.food')
        ->get();

        return CommentResource::collection($comments);
    }

}
