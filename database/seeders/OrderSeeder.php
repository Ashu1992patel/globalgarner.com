<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 100) as $index) {
            $product = Product::inRandomOrder()->first();
            Order::create([
                'user_id' => User::inRandomOrder()->where('role_id', 1)->first()->id,
                'product_id' => $product->id,
                'price' => $product->price,
                'discount' => rand(5, 20),
                'status_id' => Status::inRandomOrder()->first()->id,
                'billing_address' => $faker->address(2),
                'shipping_address' => $faker->address(2),
            ]);
        }
    }
}
