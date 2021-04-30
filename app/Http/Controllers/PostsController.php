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

        $postMetatags = $this->getPostMetatags($post);

        return view('shows.post', compact('post', 'item', 'postMetatags'));
    }

    public function termSummary($id)
    {
        $term = Post::where('postable_type', Term::class)
            ->where('id', $id)
            ->first()
            ->postable;

        $wikipediaSummaryStyle = ['extract_html' => ''];

        if ($term) {
            $wikipediaSummaryStyle['extract_html'] = $term->body;
        }

        return $wikipediaSummaryStyle;
    }

    /**
     * Helpers
     *
     */

    private function getPostMetatags(Post $post)
    {
        $postable = $post->postable;

        $postMetatags['article'] = [
            'section' => 'Авторы',
            'published' => $postable->created_at->toAtomString(),
            'updated' => $postable->updated_at->toAtomString()
        ];

        switch ($post->postable_type) {
            case Quote::class:
                $quoteBody = mb_substr(strip_tags($postable->body), 0, 60);
                $quoteAuthor = $postable->author->name;

                if ($postable->meta_image) {
                    $postMetatags['imageUrl'] = url($postable->meta_image);
                }

                $postMetatags['title'] = "$quoteAuthor: $quoteBody...";
                $postMetatags['article']['section'] = "Цитата";
                break;

            case Term::class:
                $termName = $postable->name;
                $termBody = mb_substr(strip_tags($postable->body), 0, 150);

                if (!$termName) {
                    $termName = 'Термин';
                }

                $postMetatags['title'] = "$termName";
                $postMetatags['description'] = "$termBody ...";
                $postMetatags['article']['section'] = "Термин";
                break;

            case Video::class:
                $postMetatags['title'] = $postable->title;
                $postMetatags['article']['section'] = "Видео";
                break;
        }

        return $postMetatags;
    }
}
