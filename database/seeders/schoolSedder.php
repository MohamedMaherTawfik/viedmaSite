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
                'name' => 'المدرسه رقم 1',
                'type' => 'مدارس اهليه',
                'License_number' => '123456789',
                'address' => 'العنوان الخاص بالمدرسه رقم 1 في شارع 5121',
                'city' => 'المدينه رقم 1 للمدرسه رقم 1',
                'slug' => 'school-1',
            ],
            [
                'name' => 'المدرسه رقم 2',
                'type' => 'مدارس حكوميه',
                'License_number' => '123456789',
                'address' => 'العنوان الخاص بالمدرسه رقم 1 في شارع 5121',
                'city' => 'المدينه رقم 2 للمدرسه رقم 2',
                'slug' => 'school-2',
            ],
            [
                'name' => 'المدرسه رقم 3',
                'type' => 'مدارس خاصه',
                'License_number' => '123456789',
                'address' => 'العنوان الخاص بالمدرسه رقم 1 في شارع 5121',
                'city' => 'المدينه رقم 1 للمدرسه رقم 1',
                'slug' => 'school-3',
            ],

            [
                'name' => 'المدرسه رقم 4',
                'type' => 'مدارس حكوميه',
                'License_number' => '123456789',
                'address' => 'العنوان الخاص بالمدرسه رقم 1 في شارع 5121',
                'city' => 'المدينه رقم 1 للمدرسه رقم 1',
                'slug' => 'school-4',
            ],
            [
                'name' => 'المدرسه رقم 5',
                'type' => 'مدارس خاصه',
                'License_number' => '123456789',
                'address' => 'العنوان الخاص بالمدرسه رقم 1 في شارع 5121',
                'city' => 'المدينه رقم 1 للمدرسه رقم 1',
                'slug' => 'school-5',
            ]
        ];

        foreach ($schools as $school) {
            school::create($school);
        }
    }
}
