<?php

namespace Database\Seeders;

use App\Models\ShortUrl;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Str;

class ShortUrlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 50; $i++) {

            ShortUrl::create([
                'long_url'  => 'https://example' . $i . '.com',
                'short_url' => Str::random(7),
                'user_id'   => rand(2, 10),
                'hits' => rand(1, 80),
            ]);
        }
    }
}
