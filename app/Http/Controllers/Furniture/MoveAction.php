<?php


namespace App\Http\Controllers\Furniture;


use App\Http\Controllers\Controller;
use App\Models\Furniture;
use App\Services\FurnitureService;
use Illuminate\Http\Request;

class MoveAction extends Controller
{
    public function __invoke(Furniture $furniture, Request $request)
    {
        try {
            $service = new FurnitureService($furniture);
            $service->moveToRoom($request->room_id);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
