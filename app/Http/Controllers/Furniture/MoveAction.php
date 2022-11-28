<?php


namespace App\Http\Controllers\Furniture;


use App\Http\Controllers\Controller;
use App\Http\Requests\MoveActionRequest;
use App\Models\Furniture;
use App\Services\FurnitureService;
use Illuminate\Http\Response;

class MoveAction extends Controller
{
    public function __invoke(Furniture $furniture, MoveActionRequest $request)
    {
        try {
            $service = new FurnitureService($furniture);
            $service->moveToRoom($request->room_id);
        } catch (\Exception $e) {
            return response(['errors' => $e->getMessage()],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
