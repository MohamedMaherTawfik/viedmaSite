<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GamesCategoreySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'EPIC GAMES', 'slug' => 'epic-games', 'photo' => 'epic.png'],
            ['name' => 'STEAM GAMES', 'slug' => 'steam-games', 'photo' => 'steam.jpg'],
            ['name' => '3D GAMES', 'slug' => '3d-games', 'photo' => '3d.jpg'],
            ['name' => 'OPEN WORLD GAMES', 'slug' => 'open-world-games', 'photo' => 'openWorld.png'],
        ];

        foreach ($categories as $category) {
            \App\Models\gamesCategorey::create($category);
        }
    }
}