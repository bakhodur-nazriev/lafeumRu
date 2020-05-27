<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use ChristianKuri\LaravelFavorite\Traits\Favoriteable;

class Video extends Model
{
    use Favoriteable;

    protected $fillable = ["title", "channel_id", "link", "duration"];

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function categories()
    {
        return $this->morphToMany(Category::class, 'categoriable');
    }

    public function post()
    {
        return $this->morphOne(Post::class, 'postable');
    }

    public function dailyPost()
    {
        return $this->hasMany(DailyPost::class);
    }
}
