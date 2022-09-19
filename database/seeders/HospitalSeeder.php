<?php

namespace Database\Seeders;

use App\Models\Hospital;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HospitalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Hospital::create([
            'name' => 'Rumah Sakit A',
            'address' => 'jalan A',
            'email' => fake()->unique()->safeEmail(),
            'phone' => '081000000001',
        ]);
        Hospital::create([
            'name' => 'Rumah Sakit B',
            'address' => 'jalan B',
            'email' => fake()->unique()->safeEmail(),
            'phone' => '081000000002',
        ]);
        Hospital::create([
            'name' => 'Rumah Sakit C',
            'address' => 'jalan C',
            'email' => fake()->unique()->safeEmail(),
            'phone' => '081000000003',
        ]);
    }
}
