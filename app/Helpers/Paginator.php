<?php

namespace App\Helpers;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;

class Paginator implements Arrayable
{

    const DEFAULT_PAGE = 1;
    const DEFAULT_ITEMS_PER_PAGE = 25;

    private $items;
    private $perPage;
    private $currentPage;

    public function __construct(Collection $items, $perPage, $currentPage)
    {
        $this->items = $items;
        $this->perPage = $perPage ?: self::DEFAULT_ITEMS_PER_PAGE;
        $this->currentPage = $currentPage ?: self::DEFAULT_PAGE;

        if ($perPage == "Все") {
            $this->perPage = $items->count();
        }
    }

    public function toArray()
    {
        return [
            "current_page" => intval($this->currentPage),
            "last_page" => $this->getTotalPages(),
            "per_page" => $this->perPage,
            "total" => $this->items->count(),
            "data" => $this->items->forPage($this->currentPage, $this->perPage)->values()
        ];
    }

    public function getData()
    {
        return $this->items;
    }

    public function setData($data)
    {
        $this->items = $data;
    }

    private function getTotalPages()
    {
        $floatOfTotalPages = $this->items->count() / $this->perPage;

        $totalPages = intval($floatOfTotalPages);

        if ($floatOfTotalPages - $totalPages > 0) {
            $totalPages++;
        }
        return $totalPages;
    }
}
