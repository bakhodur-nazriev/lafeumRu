<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use ChristianKuri\LaravelFavorite\Traits\Favoriteable;

class Photo extends Model
{
    use Favoriteable;

    protected $fillable = ["path", "description", "created_at", "updated_at"];

    public function dailyPosts()
    {
        return $this->hasMany(DailyPost::class);
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }

    public function getUpdatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }
}
