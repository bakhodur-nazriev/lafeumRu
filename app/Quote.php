<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{

    protected $fillable = ['body', 'author_id'];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
