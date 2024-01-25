<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserType;
class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserType::create([
            'name' => 'Premium',
            'file' => 'crown1.svg',
            'order' => 1,
        ]);

        UserType::create([
            'name' => 'Seller',
            'file' => 'crown2.svg',
            'order' => 2,
        ]);
        UserType::create([
            'name' => 'normal',
            'file' => 'crown3.svg',
            'order' => 3,
        ]);
    }
}
