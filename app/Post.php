<?php

namespace App;

use App\Concerns\Likes;
use App\Contracts\Likeable;
use App\Models\Like;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Post extends Model
{
//    use Likes;

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

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
