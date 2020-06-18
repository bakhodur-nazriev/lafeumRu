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

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = generateSlug($value);
    }
}
