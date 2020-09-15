<?php

namespace App\Listeners;

use App\Events\SlugUpdated;
use App\Services\RedirectService;

class ApplyRedirect
{
    public function __construct(RedirectService $redirectService) {
        $this->redirectService  = $redirectService;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        if($event instanceof SlugUpdated){
            $this->redirectService->applyRedirectOnSlugChange(
                $event->getSluggableModel(),
                $event->getOldSlug(),
                $event->getNewSlug()
            );
        }
    }
    
}
