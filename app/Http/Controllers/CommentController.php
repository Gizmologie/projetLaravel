<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\StoreCommentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    /**
     * @param StoreCommentRequest $request
     * @param $product_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeComment(StoreCommentRequest $request, $product_id)
    {
        $params = $request->validated();
        $params['product_id'] = $product_id;
        $params['user_id'] = Auth::id();
        $params['is_visible'] = 0;
        Comment::create($params);
        return back();
    }

    public function removeComment($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return back();
    }
}
