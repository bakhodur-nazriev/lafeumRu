<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use stdClass;

trait RelatedEntitiesTrait
{
    /**
     * Returns all related entities
     */
    public function relatedEntities($type = '')
    {
        $currentId = $this->getKey();
        $currentType = get_class($this);

        $baseQuery = DB::table('related_entities')
            ->select('related_id', 'related_type')
            ->where('id', $currentId)
            ->where('type', $currentType);
        
        if($type) {
            $baseQuery->where('related_type', $type);
        }
        
        return $baseQuery->get();
    }

    /**
     * Asociates $models to current model
     */
    public function linkEntities(iterable $models)
    {
        $relations = [];

        foreach ($models as $model) {
            $relations[] = [
                'id' => $this->getKey(),
                'type' => get_class($this),
                'related_id' => $model->getKey(),
                'related_type' => get_class($model)
            ];
        }

        if(!$relations) {
            return;
        }

        DB::table('related_entities')
            ->insert($relations);
    }

    /**
     * Syncronises related entities
     */
    public function syncRelatedEntities(iterable $models)
    {
        $this->unlinkAllEntities();
        $this->linkEntities($models);
    }

    /**
     * Removes relations with $entity
     */
    public function unlinkEntity($entity)
    {
        if($entity instanceof Model) {
            $relatedId = $entity->getKey();
            $relatedType = get_class($entity);
        
        } else if ($entity instanceof stdClass) {
            $relatedId = $entity->related_id;
            $relatedType = $entity->related_type;
        
        } else {
            return;
        }

        DB::table('related_entities')
            ->where('id', $this->getKey())
            ->where('type', get_class($this))
            ->where('related_id', $relatedId)
            ->where('related_type', $relatedType)
            ->delete();
    }

    /**
     * Removes relations with all entities
     */
    public function unlinkAllEntities()
    {
        DB::table('related_entities')
            ->where('id', $this->getKey())
            ->where('type', get_class($this))
            ->delete();
    }
}
