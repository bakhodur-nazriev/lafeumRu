<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Knowledge extends Model
{
    protected $fillable = ['name', 'description'];

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
