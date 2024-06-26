<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentDeleteRequest;
use App\Http\Requests\CommentResponseRequest;
use App\Models\Comment;
use App\Models\Restaurant;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index(Request $request): View|RedirectResponse
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

    public function approve($id): RedirectResponse
    {
        $comment = Comment::findOrFail($id);
        $comment->status = 'approved';
        $comment->save();

        return redirect()->back()->with('success', __('response.comment.approved'));
    }

    public function deleteRequest(CommentDeleteRequest $request,$id): RedirectResponse
    {
        $comment = Comment::findOrFail($id);
        $comment->status = 'request_deletion';
        $comment->deletion_explanation = $request->input('deletion_explanation');
        $comment->save();

        return redirect()->back()->with('success', __('response.comment.delete_request'));
    }

    public function response(CommentResponseRequest $request, $id): RedirectResponse
    {
        $comment = Comment::findOrFail($id);

        if ($comment->status === 'pending' || $comment->status === 'request_deletion') {
            return redirect()->back()->with('error', __('response.response.approve_needed'));
        }

        if ($comment->response && !$request->has('confirm')) {
            return redirect()->back()->with('warning', __('response.response_confirm'))->withInput()->with('comment_id', $comment->id);
        }

        $comment->response = $request->validated()['response'];
        $comment->save();

        return redirect()->back()->with('success', __('response.response_send'));
    }
}
