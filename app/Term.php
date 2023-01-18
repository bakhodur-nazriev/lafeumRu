<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Term extends Model
{
    use SoftDeletes;
    use PublishableTrait;

    protected $fillable = [
        'name',
        'body',
        'show_in_vocabulary',
        'term_type_id',
        'publish_at',
        'deleted_at'
    ];

    public function categories()
    {
        return $this->morphToMany(Category::class, 'categoriable');
    }

    public function knowledge()
    {
        return $this->belongsToMany(Knowledge::class, 'knowledge_terms');
    }

    public function termType()
    {
        return $this->belongsTo(TermType::class);
    }

    public function post()
    {
        return $this->morphOne(Post::class, 'postable');
    }

    public function dailyPosts()
    {
        return $this->hasMany(DailyPost::class);
    }

    public function scopeVocabulary($query)
    {
        return $query->where('name', '<>', '')
            ->where('show_in_vocabulary', true)
            ->orderBy('name');
    }

    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favorited');
    }
}
