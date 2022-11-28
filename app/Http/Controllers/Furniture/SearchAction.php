<?php


namespace App\Http\Controllers\Furniture;

use App\Http\Controllers\Controller;
use App\Http\Requests\FurnitureSearchActionRequest;
use App\Services\SearchService;
use Illuminate\Http\Response;

class SearchAction extends Controller
{
    public function __invoke(FurnitureSearchActionRequest $request, SearchService $search)
    {
        $flat_id = $request->query->get('flat_id');
        $room_id = $request->query->get('room_id');
        $time = $request->query->get('time');

        $search->searchFurnitureByDate($flat_id, $time, $room_id);

        return response($search->results,Response::HTTP_OK);
    }
}
