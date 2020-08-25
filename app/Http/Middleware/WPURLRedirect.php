<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;

class WPURLRedirect
{
    /**
     * Supported prefixes of wp routes
     *
     * Key is first part of wp route.
     * Value is it's analogue in laravel.
     *
     * @var array
     */
    protected $prefixes = [
        "category" => "",
        "citaty" => "quotes",
        "avtory" => "authors",
        "video" => "videos",
        "kanaly-youtube" => "channels",
        "terminy-kom" => "terms",
        "slovar-lafeum" => "vocabulary",
        "oblasti-znanii" => "knowledge",
        "fotografii" => "photo",
    ];

    /**
     * Supported wp parent categories slug
     *
     * Key is parent category slug at wp.
     * Value is it's analogue in laravel.
     *
     * @var array
     */
    protected $parentCategorySlugs = [
        10 => "tsennosti-i-tseli",
        20 => "tsennosti-i-tseli",
        30 => "tsennosti-i-tseli",
        40 => "tsennosti-i-tseli",

        13 => "obshchestvo",
        23 => "obshchestvo",
        33 => "obshchestvo",
        43 => "obshchestvo",

        14 => "nauka-i-filosofiya",
        24 => "nauka-i-filosofiya",
        34 => "nauka-i-filosofiya",
        44 => "nauka-i-filosofiya",

        15 => "yumor-tematicheskii",

        "filmy-i-serialy" => "",
        "poslovicy-i-pogovorki" => ""
    ];

    /**
     * Supported wp category slug postfixes
     *
     * @var array
     */
    protected $categorySlugPostfix = [
        "-citaty",
        "-video",
        "-terminy-kom",
        "-slovar"
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $currentRoute = $request->getRequestUri();

        $currentRoute = trim($currentRoute, "/");

        if (!$this->isWpRoute($currentRoute)) {
            return $next($request);
        }

        $route = $this->convertWpRoute($currentRoute);

        return redirect($route);
    }

    /**
     * Helpers
     *
     */

    /**
     * Resolves is $route is from wp version of lafeum
     *
     * @param  string  $route
     * @return bool
     */
    private function isWpRoute($route)
    {
        $exploded = explode('/', $route);

        foreach ($this->prefixes as $prefix => $current) {
            if($exploded[0] === $prefix){
                return true;
            }
        }

        return false;
    }

    /**
     * Returns laravel version of $wpRoute
     *
     * @param  string  $wpRoute
     * @return string
     */
    private function convertWpRoute($wpRoute)
    {
        $convertedPrefix = $this->convertPrefix($wpRoute);

        $converted = $this->convertPostfix($convertedPrefix);

        $converted = $this->convertPagination($converted);

        return $converted;
    }

    /**
     * Converts first part part of wp route to laravel version
     *
     * @param  string  $wpRoute
     * @return string
     */
    private function convertPrefix($wpRoute)
    {
        $exploded = explode("/", $wpRoute);

        $wpPrefix = $exploded[0];

        $currentPrefix = $this->prefixes[$wpPrefix];

        $exploded[0] = $currentPrefix;

        return implode("/", $exploded);
    }

    /**
     * Converts second and third parts of wp route to laravel version
     *
     * @param  string  $wpRoute
     * @return string
     */
    private function convertPostfix($wpRoute)
    {
        $exploded = explode("/", $wpRoute);

        if (count($exploded) == 1) {
            return $wpRoute;
        }

        $secondPart = $exploded[1];

        $thirdPart = count($exploded) >= 3 ? $exploded[2] : null;

        $shoudConvertSecondPart = array_key_exists($secondPart, $this->parentCategorySlugs);

        if ($shoudConvertSecondPart  && !$thirdPart) {
            $secondPart = $this->parentCategorySlugs[$secondPart];
        } else if ($shoudConvertSecondPart && $thirdPart) {

            $secondPart = $this->removeWpCategoryPostfix($thirdPart);
            $thirdPart = "";
        }

        $exploded[1] = $secondPart;
        $exploded[2] = $thirdPart;

        return implode("/", $exploded);
    }

    /**
     * Removes wp category slug's postfix
     *
     * @param  string  $wpCategory
     * @return string
     */
    private function removeWpCategoryPostfix($wpCategory)
    {
        foreach ($this->categorySlugPostfix as $postfix) {
            $wpCategory = str_replace($postfix, "", $wpCategory);
        }

        return $wpCategory;
    }

    /**
     * Converts wp pagination to laravel pagination
     *
     * @param  string  $wpRoute
     * @return string
     */
    private function convertPagination($wpRoute)
    {
        $exploded = explode('/', $wpRoute);

        $pageNumber = null;

        for ($i = 0; $i < count($exploded); $i++) {

            $isLastPart = $i === count($exploded) - 1;

            if ($exploded[$i] == 'page' && !$isLastPart) {
                $pageNumber = $exploded[$i + 1];

                unset($exploded[$i]);
                unset($exploded[$i + 1]);

                break;
            }
        }

        $route = implode('/', $exploded);

        if ($pageNumber) {
            $route .= ("?page=" . $pageNumber);
        }

        return $route;
    }
}
