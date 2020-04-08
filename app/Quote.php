<?php

namespace App;

use ChristianKuri\LaravelFavorite\Models\Favorite;
use ChristianKuri\LaravelFavorite\Traits\Favoriteable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Quote extends Model
{

    use Favoriteable;

    protected $fillable = ['body', 'author_id'];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function categories()
    {
        return $this->morphToMany(Category::class, 'categoriable');
    }

    /*public function favorites()
     {
         return $this->morphToMany(Favorite::class, 'favoriteable');
     }*/

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
