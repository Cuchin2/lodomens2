<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class PromotionFactory extends Factory
{

    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'discount_rate' => $this->faker->randomFloat(2, 0, 0.1 ),
            'start_date' => Carbon::now(),
            'ending_date' => Carbon::today()->addDays(rand(1,30)),
        ];
    }
}
