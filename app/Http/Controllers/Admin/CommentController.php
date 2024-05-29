<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\CommentStatusMail;
use App\Models\Comment;
use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CommentController extends Controller
{
    public function index(Request $request): View
    {
        $comments = Comment::where('status', 'request_deletion')
            ->orderBy('created_at', 'desc')
            ->paginate(10);


        return view('admin.comments.index', compact('comments'));
    }

    public function approve($id): RedirectResponse
    {
        $comment = Comment::findOrFail($id);
        $comment->status = 'approved';
        $comment->save();

        Mail::to($comment->cart->foods->first()->restaurant->seller->email)
            ->queue(new CommentStatusMail($comment, 'approved'));

        return redirect()->route('admin.comments.index')->with('success', __('response.admin_approve_comment'));
    }

    public function destroy(Request $request, $id): RedirectResponse
    {
        $comment = Comment::findOrFail($id);

        Mail::to($comment->cart->foods->first()->restaurant->seller->email)
            ->queue(new CommentStatusMail($comment, 'deleted'));

        $comment->delete();

        return redirect()->back()->with('success', 'نظر حذف شد.');
    }

    public function edit($id)
    {
        $comment = Comment::findOrFail($id);

        return view('admin.comments.edit', compact('comment'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $comment = Comment::findOrFail($id);
        $comment->update($request->all());

        return redirect()->route('admin.comments.index')->with('success', __('response.admin_update_comment'));
    }
}
