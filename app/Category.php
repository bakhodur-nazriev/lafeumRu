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

    public function categoriable()
    {
        return $this->morphTo();
    }

    /*public function vocabulary()
    {
        return $this->morphedByMany(Vocabulary::class, 'categoriable');
    }*/
}
