<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use ChristianKuri\LaravelFavorite\Traits\Favoriteable;

class Photo extends Model
{
    use Favoriteable;

    protected $fillable = ['path', 'description', 'publish_at'];

    public function dailyPosts()
    {
        return $this->hasMany(DailyPost::class);
    }
}
