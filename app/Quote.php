<?php

namespace App;

use ChristianKuri\LaravelFavorite\Traits\Favoriteable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quote extends Model
{
    use SoftDeletes;
    use Favoriteable;
    use PublishableTrait;

    protected $fillable = ["body", "author_id", "publish_at", "deleted_at", "authors_thoughts"];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function categories()
    {
        return $this->morphToMany(Category::class, "categoriable");
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->morphOne(Post::class, "postable");
    }

    public function dailyPosts()
    {
        return $this->hasMany(DailyPost::class);
    }
}
