<?php


namespace App\Http\Controllers\Furniture;

use App\Http\Controllers\Controller;
use App\Services\SearchService;
use Illuminate\Http\Request;

class SearchAction extends Controller
{
    public function __invoke(Request $request, SearchService $search)
    {
        $flat_id = $request->query->get('flat_id');
        $room_id = $request->query->get('room_id');
        $time = $request->query->get('time');

        $search->searchFurnitureByDate($flat_id, $time, $room_id);
        return $search->results;
    }
}
