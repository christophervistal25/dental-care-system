<?php

use App\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::create([
            'name' => 'Filling',
            'price' => 600,
            'per_each' => 1,
            'duration' => 1,
        ]);

        Service::create([
            'name' => 'Extraction',
            'price' => 700,
            'per_each' => 1,
            'duration' => 2,
        ]);

        Service::create([
            'name' => 'Cleaning',
            'price' => 800,
            'per_each' => 0,
            'duration' => 3,
        ]);

        Service::create([
            'name' => 'Denture',
            'price' => 600,
            'per_each' => 1,
            'duration' => 4,
        ]);

        Service::create([
            'name' => 'Braces upper',
            'price' => 25000,
            'per_each' => 0,
            'duration' => rand(1, 4),
        ]);

        Service::create([
            'name' => 'Braces lower',
            'price' => 25000,
            'per_each' => 0,
            'duration' => rand(1, 4),
        ]);

    }
}
