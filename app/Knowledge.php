<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use ChristianKuri\LaravelFavorite\Traits\Favoriteable;

class Knowledge extends Model
{
    use Favoriteable;
    protected $fillable = ["name", "description", "slug"];

    public function categories()
    {
        return $this->morphMany(Category::class, 'categoriable');
    }
}
