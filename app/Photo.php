<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Photo extends Model
{
    use SoftDeletes;
    use PublishableTrait;

    protected $fillable = ['path', 'title', 'description', 'publish_at', 'deleted_at'];

    public function dailyPosts()
    {
        return $this->hasMany(DailyPost::class);
    }

    /*public function getPublishAtAttribute($date)
    {
        return Carbon::parse($date)->format('d/m/Y H:i:s');
    }*/
}
