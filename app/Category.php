<?php

namespace App;

use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use NodeTrait;
    public $timestamps = false;

    protected $guarded = [];

    public function parent()
    {
        return $this->belongsTo(self::class);
    }

    public function children()
    {
        return $this->hasMany(self::class);
    }

    public function quote()
    {
        return $this->morphedByMany(Quote::class, 'categoriable');
    }

    public function terms()
    {
        return $this->morphedByMany(Terms::class, 'categoriable');
    }

    public function video()
    {
        return $this->morphedByMany(Video::class, 'categoriable');
    }

//    public function vocabulary()
//    {
//        return $this->morphedByMany(Video::class, 'categoriable');
//    }
}
