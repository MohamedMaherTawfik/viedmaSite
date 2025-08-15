<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users =
            [
                [
                    'name' => 'Super Admin',
                    'email' => 'admin@gmail.com',
                    'password' => bcrypt('Viedma11'),
                    'role' => 'super_admin',
                ],
                [
                    'school_id' => 1,
                    'name' => 'Admin',
                    'email' => 'school@gmail.com',
                    'password' => bcrypt('Viedma11'),
                    'role' => 'admin',
                ]
            ];

        foreach ($users as $user) {
            \App\Models\User::create($user);
        }
    }
}
