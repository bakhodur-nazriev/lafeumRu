<?php

namespace App;

use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use NodeTrait;

    public $timestamps = false;

    protected $fillable = ['name', 'description', 'type'];
    
    public function quotes()
    {
        return $this->morphedByMany(Quote::class, 'categoriable');
    }

    public function terms()
    {
        return $this->morphedByMany(Term::class, 'categoriable');
    }

    public function video()
    {
        return $this->morphedByMany(Video::class, 'categoriable');
    }

    public function scopeQuote($query)
    {
        return $query->where('type', Quote::class);
    }

    public function scopeTerm($query)
    {
        return $query->where('type', Term::class);
    }

    public function scopeVideo($query)
    {
        return $query->where('type', Video::class);
    }
}
