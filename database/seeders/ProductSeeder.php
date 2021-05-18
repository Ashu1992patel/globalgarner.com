<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 500) as $index) {
            Product::create([
                // 'image' => $faker->word,
                // 'image' => 'https://www.google.com/url?sa=i&url=http%3A%2F%2Fwww.ashutec.com%2F&psig=AOvVaw1Giyzfnzv300xigCCxhxZS&ust=1619601716824000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCKC39tuMnvACFQAAAAAdAAAAABAI',
                'image' => 'https://wallpapercave.com/wp/wp2626750.jpg',
                'title' => ucwords($faker->firstname) . ' ' . ucwords($faker->lastname),
                'price' => rand(11, 9999),
                'likes' => rand(10, 999),
                'rating' => rand(1, 5),
                'stock' => array_rand(['true', 'false']),
                'category_id' => Category::inRandomOrder()->first()->id,
                'description' => $faker->paragraph(2),
                'user_id' => User::inRandomOrder()->where('role_id', 3)->first()->id,
            ]);
        }
    }
}
