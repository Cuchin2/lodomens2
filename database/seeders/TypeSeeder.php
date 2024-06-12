<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Type::create([
            'name'=>'normal',
            'slug'=>'no',
            'hex'=>'#900D0D',
            'description'=>'producto general',
            'is_default'=>1
        ]);
        Type::create([
            'name'=>'primium',
            'slug'=>'pr',
            'hex'=>'#C37D00',
            'description'=>'producto destacado',
            'is_default'=>0
        ]);
    }
}
