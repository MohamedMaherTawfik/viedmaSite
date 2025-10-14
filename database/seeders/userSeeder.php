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
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}