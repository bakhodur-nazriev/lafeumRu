<?php

namespace App\Http\Controllers;

use App\Post;
use App\Quote;
use App\Term;
use App\Video;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function show(Post $post)
    {
        $item = $post->postable;

        $postMetatags = [];

        $postMetatags['article'] = [
            'section' => 'Авторы',
            'published' => $item->created_at->toAtomString(),
            'updated' => $item->updated_at->toAtomString()
        ];
    
        switch ($post->postable_type) {
            case Quote::class:
                $quoteBody = mb_substr(strip_tags($item->body), 0, 60);
                $quoteAuthor = $item->author->name;
    
                $postMetatags['title'] = "$quoteAuthor: $quoteBody...  ЛАФЕЮМ";
                break;

            case Term::class:
                $termBody = mb_substr(strip_tags($item->body), 0, 60);
    
                $postMetatags['title'] = "$termBody... - ЛАФЕЮМ";
                $postMetatags['description'] = mb_substr(strip_tags($item->body), 0, 150) .  '...';
                break;

            case Video::class:
                $postMetatags['title'] = $item->title;
                break;
        }

        return view('shows.post', compact('post', 'item', 'postMetatags'));
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
