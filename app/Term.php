<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
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

    public function categories(): MorphToMany
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

    public function favorites(): MorphMany
    {
        return $this->morphMany(Favorite::class, 'favorited');
    }

    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class, 'liked');
    }

    public function like()
    {
        $attributes = ['user_id' => auth()->id()];

        if (!$this->likes()->where($attributes)->exists()) {
            return $this->likes()->create($attributes);
        }
    }

    public function unLike()
    {
        $attributes = ['user_id' => auth()->id()];

        if ($this->likes()->where($attributes)->exists()) {
            return $this->likes()->delete($attributes);
        }
    }

    public function favorite()
    {
        $attributes = ['user_id' => auth()->id()];

        if (!$this->favorites()->where($attributes)->exists()) {
            return $this->favorites()->create($attributes);
        }
    }

    public function unFavorite()
    {
        $attributes = ['user_id' => auth()->id()];

        if ($this->favorites()->where($attributes)->exists()) {
            return $this->favorites()->delete($attributes);
        }
    }
}
