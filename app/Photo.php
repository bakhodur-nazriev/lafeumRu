<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use ChristianKuri\LaravelFavorite\Traits\Favoriteable;

class Photo extends Model
{
    use Favoriteable;

    protected $fillable = ["image", "description"];

    public function dailyPost()
    {
        return $this->belongsTo(DailyPost::class);
    }
}
