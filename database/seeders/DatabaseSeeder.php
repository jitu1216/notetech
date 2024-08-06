<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\Student::factory(10)->create();

        // \App\Models\Student::create([
        //     'first_name' => fake()->name(),
        //     'last_name' => fake()->name(),
        //     'gender' => 'Male',
        //     'date_of_birth' => '12/03/2023',
        //     'roll' => '12',
        //     'blood_group' => 'A+',
        //     'religion' => 'Hindu',
        //     'email' => fake()->safeEmail(),
        //     'class' => '8th',
        //     'section' => 'B',
        //     'admission_id' => '12',
        //     'phone_number' => '9125232652',
        //     'upload' => 'sample.jpeg',
        // ]);

        \App\Models\User::create([
            'name' => 'Manoj Kumar',
            'email' => 'manojkumarr380@gmail.com',
            'phone_number' => '9821856824',
            'role_name' => 'Super Admin',
            'password' => bcrypt('Manoj@1234')
        ]);

    }
}
