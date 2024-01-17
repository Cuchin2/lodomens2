<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'url'=> $this->faker->randomElement([
                'image/lodomens/Producto_1.png',
                'image/lodomens/Producto_2.png',
                'image/lodomens/Producto_3.png',
                'image/lodomens/Producto_4.png',
            ])
        ];
    }
}
