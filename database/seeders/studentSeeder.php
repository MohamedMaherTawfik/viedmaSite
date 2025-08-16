<?php

namespace Database\Seeders;

use App\Models\student;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class studentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $parents = User::where('role', 'parent')->pluck('id')->toArray();

        $schoolIds = [1, 2, 3, 4];
        $academicStages = ['Primary', 'Preparatory', 'Secondary'];
        $nationalities = ['Egyptian', 'Sudanese', 'Syrian', 'Other'];

        for ($i = 1; $i <= 50; $i++) {
            student::create([
                'school_id' => $schoolIds[array_rand($schoolIds)],
                'user_id' => $parents[array_rand($parents)],
                'name' => "Student{$i}",
                'national_id' => 'NAT' . str_pad($i, 6, '0', STR_PAD_LEFT), // fake national id
                'nationallity' => $nationalities[array_rand($nationalities)],
                'parent_phone' => '010' . rand(10000000, 99999999),
                'Academic_stage' => $academicStages[array_rand($academicStages)],
                'slug' => Str::slug("student{$i}") . '-' . '#' . time(),
            ]);
        }
    }
}