<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use ChristianKuri\LaravelFavorite\Traits\Favoriteable;

class Channel extends Model
{
    use Favoriteable;
    protected $fillable = ['name', 'description'];

    public function videos()
    {
        return $this->hasMany(Video::class);
    }
}
