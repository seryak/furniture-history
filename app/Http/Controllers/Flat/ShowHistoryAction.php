<?php


namespace App\Http\Controllers\Flat;

use App\Http\Controllers\Controller;
use App\Services\SearchService;


class ShowHistoryAction extends Controller
{
    public function __invoke(int $flat_id, SearchService $search)
    {
        $search->searchAllFurnitureByFlat($flat_id);

        return $search->results;
    }
}
