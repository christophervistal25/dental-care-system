<?php

use App\Doctor;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    public function run()
    {
        $doctors = [
            [
                'firstname' => 'John',
                'middlename' => 'Michael',
                'lastname' => 'Doe',
                'suffix' => 'Jr.',
                'gender' => 'male',
                'birthdate' => '1985-06-15',
                'title' => 'Dentist',
                'image' => 'john-doe.jpg',
                'contact_no' => '555-1234',
                'active' => 'active',
            ],
            [
                'firstname' => 'Jane',
                'middlename' => 'Ann',
                'lastname' => 'Smith',
                'suffix' => null,
                'gender' => 'female',
                'birthdate' => '1990-03-22',
                'title' => 'Orthodontist',
                'image' => 'jane-smith.jpg',
                'contact_no' => '555-5678',
                'active' => 'active',
            ],
        ];

        foreach ($doctors as $doctor) {
            Doctor::create($doctor);
        }
    }
}
