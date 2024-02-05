<?php

namespace Database\Seeders;

use App\Models\EpisodeReview;
use Database\Factories\EpisodeReviewFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EpisodeReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EpisodeReview::factory()->count(5)->create();
    }
}
