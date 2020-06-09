<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use ChristianKuri\LaravelFavorite\Traits\Favoriteable;

class Video extends Model
{
    use Favoriteable;

    protected $fillable = ["title", "channel_id", "link", "duration"];
    protected $appends = ["link", "embeded_link", "thumbnail"];

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function categories()
    {
        return $this->morphToMany(Category::class, 'categoriable');
    }

    public function post()
    {
        return $this->morphOne(Post::class, 'postable');
    }

    public function dailyPosts()
    {
        return $this->hasMany(DailyPost::class);
    }
    public function host()
    {
        return $this->belongsTo(VideoHost::class, 'host_type_id');
    }

    public function setLinkAttribute($value)
    {
        $hostData = $this->getHostData($value);

        $this->attributes['host_type_id'] = $hostData['host_type_id'];
        $this->attributes['host_id'] = $hostData['host_id'];
    }

    public function getLinkAttribute()
    {
        switch ($this->host_type_id) {
            case VideoHost::YOUTUBE_HOST_TYPE_ID:
                return "https://youtu.be/" . $this->host_id;

            default:
                return $this->host_id;
        }
    }

    public function getEmbededLinkAttribute()
    {
        switch ($this->host_type_id) {
            case VideoHost::YOUTUBE_HOST_TYPE_ID:
                return "https://www.youtube.com/embed/" . $this->host_id;

            default:
                return $this->host_id;
        }
    }

    public function getThumbnailAttribute()
    {
        switch ($this->host_type_id) {
            case VideoHost::YOUTUBE_HOST_TYPE_ID:
                return "https://i.ytimg.com/vi/{$this->host_id}/mqdefault.jpg";

            default:
                return null;
        }
    }

    /**
     * Helpers
     * 
     */

    public function getHostData($link)
    {
        $hostData = [
            'host_type_id' => VideoHost::UNKNOWN_HOST_TYPE_ID,
            'host_id' => $link
        ];

        $youtubeId = $this->getYoutubeId($link);

        if($youtubeId){
            $hostData['host_type_id'] = VideoHost::YOUTUBE_HOST_TYPE_ID;
            $hostData['host_id'] = $youtubeId;
        }

        return $hostData;
    }

    private function getYoutubeId($link)
    {
        $youtubeIdRegEx = '/(?:youtube(?:-nocookie)?\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/';

        $pregMatchOutput = [];

        $matched = preg_match($youtubeIdRegEx, $link, $pregMatchOutput);

        if($matched && count($pregMatchOutput) === 2){
            return $pregMatchOutput[1];
        }

        return null;
    }


}
