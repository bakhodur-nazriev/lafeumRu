<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use ChristianKuri\LaravelFavorite\Traits\Favoriteable;

class Photo extends Model
{
    use Favoriteable;
    use PublishableTrait;

    protected $fillable = ['path', 'description', 'publish_at'];

    public function dailyPosts()
    {
        return $this->hasMany(DailyPost::class);
    }

    public function getPublishAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y H:i:s');
    }
}
