<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code'=>$this->faker->ean8,
            'name'=>$this->faker->unique()->word,
            'slug'=>$this->faker->unique()->slug,
            'stock'=>150, /* $this->faker->buildingNumber */
            'short_description'=>$this->faker->realText($maxNbChars= 360, $indexSize =2),
            'body'=>$this->faker->sentence($nbWords= 6, $variableNBWords =true),
            'sell_price'=>$this->faker->randomNumber(2),
            'views'=>0,
            'status'=>'BOTH',
            'brand_id'=>rand(1,8),
            'category_id'=>rand(1,10),
            'provider_id'=>rand(1,10),
        ];
    }
}
