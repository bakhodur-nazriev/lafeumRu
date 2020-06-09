<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoHost extends Model
{
    const UNKNOWN_HOST_TYPE_ID = 1;
    const YOUTUBE_HOST_TYPE_ID = 2;

    public $timestamps = false;

    public function videos()
    {
        return $this->hasMany(Video::class, 'host_type_id');
    }
}
