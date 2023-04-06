<?php

namespace App\Http\Controllers;

use App\Quote;
use App\Term;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class LikesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function storeQuote(Quote $quote): RedirectResponse
    {
        $quote->like();
        return back();
    }

    public function destroyQuote(Quote $quote): RedirectResponse
    {
        $quote->unLike();
        return back();
    }

    public function storeTerm(Term $term): RedirectResponse
    {
        $term->like();
        return back();
    }

    public function destroyTerm(Term $term): RedirectResponse
    {
        $term->unLike();
        return back();
    }

    public function storeVideo(Video $video): RedirectResponse
    {
        $video->like();
        return back();
    }

    public function destroyVideo(Video $video): RedirectResponse
    {
        $video->unLike();
        return back();
    }
}
