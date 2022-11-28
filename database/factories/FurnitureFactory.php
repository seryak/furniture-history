<?php

namespace Database\Factories;

use App\Models\Furniture;
use App\Models\FurnitureType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Furniture>
 */
class FurnitureFactory extends Factory
{
    protected $model = Furniture::class;

    public function definition()
    {
        $colors = ['Красный', 'Желтый', 'Синий', 'Зеленый', 'Белый', 'Черный'];
        $materials = ['железный', 'деревянный', 'пластиковый', 'керамический', 'кожаный'];
        $furnitureType = FurnitureType::inRandomOrder()->first();

        $titleString = $colors[array_rand($colors)].' '.$materials[array_rand($materials)].' '.mb_strtolower($furnitureType->title);

        return [
            'title' => $titleString,
            'article_number' => Str::random(12),
            'furniture_type_id' => $furnitureType->id,
        ];
    }
}
