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
        $quote = Quote::inRandomOrder()->first();
        $term = Term::inRandomOrder()->first();
        $video = Video::inRandomOrder()->first();
        $photo = Photo::inRandomOrder()->first();
        
        $dailyPosts = DailyPost::where('date', Carbon::parse()->format('Y-m-d'))->first();
        $newDailyPost = new DailyPost();

        if (is_null($dailyPosts)) {
            $newDailyPost::create([
                'date' => Carbon::today()->format('Y-m-d'),
                'quote_id' => $quote->id,
                'term_id' => $term->id,
                'video_id' => $video->id,
                'photo_id' => $photo->id
            ]);
        }

        $view->with('dailyPosts', $dailyPosts);
    }
}
