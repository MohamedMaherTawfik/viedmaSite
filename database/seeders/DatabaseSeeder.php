<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(schoolSedder::class);
        $this->call(userSeeder::class);
        // $this->call(categoreySeeder::class);
        $this->call(courseSeeder::class);
        $this->call(lessonSeeder::class);
        $this->call(commentSeeder::class);
        // $this->call(GamesCategoreySeeder::class);
        $this->call(GameSeeder::class);
    }
}