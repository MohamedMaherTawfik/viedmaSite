<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Default users
        $users = [
            [
                'name' => 'Super Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('Viedma11'),
                'role' => 'super_admin',
            ],
            [
                'school_id' => 1,
                'name' => 'مدير المدرسة الاولي',
                'email' => 'school1@gmail.com',
                'password' => bcrypt('Viedma11'),
                'role' => 'admin',
            ],
            [
                'school_id' => 2,
                'name' => 'مدير المدرسة الثانية',
                'email' => 'school2@gmail.com',
                'password' => bcrypt('Viedma11'),
                'role' => 'admin',
            ],
            [
                'school_id' => 3,
                'name' => 'مدير المدرسة الثالثة',
                'email' => 'school3@gmail.com',
                'password' => bcrypt('Viedma11'),
                'role' => 'admin',
            ],
            [
                'school_id' => 4,
                'name' => 'مدير المدرسة الرابعة',
                'email' => 'school4@gmail.com',
                'password' => bcrypt('Viedma11'),
                'role' => 'admin',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }

        // Extra 100 users
        $roles = ['teacher', 'trainer', 'parent'];
        $schoolIds = [1, 2, 3, 4];

        for ($i = 1; $i <= 100; $i++) {
            User::create([
                'school_id' => $schoolIds[array_rand($schoolIds)],
                'name' => "User{$i}",
                'email' => "user{$i}@gmail.com",
                'password' => bcrypt('Viedma11'),
                'role' => $roles[array_rand($roles)],
            ]);
        }


    }
}