<?php

use App\Quote;
use App\Tag;
use App\Video;
use App\Term;
use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Tag', 20)
            ->create()
            ->each(function ($tag) {
                $tag->qoutes()->attach(Quote::inRandomOrder()->first());
                $tag->videos()->attach(Video::inRandomOrder()->first());
                $tag->terms()->attach(Term::inRandomOrder()->first());
            });
        Quote::find(21)->tags()->attach(Tag::find(10));
        Term::find(21)->tags()->attach(Tag::find(10));
    }
}
