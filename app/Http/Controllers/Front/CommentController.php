<?php

namespace App\Http\Controllers\Front;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    /**
     * @param StoreCommentRequest $request
     * @param $product_id
     */
    public function storeComment(StoreCommentRequest $request, $product_id)
    {
        $user = Auth::user();

        if ($user->getComments()->count() > 0){
            return new JsonResponse(['success' => false]);
        }

        $params = $request->validated();
        $params['product_id'] = $product_id;
        $params['user_id'] = $user->id;
        $params['is_visible'] = 0;
        Comment::create($params);
        return new JsonResponse(['success' => true]);
    }

    public function removeComment($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return back();
    }
}
