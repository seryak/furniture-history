<?php


namespace App\Services;

use App\Models\Furniture;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class FurnitureService
{
    protected Furniture $furniture;

    public function __construct(Furniture $furniture) {
        $this->furniture = $furniture;
    }

    /**
     * Осуществляет перемещение мебели в указанную комнату
     * @param $room_id
     */
    public function moveToRoom($room_id): void
    {
        DB::transaction(function () use ($room_id) {
            $currentRoom = $this->furniture->currentRoom;
            $currentTime = Carbon::now();

            if ($currentRoom) {
                if ($currentRoom->id == $room_id) {
                    throw new \ErrorException('Нельзя перемещать мебель в ту же самую комнату, где она находится сейчас');
                }

                DB::table('furniture_room')->where([
                    'in_time' => $currentRoom->pivot->in_time,
                    'furniture_id' => $currentRoom->pivot->furniture_id,
                    'room_id' => $currentRoom->id
                ])->update(['out_time' => $currentTime]);

                // Данный метод не работает, обновляет все записи связанные с этой комнатой и этой мебелью
                // $this->furniture->currentRoom->pivot->update(['out_time' => Carbon::now()]);
            }

            $this->furniture->rooms()->attach($room_id, ['in_time' => $currentTime]);
        });
    }
}
