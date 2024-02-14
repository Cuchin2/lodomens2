<?php

namespace Database\Seeders;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Image;
use App\Models\Promotion;
use App\Models\Provider;
use App\Models\Tag;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Category::factory(10)->create();
        Brand::factory(8)->create();
        Provider::factory(10)->create();
        Tag::factory(10)->create();
        Promotion::factory(20)->create();
        Product::factory(12)->create()->each(function ($product){
            $tagIds = $this->array(rand(1, 10));
            $tagIds = array_slice($tagIds, 0, 4); // Limitar a 4 tags
            $product->tags()->attach($tagIds);
            $product->promotions()->attach($this->array(rand(1, 20)));
            $product->images()->saveMany(Image::factory(4)->make());
        });
        $this->call(UserTypeSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(FooterSeeder::class);

    }
    public function array($max){
        $values =[];
        for ($i=1; $i < $max; $i++) {
            $values[] = $i;
        }
        return $values;
    }
}
