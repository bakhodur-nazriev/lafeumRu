<?php

namespace App\Http\Controllers;

use App\Helpers\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Spatie\Browsershot\Browsershot;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    const IMAGES_PATH = "/img/";
    const META_IMAGES_PATH = "/img/meta/";

    protected function saveImage($name, $file, $pathFromPublic = self::IMAGES_PATH)
    {
        $extension = $file->extension();
        $filename = $name . "." . $extension;
        $file->move(public_path($pathFromPublic), $filename);
        return $pathFromPublic . $filename;
    }

    protected function generateMetaImage($html, $pathWithFile)
    {
        Browsershot::html($html)
            ->setNodeModulePath(env('NODE_MODULES_PATH'))
            ->setChromePath(env('CHROME_PATH'))
            ->waitUntilNetworkIdle()
            ->windowSize(1200, 628)
            ->save($pathWithFile);
    }

    /**
     * Processes request items for index method: 
     * - Filtering: ?[field]=[value],
     * - Sorting: ?sortBy=[field] and ?sortByDesc=[field],
     * - Pagination: ?page=[number] and ?perPage=[number] and ?no_pagination
     * - Searching: ?search=some -> Query: $query->where($searchFieldName, 'LIKE', "%some%")
     */
    protected function processIndexRequestItems(Request $request, $query, string $searchFieldName = null, bool $withPagination = true)
    {
        $filteredQuery = $this->filterByRequest($request, $query);

        $searchedQuery = $this->searchByRequest($request, $searchFieldName, $filteredQuery);

        $sortedResultCollection = $this->sortByRequest($request, $searchedQuery->get());

        if(!$withPagination || $request->has('no_pagination')) return $sortedResultCollection;

        $paginatedResult = $this->paginateByRequest($request, $sortedResultCollection);

        return $paginatedResult;
    }

    /**
     * Add filters to query from request items, for example:
     * - URL: ?name=John -> Query: $query->where('name', 'John')
     *
     */
    protected function filterByRequest(Request $request, $query)
    {
        if ($request->method() !== 'GET') {
            return $query;
        }

        $tempQuery = clone $query;

        $sampleModel = $tempQuery->first();

        if (!$sampleModel) {
            return $query;
        }

        $modelAttributes = array_keys($sampleModel->getAttributes());
        $requests = $request->all();

        foreach ($requests as $key => $value) {
            
            if ($value && in_array($key, $modelAttributes)) {
                $query = $query->where($key, $value);
            } 
        }

        return $query;
    }

    /**
     * Applies search to query, for example:
     * - URL: ?search=some -> Query: $query->where($searchFieldName, 'LIKE', "%some%")
     * 
     */
    protected function searchByRequest(Request $request, $searchFieldName, $query)
    {
        if(!$searchFieldName || !$request->has('search')){
            return $query;
        }
        
        $key = $request->search;

        return $query->where($searchFieldName, 'LIKE', "%$key%");
    }

    /**
     * Sorts result collection by request items, for example:
     * - URL: ?sortBy=name -> Collection: $result->sortBy('name')
     * - URL: ?sortByDesc=name -> Collection: $result->sortByDesc('name')
     *
     */
    protected function sortByRequest(Request $request, Collection $collection)
    {
        if ($request->has('sortByDesc')) {
            return $collection->sortByDesc($request->sortByDesc)->values();
        }

        if($request->has('sortBy')){
            return $collection->sortBy($request->sortBy)->values();
        }

        return $collection;
    }

    /**
     * Custom paginator to paginate collection by request items: 
     * - ?page=[number]
     * - ?perPage=[number | 'all']
     */
    protected function paginateByRequest(Request $request, Collection $collection)
    {
        return new Paginator($collection, $request->perPage, $request->page);
    }
}
