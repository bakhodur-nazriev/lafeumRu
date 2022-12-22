<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface Likeable
{
    public function likes(): MorphMany;

    public function dislike(): MorphMany;
}
