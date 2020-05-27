<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DailyPost extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    public function dailyPost()
    {
        return $this->morphMany();
    }
}
