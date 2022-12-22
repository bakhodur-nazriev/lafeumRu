<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $timestamps = false;
    protected $with = ['postable'];

    public function postable()
    {
        return $this->morphTo();
    }

    public function dailyPostable()
    {
        return $this->morphTo();
    }
}
