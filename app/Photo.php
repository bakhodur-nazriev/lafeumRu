<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use ChristianKuri\LaravelFavorite\Traits\Favoriteable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Photo extends Model
{
    use SoftDeletes;
    use Favoriteable;
    use PublishableTrait;

    protected $fillable = ['path', 'description', 'publish_at', 'deleted_at'];

    public function dailyPosts()
    {
        return $this->hasMany(DailyPost::class);
    }

    /*public function getPublishAtAttribute($date)
    {
        return Carbon::parse($date)->format('d/m/Y H:i:s');
    }*/
}
