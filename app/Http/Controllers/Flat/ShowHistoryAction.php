<?php


namespace App\Http\Controllers\Flat;

use App\Http\Controllers\Controller;
use App\Services\SearchService;
use Illuminate\Http\Response;


class ShowHistoryAction extends Controller
{
    public function __invoke(int $flatId, SearchService $search)
    {
        $search->searchAllFurnitureByFlat($flatId);
        return response($search->results,Response::HTTP_OK);
    }
}
