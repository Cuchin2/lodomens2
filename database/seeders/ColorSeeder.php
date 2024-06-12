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
            ['name' => 'Magenta', 'hex' => '#FF00FF','code'=> 'MG'],
            ['name' => 'Amarillo', 'hex' => '#FFFF00','code'=>'AM'],
            ['name' => 'Azul', 'hex' => '#0000FF','code'=>'AZ'],
            ['name' => 'Verde', 'hex' => '#00FF00','code'=>'VR'],
            ['name' => 'Dorado', 'hex' => '#FFD700','code'=>'DO'],
            ['name' => 'Plateado', 'hex' => '#C0C0C0','code'=>'PT'],
        ];

        foreach ($colors as $color) {
            Color::create($color);
        }
    }
}
