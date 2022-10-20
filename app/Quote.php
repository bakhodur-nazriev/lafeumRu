<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Maize\Markable\Markable;
use Maize\Markable\Models\Like;

class Quote extends Model
{
    use Markable;
    use SoftDeletes;
    use PublishableTrait;

    protected static $marks = [Like::class];
    protected $fillable = ["body", "author_id", "publish_at", "deleted_at", "authors_thoughts"];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function categories()
    {
        return $this->morphToMany(Category::class, "categoriable");
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->morphOne(Post::class, "postable");
    }

    public function dailyPosts()
    {
        return $this->hasMany(DailyPost::class);
    }
}
