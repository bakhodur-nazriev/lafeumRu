<?php


namespace App\Http\View\Composers;

use App\Author;
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
        // Get all daily posts
        $dailyPosts = DailyPost::where('date', Carbon::parse()
            ->format('Y-m-d'))
            ->with('quote.author')
            ->first();
        // If the number of post is zero
        if (!$dailyPosts) {
            // Create posts and get them
            $dailyPosts = $this->createDailyPosts();
        }
        // Share posts variable with view instance
        $view->with('dailyPosts', $dailyPosts);
    }

    /**
     * Helpers
     *
     */

    private function createDailyPosts()
    {
        // Make empty array to collect all 3 items
        // $dailyPosts = collect([]);
        $quote = Quote::inRandomOrder()->first();
        $term = Term::inRandomOrder()->first();
        $video = Video::inRandomOrder()->first();
        $photo = Photo::inRandomOrder()->first();

        // Create post
        $dailyPosts = DailyPost::create([
            'date' => Carbon::today()->format('Y-m-d'),
            'quote_id' => $quote->id,
            'term_id' => $term->id,
            'video_id' => $video->id,
            'photo_id' => $photo->id,
        ]);

        // Return all posts
        return $dailyPosts->load('quote', 'term', 'video', 'photo', 'quote.author');
    }
}
