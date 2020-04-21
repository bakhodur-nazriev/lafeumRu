<?php

namespace App;

use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use NodeTrait;
    public $timestamps = false;

    protected $guarded = [];

    public function quotes()
    {
        return $this->morphedByMany(Quote::class, 'categoriable');
    }

    public function terms()
    {
        return $this->morphedByMany(Term::class, 'categoriable');
    }

    public function video()
    {
        return $this->morphedByMany(Video::class, 'categoriable');
    }
}
