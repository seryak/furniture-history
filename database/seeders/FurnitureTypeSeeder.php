<?php

namespace Database\Seeders;

use App\Models\FurnitureType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FurnitureTypeSeeder extends Seeder
{

    protected array $defaultValues = ['Стул', 'Диван', 'Шкаф', 'Кровать', 'Кресло', 'Комод', 'Кухонный гарнитур'];

    public function run()
    {
        DB::transaction(function() {
            foreach ($this->defaultValues as $title) {
                FurnitureType::firstOrCreate(['title' => $title]);
            }
        });
    }
}
