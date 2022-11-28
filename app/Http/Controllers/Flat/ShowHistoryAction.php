<?php


namespace App\Http\Controllers\Flat;

use App\Http\Controllers\Controller;
use App\Http\Responses\SearchResponse;
use App\Services\SearchService;


class ShowHistoryAction extends Controller
{
    public function __invoke(int $flatId, SearchService $search, SearchResponse $response)
    {
        $search->searchAllFurnitureByFlat($flatId);

        $response->setResults($search->results);
        return $response;
    }
}
