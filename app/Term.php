<?php

namespace App;

use Carbon\Carbon;
use ChristianKuri\LaravelFavorite\Traits\Favoriteable;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    use Favoriteable;
    use PublishableTrait;

    protected $fillable = [
        'name',
        'body',
        'show_in_vocabulary',
        'term_type_id',
        'publish_at'
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

    public function getPublishAtAttribute($date)
    {
        return Carbon::createFromFormat("Y-m-d H:i:s", $date)->format("d/m/Y");
    }
}
