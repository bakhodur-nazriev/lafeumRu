<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DailyPost extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }

    public function terms()
    {
        return $this->hasMany(Term::class);
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

}
