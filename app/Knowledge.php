<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Knowledge extends Model
{
    use NodeTrait;

    protected $table = "knowledge";
    protected $fillable = ["name", "description", "slug"];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function terms()
    {
        return $this->belongsToMany(Term::class, 'knowledge_terms');
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
}
