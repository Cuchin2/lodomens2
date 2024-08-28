<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'name' => 'dolares',
            'description' => 'tipo de cambio actual',
            'action' => 3.75,
        ]);
        Setting::create([
            'name' => 'time',
            'description' => 'tiempo de slider',
            'action' => 5000,
        ]);
    }
}
