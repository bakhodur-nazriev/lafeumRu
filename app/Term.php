<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    protected $fillable = ['name','body'];

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
