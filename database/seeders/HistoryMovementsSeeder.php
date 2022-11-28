<?php

namespace Database\Seeders;

use App\Models\Furniture;
use App\Models\RoomType;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HistoryMovementsSeeder extends Seeder
{

    public function run()
    {
        $time = Carbon::now();
        $furnitures = Furniture::all();

        foreach ($furnitures as $furniture) {
            DB::table('furniture_room')->insert([
                'room_id' => RoomType::inRandomOrder()->first()->id,
                'furniture_id' => $furniture->id,
                'in_time' => $time,
                'out_time' => $time->clone()->addHour()
            ]);
            DB::table('furniture_room')->insert([
                'room_id' => RoomType::inRandomOrder()->first()->id,
                'furniture_id' => $furniture->id,
                'in_time' => $time->addHour(),
                'out_time' => null
            ]);
        }

    }
}
