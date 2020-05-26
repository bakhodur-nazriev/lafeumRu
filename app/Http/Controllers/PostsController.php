<?php

namespace App\Http\Controllers;

use App\Post;
use App\Term;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function show(Post $post)
    {
        $item = $post->postable;

        return view('shows.post', compact('post', 'item'));
    }

    public function termSummary($id)
    {
        $term = Post::where('postable_type', Term::class)
            ->where('id', $id)
            ->first()
            ->postable;
        
        $wikipediaSummaryStyle = ['extract_html' => ''];

        if($term){
            $wikipediaSummaryStyle['extract_html'] = $term->body;
        }

        return $wikipediaSummaryStyle;
    }
}
