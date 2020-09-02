<?php

namespace App;

use ChristianKuri\LaravelFavorite\Traits\Favoriteable;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use Favoriteable;

    protected $fillable = ['body', 'author_id'];

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
}
