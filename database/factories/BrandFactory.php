<?php

namespace Database\Factories;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{
   
    public function definition()
    {   $name= $this->faker->unique()->word();
        return [
            'name' => $name,
            'slug' => Str::slug(substr($name, 0, 2)),
            'description' => $this-> faker->sentence($nbWords= 6, $variableNBWords =true),
        ];
    }
}
