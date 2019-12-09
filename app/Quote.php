<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    public function tag()
    {
        return $this->hasMany(Tag::class);
    }
}
