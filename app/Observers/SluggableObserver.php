<?php

namespace App\Observers;

class SluggableObserver
{

    public function saving($model)
    {
        $slug = $model->getOriginal('slug');
        $name = $model->getOriginal('name');
        
        $noSlug = !$slug && !$model->isDirty('slug');

        $nameUpdated = $name && $model->isDirty('name');

        if($noSlug || $nameUpdated) {
            $model->slug = generateSlug($model->name);
        }
    }
}
