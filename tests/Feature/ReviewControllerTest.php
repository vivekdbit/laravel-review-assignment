<?php

namespace Tests\Feature;

use App\Models\EpisodeReview;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class ReviewControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_all_review_index()
    {
        $response = $this->getJson('api/reviews');

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'episode_id',
                    'review',
                    'rating',
                    'user_id'
                ]
            ]
        ]);
    }

    public function test_single_review_show()
    {
        // Create an episode review for testing
        $episodeReview = EpisodeReview::factory()->create();

        // Send a GET request to the show route
        $response = $this->getJson('/api/reviews/'.$episodeReview->id);

        // Assert the response status code and content
        $response->assertStatus(Response::HTTP_OK);
        $response->assertExactJson([
            'data' => [
                'id' => $episodeReview->id,
                'title' => $episodeReview->title,
                'review' => $episodeReview->review,
                'rating' => $episodeReview->rating,
                'user_id' => $episodeReview->user_id,
                'episode_id' => $episodeReview->episode_id,
            ]
        ]);
    }

}
