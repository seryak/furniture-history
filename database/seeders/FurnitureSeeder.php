<?php

namespace Database\Seeders;

use App\Models\Furniture;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FurnitureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Furniture::factory()->count(50)->create();
    }
}
