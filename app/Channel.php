<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $guarded = [];

    public function video()
    {
        return $this->hasMany(Video::class);
    }
}
