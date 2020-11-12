<?php

namespace App;

use Carbon\Carbon;
use ChristianKuri\LaravelFavorite\Traits\Favoriteable;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use Favoriteable;
    use PublishableTrait;

    protected $fillable = ['body', 'author_id', 'publish_at'];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function categories()
    {
        return $this->morphToMany(Category::class, 'categoriable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->morphOne(Post::class, 'postable');
    }

    public function dailyPosts()
    {
        return $this->hasMany(DailyPost::class);
    }

    public function getPublishAtAttribute($date)
    {
        return Carbon::createFromFormat("Y-m-d H:i:s", $date)->format("d/m/Y H:i:s");
    }
}
