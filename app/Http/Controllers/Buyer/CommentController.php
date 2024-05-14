<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
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

        if ($buyer->id !== $cart->buyer_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        Comment::create([
            'cart_id' => $cart->id,
            'buyer_id' => $buyer->id,
            'comment' => $request->comment,
            'score' => $request->score,
        ]);

        return response()->json(['msg' => 'comment created successfully']);
    }
}
