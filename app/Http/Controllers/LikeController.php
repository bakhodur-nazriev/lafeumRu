<?php

namespace App\Http\Controllers;

use App\Post;
use App\Quote;
use App\User;
use Illuminate\Http\Request;
use Maize\Markable\Models\Like;

class LikeController extends Controller
{
    public function likeUnlike()
    {
        $post = Quote::whereHasLike(auth()->user())->get();
//        dd($post);

        return response()->json($post);
    }

    public function addLike($id)
    {
        $post = Quote::find($id);
        $user = User::find(2);
        Like::add($post, $user);

        session()->flash('success', 'Post is Added to Like Successfully !');

//        return response()->json();
    }

    public function removeLike($id)
    {
        $post = Post::find($id);
        $user = auth()->user();
        Like::remove($post, $user);

        session()->flash('success', 'Post is Remove from Like Successfully !');

    }
}
