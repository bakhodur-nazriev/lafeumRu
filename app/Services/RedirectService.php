<?php

namespace App\Services;

use App\Author;
use App\Category;
use App\Channel;
use App\Knowledge;
use App\Quote;
use App\Term;
use App\Video;

class RedirectService
{
    private $htacessService;

    public function __construct(HtaccessService $htacessService) {
        $this->htacessService = $htacessService;
    }

    public function applyRedirectOnSlugChange($model, $oldSlug, $newSlug)
    {
        if($oldSlug == $newSlug){
            return;
        }

        $model->slug = $oldSlug;
        $oldUrls = $this->getModelRelatedUrls($model);

        $model->slug = $newSlug;
        $newUrls = $this->getModelRelatedUrls($model);

        $redirections = $this->getChangedUrls($oldUrls, $newUrls);
        
        foreach ($redirections as $redirection) {
            $this->htacessService->addRedirection(
                $redirection['from'], 
                $redirection['to']
            );
        }
    }

    public function registerModelRemoval($model)
    {
        $urls = $this->getModelRelatedUrls($model);

        foreach ($urls as $url) {
            $this->htacessService->addRedirection($url, null, 410);
        }
    }

    /**
     * Helpers
     * 
     */


    private function getChangedUrls($oldUrls, $newUrls)
    {
        $changedUrls = [];

        foreach ($oldUrls as $i => $oldUrl) {
            if($oldUrl !== $newUrls[$i]){
                $changedUrls[] = [
                    'from' => $oldUrl,
                    'to' => $newUrls[$i]
                ];
            }
        }

        return $changedUrls;
    }

    private function getModelRelatedUrls($model)
    {
        if(!$model) return null;

        $modelClass = get_class($model);

        switch(get_class($model)) {
            case Category::class:
                return $this->getCategoryRelatedLinks($model);
            
            case Knowledge::class:
                return [
                    "/knowledge/$model->slug",
                ];
                
            case Author::class:
                return [
                    "/authors/$model->slug"
                ];
                
            case Channel::class:
                return [
                    "/channels/$model->slug"
                ];
                
            case Quote::class:
            case Term::class:
            case Video::class:
                return [
                    "/{$model->post->id}"
                ];
        }

        return $this->modelRoutes[$modelClass]($model);
    }

    private function getCategoryRelatedLinks(Category $category)
    {
        $slug = $category->slug;
    
        switch($category->type){
            case Quote::class:
                return [
                    "/quotes/$slug"
                ];
            case Term::class:
                return [
                    "/terms/$slug",
                    "/vocabulary/$slug"
                ];
            case Video::class:
                return [
                    "/videos/$slug"
                ];
        }

        return [];
    }
}