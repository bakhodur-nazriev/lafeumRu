<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ["title", "channel_id", "link", "duration"];

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }
//
//    public function tag()
//    {
//        return $this->hasMany(Tag::class);
//    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function categories()
    {
        return $this->morphToMany(Category::class, 'categoriable');
    }

}
