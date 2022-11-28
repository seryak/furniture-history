<?php

namespace Database\Factories;

use App\Models\Flat;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Flat>
 */
class FlatFactory extends Factory
{
    protected $model = Flat::class;

    public function definition()
    {
        $streetNames = ['Кирова', 'Мира', 'Ленина', 'Космонавтов', 'Пушкина', 'Маркса'];
        $addressString = 'ул. '.$streetNames[array_rand($streetNames)].' д. '.random_int(1, 150). ' кв.'.random_int(1, 150);

        return [
            'address' => $addressString,
        ];
    }
}
