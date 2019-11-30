<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Videos extends Model
{
    public function channels()
    {
        return $this->hasMany(Channels::class);
    }

    public function tags()
    {
        return $this->hasMany(Tags::class);
    }
}
