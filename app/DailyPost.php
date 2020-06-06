<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DailyPost extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    public function quote()
    {
        return $this->belongsTo(Quote::class);
    }

    public function term()
    {
        return $this->belongsTo(Term::class);
    }

    public function video()
    {
        return $this->belongsTo(Video::class);
    }

    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }

}
