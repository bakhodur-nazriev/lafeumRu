<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{

    protected $fillable = ["name", "biography", "photo", "author_group_id", "slug"];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }

    public function authorGroup()
    {
        return $this->belongsTo(AuthorGroup::class);
    }

    public function categories()
    {
        return $this->morphMany(Category::class, 'categoriable');
    }

    public function scopePersons($query)
    {
        return $query->where('author_group_id', AuthorGroup::where('name', AuthorGroup::PERSONS_GROUP_NAME)->first()->id);
    }

    public function scopeMovies($query)
    {
        return $query->where('author_group_id', AuthorGroup::where('name', AuthorGroup::MOVIES_GROUP_NAME)->first()->id);
    }

    public function scopeProverbs($query)
    {
        return $query->where('author_group_id', AuthorGroup::where('name', AuthorGroup::PROVERBS_GROUP_NAME)->first()->id);
    }
}
