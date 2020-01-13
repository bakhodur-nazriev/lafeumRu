<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{

    protected $fillable = ['body', 'author_id'];

    public function quote()
    {
        return $this->hasMany(Quote::class);
    }
}
