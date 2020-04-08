<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use ChristianKuri\LaravelFavorite\Traits\Favoriteable;

class Knowledge extends Model
{
    use Favoriteable;

    protected $table = "knowledge";
    protected $fillable = ["name", "description", "slug"];

    public function categories()
    {
        return $this->morphMany(Category::class, 'categoriable');
    }

    public function terms()
    {
        return $this->belongsToMany(Term::class, 'knowledge_terms');
    }
}
