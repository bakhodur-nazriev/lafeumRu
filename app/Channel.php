<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use ChristianKuri\LaravelFavorite\Traits\Favoriteable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Channel extends Model
{
    use SoftDeletes;
    use Favoriteable;

    protected $fillable = ["name", "description", "slug", "deleted_at"];

    public function getRouteKeyName()
    {
        return "slug";
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }
}
