<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Knowledge extends Model
{
    use NodeTrait;
    use RelatedEntitiesTrait;

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

    public function getLinkedKnowledgeAttribute()
    {
        $relatedEntities = $this->relatedEntities(Knowledge::class);

        return Knowledge::whereIn('id', $relatedEntities->pluck('related_id'))->get(['id', 'name', 'slug']);
    }
}
