<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $guarded = [];

//    public function video()
//    {
//        return $this->belongsTo(Video::class);
//    }
//
//    public function quote()
//    {
//        return $this->belongsTo(Quote::class);
//    }

    public function qoutes()
    {
        return $this->morphedByMany(Quote::class, 'taggable');
    }

    public function videos()
    {
        return $this->morphedByMany(Video::class, 'taggable');
    }
}
