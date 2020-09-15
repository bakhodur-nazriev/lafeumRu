<?php

namespace App\Events;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Events\Dispatchable;

class SlugUpdated
{
    use Dispatchable;

    private $sluggableModel;
    private $oldSlug;
    private $newSlug;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Model $sluggableModel, string $oldSlug, string $newSlug)
    {
        $this->sluggableModel = $sluggableModel;
        $this->oldSlug = $oldSlug;
        $this->newSlug = $newSlug;
    }

    public function getSluggableModel()
    {
        return $this->sluggableModel;
    }

    public function getOldSlug()
    {
        return $this->oldSlug;
    }

    public function getNewSlug()
    {
        return $this->newSlug;
    }
    
}
