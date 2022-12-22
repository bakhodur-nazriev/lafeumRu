<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasLikesTrait
{
    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class, 'likeable')->where('is_like', true);
    }

    public function dislikes(): MorphMany
    {
        return $this->morphMany(Like::class, 'likeable')->where('is_like', false);
    }
}
