<?php

use App\Admin;
use App\Patient;
use App\PatientInformation;
use Illuminate\Database\Seeder;

class AccountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $patient = Patient::create([
            'firstname' => 'Juan',
            'middlename' => 'Dela',
            'lastname' => 'Cruz',
            'username' => 'tooshort06',
            'password' => 'christopher',
            'mobile_no' => '09193693499',
        ]);

        PatientInformation::create([
            'patient_id' => $patient->id,
            'nickname' => 'User',
            'birthdate' => '1997-01-06 18:04:00',
            'martial_status' => 'Single',
            'sex' => 'Male',
            'age' => 22,
            'occupation' => 'Programmer',
            'home_address' => 'Tandag City',
        ]);

        $patient = Patient::create([
            'firstname' => 'Eric',
            'middlename' => 'Romina',
            'lastname' => 'Vistal',
            'username' => 'eric',
            'password' => 1234,
            'mobile_no' => '09504156122',
        ]);

        PatientInformation::create([
            'patient_id' => $patient->id,
            'nickname' => 'User',
            'birthdate' => '1997-01-06 18:04:00',
            'martial_status' => 'Single',
            'sex' => 'Male',
            'age' => 22,
            'occupation' => 'Programmer',
            'home_address' => 'Tandag City',
        ]);

        Admin::create([
            'name' => 'Administrator Account',
            'username' => 'admin',
            'password' => 'christopher',
        ]);
    }
}
