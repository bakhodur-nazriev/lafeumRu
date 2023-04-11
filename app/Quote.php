<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Quote extends Model
{
    use SoftDeletes;
    use PublishableTrait;

    protected $fillable = ["body", "author_id", "publish_at", "deleted_at", "authors_thoughts"];

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function categories(): MorphToMany
    {
        return $this->morphToMany(Category::class, "categoriable");
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function post(): MorphOne
    {
        return $this->morphOne(Post::class, "postable");
    }

    public function dailyPosts(): HasMany
    {
        return $this->hasMany(DailyPost::class);
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
