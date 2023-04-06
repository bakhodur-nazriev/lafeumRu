<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Favorite extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function quotes(): HasMany
    {
        return $this->hasMany(Quote::class, 'id', 'favorited_id');
    }

    public function terms(): HasMany
    {
        return $this->hasMany(Term::class, 'id', 'favorited_id');
    }

    public function videos(): HasMany
    {
        return $this->hasMany(Video::class, 'id', 'favorited_id');
    }
}
