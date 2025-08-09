<?php

namespace Database\Seeders;

use App\Models\school;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class schoolSedder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        school::create([
            'name' => 'School 1',
            'type' => 'اهليه',
            'License_number' => '123456789',
            'address' => 'Address 1',
            'city' => 'City 1',
            'slug' => 'school-1',
        ]);
    }
}
