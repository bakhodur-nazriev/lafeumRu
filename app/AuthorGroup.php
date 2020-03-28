<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuthorGroup extends Model
{
    public $timestamps = false;
    protected $fillable = ["name"];

    public function authors()
    {
        return $this->hasMany(Author::class);
    }
}
