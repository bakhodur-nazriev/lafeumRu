<?php


namespace App\Http\View\Composers;

use App\DailyPost;
use App\Quote;
use App\Term;
use App\Video;
use App\Photo;
use App\Post;
use Illuminate\View\View;

class DailyPostsComposer
{
    public function compose(View $view)
    {
        $dailyPost = DailyPost::find(1);
        /*$dailyPostable = $dailyPost->dailyPostable;*/

        /*$post = DailyPost::find(1);
        $dailyPost = $post->dailyPost;*/

        $view->with('dailyPost', $dailyPost);

        /*$todayQuote = Quote::all()->random();
        $todayTerm = Term::all()->random();
        $todayVideo = Video::all()->random();
        $todayPhoto = Photo::all()->random();

        $postsData = [
            'quote' => $todayQuote,
            'term' => $todayTerm,
            'video' => $todayVideo,
            'photo' => $todayPhoto
        ];

        $view->with('postsData', $postsData);*/
    }
}
