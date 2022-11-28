<?php


namespace App\Services;

use App\Models\Flat;
use App\Models\Furniture;
use Illuminate\Support\Facades\DB;

class SearchService
{
    public array $results;

    /**
     * Поиск мебели в комнатах на определенную дату
     * @param int $flat_id
     * @param string $time
     * @param int|null $room_id
     */
    public function searchFurnitureByDate(int $flat_id, string $time, ?int $room_id): void
    {
        $flat = Flat::find($flat_id);
        $rooms_id = $room_id ? [$room_id] : $flat->rooms->pluck('id')->toArray();

        $historyMovementsRecords = DB::table('furniture_room')
            ->whereIn('room_id', $rooms_id)
            ->where('in_time', '<=', $time)
            ->where('out_time', '=', null)
            ->get();

        $furniture_ids = $historyMovementsRecords->pluck('furniture_id')->toArray();

        $furnitures = Furniture::whereIn('id', $furniture_ids)->get()->keyBy('id');

        $this->results['flat'] = ['title' => $flat->address, 'count' => $flat->rooms()->count()];

        foreach ($flat->rooms as $room) {
            $title = $room->title;
            $type = $room->type->title;
            $furnitureItems = [];

            foreach ($historyMovementsRecords->where('room_id', $room->id) as $historyRecord) {
                $furnitureItem = $furnitures[$historyRecord->furniture_id];
                $furnitureItems[] = ['title' => $furnitureItem->title, 'article_number' => $furnitureItem->article_number];
            }

            $this->results['rooms'][] = ['title' => $title, 'type' => $type, 'items' => $furnitureItems];
        }
    }

    /**
     * Поиск всей мебели которая когда либо была в квартире
     * @param int $flat_id
     */
    public function searchAllFurnitureByFlat(int $flat_id): void
    {
        $flat = Flat::find($flat_id);
        $rooms_id = $flat->rooms->pluck('id')->toArray();

        $this->results['flat'] = ['title' => $flat->address, 'count' => $flat->rooms()->count()];

        $this->results['history'] = DB::table('furniture_room')
            ->orderByDesc('in_time')
            ->whereIn('room_id', $rooms_id)
            ->leftJoin('furnitures', function ($join) {
                $join->on('furnitures.id', '=', 'furniture_room.furniture_id');
            })
            ->select('furniture_room.*', 'furnitures.title as furniture_title')
            ->paginate(50);
    }

}
