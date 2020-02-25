<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use ChristianKuri\LaravelFavorite\Traits\Favoriteable;

class Knowledge extends Model
{
    use Favoriteable;
    protected $fillable = ['name', 'description'];

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
