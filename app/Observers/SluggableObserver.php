<?php

namespace App\Observers;

use App\Events\SlugUpdated;

class SluggableObserver
{

    public function saving($model)
    {
        $slug = $model->getOriginal('slug');
        $name = $model->getOriginal('name');
        
        $noSlug = !$slug && !$model->isDirty('slug');

        $nameUpdated = $name && $model->isDirty('name');

        if($noSlug || $nameUpdated) {
            $newSlug = generateSlug($model->name);

            if($nameUpdated){
                event(new SlugUpdated($model, $model->slug, $newSlug));
            }

            $model->slug = $newSlug;
        }
    }
}
