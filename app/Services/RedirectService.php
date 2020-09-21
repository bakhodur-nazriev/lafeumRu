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

    /**
     * Models and it's related routes
     * 
     * Note: In wildcards ({}) we put model's attribute name.
     */
    private $modelRoutes = [
        Category::class => [
            '/quotes/{slug}',
            '/terms/{slug}',
            '/videos/{slug}',
            '/vocabulary/{slug}'
        ],
        Knowledge::class => [
            '/knowledge-areas/{slug}',
        ],
        Author::class => [
            '/authors/{slug}'
        ],
        Channel::class => [
            '/channels/{slug}',
        ],
        Quote::class => [
            '/{post->id}'
        ],
        Term::class => [
            '/{post->id}'
        ],
        Video::class => [
            '/{post->id}'
        ]
    ];

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

        $routes = $this->modelRoutes[get_class($model)];
        $urls = [];

        foreach ($routes as $route) {
            $urls[] = $this->processRouteWildcards($route, $model);
        }

        return $urls;
    }

    private function processRouteWildcards($wildcardedRoute, $model)
    {
        do {
            $startWildcard = mb_strpos($wildcardedRoute, '{');
            $endWildcard = mb_strpos($wildcardedRoute, '}');

            if(!$startWildcard || !$endWildcard){
                break;
            }

            $attributeName = mb_substr(
                $wildcardedRoute, 
                $startWildcard + 1, 
                ($endWildcard - $startWildcard) - 1
            );
            
            $wildcardValue = $this->getDepthedAttributeValue($model, $attributeName);

            $wildcardedRoute = str_replace('{'.$attributeName.'}', $wildcardValue, $wildcardedRoute);

        } while ($startWildcard !== false && $endWildcard !== false);

        return $wildcardedRoute;
    }

    private function getDepthedAttributeValue($model, $attributeName)
    {
        $attributeNames = explode('->', $attributeName);

        $value = $model->{$attributeNames[0]};

        for ($i = 1; $i < count($attributeNames); $i++) {
            $value = $value->{$attributeNames[$i]};
        }

        return $value;
    }
}