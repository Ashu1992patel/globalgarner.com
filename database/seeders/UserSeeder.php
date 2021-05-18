<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
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
            $user =  User::create([
                'name' => $faker->name(),
                'email' => $faker->email,
                'password' => bcrypt('GlobalGarner@2016'),
                'role_id' => Role::inRandomOrder()->first()->id,
            ]);
        }

        $user =  User::create([
            'name' => 'Vendor',
            'email' => 'vendor@globalgarner.com',
            'password' => bcrypt('GlobalGarner@2016'),
            'role_id' => 3,
        ]);
        $user =  User::create([
            'name' => 'Admin',
            'email' => 'admin@globalgarner.com',
            'password' => bcrypt('GlobalGarner@2016'),
            'role_id' => 2,
        ]);
        $user =  User::create([
            'name' => 'User',
            'email' => 'user@globalgarner.com',
            'password' => bcrypt('GlobalGarner@2016'),
            'role_id' => 1,
        ]);
    }
}
