<?php

namespace App;

use ChristianKuri\LaravelFavorite\Traits\Favoriteable;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    use Favoriteable;

    protected $fillable = ['name', 'body', 'link', 'show_in_vocabulary'];

    public function categories()
    {
        return $this->morphToMany(Category::class, 'categoriable');
    }

    public function knowledge()
    {
        return $this->belongsToMany(Knowledge::class, 'knowledge_terms');
    }

    public function post()
    {
        return $this->morphOne(Post::class, 'postable');
    }

    public function dailyPosts()
    {
        return $this->hasMany(DailyPost::class);
    }

    public function scopeVocabulary($query)
    {
        return $query->where('name','<>', '')
                ->where('show_in_vocabulary', true)
                ->orderBy('name');
    }
}
