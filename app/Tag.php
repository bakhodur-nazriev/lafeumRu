<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $guarded = [];

    public function terms()
    {
        return $this->morphedByMany(Term::class, 'taggable');
    }

    public function qoutes()
    {
        return $this->morphedByMany(Quote::class, 'taggable');
    }

    public function videos()
    {
        return $this->morphedByMany(Video::class, 'taggable');
    }
}
