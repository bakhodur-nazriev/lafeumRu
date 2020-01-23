<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $fillable = ['name', 'description'];

    public function video()
    {
        return $this->hasMany(Video::class);
    }
}
