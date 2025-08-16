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
        $schools = [
            [
                'name' => 'School 1',
                'type' => 'اهليه',
                'License_number' => '123456789',
                'address' => 'Address 1',
                'city' => 'City 1',
                'slug' => 'school-1',
            ],
            [
                'name' => 'School 2',
                'type' => 'اهليه',
                'License_number' => '123456789',
                'address' => 'Address 2',
                'city' => 'City 2',
                'slug' => 'school-2',
            ],
            [
                'name' => 'School 3',
                'type' => 'اهليه',
                'License_number' => '123456789',
                'address' => 'Address 3',
                'city' => 'City 3',
                'slug' => 'school-3',
            ],

            [
                'name' => 'School 4',
                'type' => 'اهليه',
                'License_number' => '123456789',
                'address' => 'Address 4',
                'city' => 'City 4',
                'slug' => 'school-4',
            ],
            [
                'name' => 'School 5',
                'type' => 'اهليه',
                'License_number' => '123456789',
                'address' => 'Address 5',
                'city' => 'City 5',
                'slug' => 'school-5',
            ]
        ];

        foreach ($schools as $school) {
            school::create($school);
        }
    }
}
