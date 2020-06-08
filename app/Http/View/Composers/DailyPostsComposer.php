<?php


namespace App\Http\View\Composers;

use App\DailyPost;
use App\Quote;
use App\Term;
use App\Video;
use App\Photo;
use Carbon\Carbon;
use Illuminate\View\View;

class DailyPostsComposer
{
    public function compose(View $view)
    {
        $quotes = Quote::all()->random();
        $terms = Term::all()->random();
        $videos = Video::all()->random();
        $photos = Photo::all()->random();
        $dailyPosts = DailyPost::where('date', Carbon::parse()->format('Y-m-d'))->first();
        $newDailyPost = new DailyPost();

        if (is_null($dailyPosts)) {
            $newDailyPost::create([
                'date' => Carbon::today()->format('Y-m-d'),
                'quote_id' => $quotes->id,
                'term_id' => $terms->id,
                'video_id' => $videos->id,
                'photo_id' => $photos->id
            ]);
        }

        $view->with('dailyPosts', $dailyPosts);
    }
}
