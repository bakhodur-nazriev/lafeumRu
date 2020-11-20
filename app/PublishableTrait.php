<?php

namespace App;

use Carbon\Carbon;

trait PublishableTrait
{
    public function scopePublished($query, $sortType = null)
    {
        $query->where('publish_at', '<=', Carbon::now());

        if (!$sortType) {
            return $query;
        }

        return $query->orderBy('publish_at', $sortType);
    }

    public function scopeByPublishAt($query, $sortType = 'desc')
    {
        return $query->orderBy('publish_at', $sortType);
    }
}
