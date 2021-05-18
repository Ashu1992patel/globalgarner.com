<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $statuses =  [
            'Pending',
            'Completed',
            'Shipped',
            'Cancelled',
            'Declined',
            'Refunded',
            'Awaiting Payment',
            'Awaiting Shipment',
            'Awaiting Pickup'
        ];
        foreach ($statuses as $key => $status) {
            Status::create([
                'name' => ucwords($status),
                'slug' => \Illuminate\Support\Str::slug($status, '-'),
                'description' => $faker->paragraph(1),
            ]);
        }
    }
}
