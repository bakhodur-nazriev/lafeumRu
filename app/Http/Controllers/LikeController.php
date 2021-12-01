<?php

namespace App\Http\Controllers;

use App\Http\Requests\LikeRequest;
use App\Http\Requests\UnlikeRequest;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function likePost(Request $request)
    {
        $post_id = $request['postId'];
        $is_like = $request['isLike'] === 'true';

        $post = Post::find($post_id);

        if (!$post) {
            return null;
        }
        $user = Auth::user();
        $like = $user->likes();

//        $request->user()->like($request->likeable());
//
//        if ($request->ajax()) {
//            return response()->json([
//                'likes' => $request->likeable()->likes()->count(),
//            ]);
//        }
//
//        return redirect()->back();
    }

    public function unlikePost(UnlikeRequest $request)
    {
        $request->user()->unlike($request->likeable());

        if ($request->ajax()) {
            return response()->json([
                'likes' => $request->likeable()->likes()->count(),
            ]);
        }

        return redirect()->back();
    }
}
