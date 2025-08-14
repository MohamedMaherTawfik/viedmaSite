<?php

namespace Database\Seeders;

use App\Models\games;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $platforms = ['Steam', 'Epic Games', 'Origin'];
        $categories = [1, 2, 3]; // حط IDات حقيقية من جدول games_categories

        foreach (range(1, 10) as $i) {
            games::create([
                'user_id' => 1,
                'title' => "Game Title $i",
                'description' => "This is a description for game $i.",
                'price' => rand(50, 300),
                'discount' => rand(0, 50),
                'release_date' => Carbon::now()->subDays(rand(10, 100)),
                'developer_name' => "Dev Studio $i",
                'cover_image' => "games/game.png",
                'platform' => $platforms[array_rand($platforms)],
                'trailer_url' => "https://example.com/trailer/$i",
                'stock' => rand(10, 100),
                'is_active' => true,
                'slug' => Str::slug("Game Title $i"),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
