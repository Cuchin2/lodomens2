<?php

namespace Database\Seeders;
use App\Models\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [
            ['name' => 'Magenta', 'hex' => '#FF00FF'],
            ['name' => 'Amarillo', 'hex' => '#FFFF00'],
            ['name' => 'Azul', 'hex' => '#0000FF'],
            ['name' => 'Verde', 'hex' => '#00FF00'],
            ['name' => 'Dorado', 'hex' => '#FFD700'],
            ['name' => 'Plateado', 'hex' => '#C0C0C0'],
        ];

        foreach ($colors as $color) {
            Color::create($color);
        }
    }
}
