<?php

namespace Database\Seeders;

use App\Models\RoomType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomTypeSeeder extends Seeder
{

    protected array $defaultValues = ['Гостиная', 'Кухня', 'Спальня', 'Туалет', 'Ванная', 'Балкон'];

    public function run()
    {
        DB::transaction(function() {
            foreach ($this->defaultValues as $title) {
                RoomType::firstOrCreate(['title' => $title]);
            }
        });
    }
}
