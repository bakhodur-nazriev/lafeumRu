<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Maize\Markable\Markable;
use Maize\Markable\Models\Bookmark;
use Maize\Markable\Models\Favorite;
use Maize\Markable\Models\Like;

class Post extends Model
{
    use Markable;

    public $timestamps = false;
    protected $with = ['postable'];
    protected static $marks = [
        Like::class,
        Favorite::class,
        Bookmark::class,
    ];

    public function postable()
    {
        return $this->morphTo();
    }

    public function dailyPostable()
    {
        return $this->morphTo();
    }
}
