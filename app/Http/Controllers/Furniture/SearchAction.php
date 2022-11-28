<?php


namespace App\Http\Controllers\Furniture;

use App\Http\Controllers\Controller;
use App\Http\Requests\FurnitureSearchActionRequest;
use App\Http\Responses\SearchResponse;
use App\Services\SearchService;
use Illuminate\Http\Response;

class SearchAction extends Controller
{
    public function __invoke(FurnitureSearchActionRequest $request, SearchService $search, SearchResponse $response)
    {
        $flat_id = $request->query->get('flat_id');
        $room_id = $request->query->get('room_id');
        $time = $request->query->get('time');

        $search->searchFurnitureByDate($flat_id, $time, $room_id);

        $response->setResults($search->results);
        return $response;
    }
}
