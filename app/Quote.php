<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{

    protected $guarded = [];
//    public function tag()
//    {
//        return $this->hasMany(Tag::class);
//    }
//
//    public function author()
//    {
//        return $this->hasOne(Author::class);
//    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
