<?php

namespace Database\Factories;

use App\Models\Flat;
use App\Models\Furniture;
use App\Models\FurnitureType;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    protected $model = Room::class;

    public function definition()
    {
        $roomType = RoomType::inRandomOrder()->first();

        return [
            'title' => $roomType->title,
            'room_type_id' => $roomType->id,
            'flat_id' => Flat::inRandomOrder()->first()->id,
        ];
    }
}
