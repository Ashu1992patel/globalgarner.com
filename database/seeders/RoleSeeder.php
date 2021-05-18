<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $roles =  ['user', 'admin', 'vendor'];
        foreach ($roles as $key => $role) {
            Role::create([
                'name' => ucwords($role),
                'slug' => \Illuminate\Support\Str::slug($role, '-'),
                'description' => $faker->paragraph(1),
            ]);
        }
    }
}
