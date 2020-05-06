<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use ChristianKuri\LaravelFavorite\Traits\Favoriteable;

class Knowledge extends Model
{
    use Favoriteable;

    protected $table = "knowledge";
    protected $fillable = ["name", "description", "slug"];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function terms()
    {
        return $this->belongsToMany(Term::class, 'knowledge_terms');
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
}
