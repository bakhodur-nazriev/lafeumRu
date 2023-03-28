<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function quotes()
    {
        return $this->hasMany(Quote::class, 'id', 'favorited_id');
    }
}
