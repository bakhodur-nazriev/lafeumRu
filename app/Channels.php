<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channels extends Model
{
    public function videos()
    {
        return $this->belongsTo(Videos::class);
    }
}
