<?php

namespace App\Observers;

class SluggableObserver
{

    public function saving($model)
    {
        $slug = $model->getOriginal('slug');
        $name = $model->getOriginal('name');

        if((!$slug && $name) || $model->isDirty('name')) {
            $model->slug = generateSlug($model->name);
        }
    }
}
