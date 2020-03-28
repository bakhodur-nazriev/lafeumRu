<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{

    protected $fillable = ["name", "biography", "photo", "author_group_id"];

    public function quote()
    {
        return $this->hasMany(Quote::class);
    }

    public function authorGroup()
    {
        return $this->belongsTo(AuthorGroup::class);
    }
}
