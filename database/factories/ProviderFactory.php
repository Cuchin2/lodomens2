<?php

namespace Database\Factories;

use App\Models\Provider;
use Illuminate\Database\Eloquent\Factories\Factory;


class ProviderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
protected $model= Provider::class;

public function definition()
{
    return[
        'name'=>$this->faker->unique()->word,
        'email' => $this->faker->unique()->safeEmail(),
        'ruc_number'=>$this->faker->unique()->numberBetween($min = 10000000000, $max = 90000000000),
        'address'=>$this->faker->unique()->sentence,
        'phone'=>$this->faker->unique()->numberBetween($min = 900000000, $max = 999999999),
        ];
    }
    };
