<?php

namespace App;

use App\Like;
use App\Contracts\Likeable;
use Illuminate\Database\Eloquent\Model;

class Post extends Model implements Likeable
{
    use Likes;
    
    public $timestamps = false;

    protected $with = ['postable'];

    public function postable()
    {
        return $this->morphTo();
    }

    public function dailyPostable()
    {
        return $this->morphTo();
    }
}
