<?php


namespace App\Http\View\Composers;


use App\Author;
use App\Photo;
use App\Quote;
use App\Term;
use App\Video;
use Illuminate\View\View;

class CountItemsComposer
{
    public function compose(View $view)
    {
        $countOfFavoritesQuotes = Quote::get()->count();
        $countOfFavoritesTerms = Term::get()->count();
        $countOfAuthors = Author::get()->count();
        $countOfMediaContent = Photo::count() + Video::count();

        $countItems = [
            'quotes' => $countOfFavoritesQuotes,
            'terms' => $countOfFavoritesTerms,
            'authors' => $countOfAuthors,
            'mediaContent' => $countOfMediaContent
        ];

        $view->with('countItems', $countItems);
    }
}