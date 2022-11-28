<?php


namespace App\Http\Controllers\Flat;


use App\Http\Controllers\Controller;
use App\Models\Flat;
use App\Services\SearchService;
use Illuminate\Http\Request;


class ShowHistoryAction extends Controller
{
    public function __invoke(int $flat_id, SearchService $search)
    {
        $search->searchAllFurnitureByFlat($flat_id);

        return $search->results;
    }
}
