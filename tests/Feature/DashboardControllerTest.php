<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_a_tweet_and_redirects_to_dashboard()
    {
        // Arrange: Create a user
        $user = User::factory()->create();

        // Act: Make a POST request as the user
        $response = $this->actingAs($user)->post(route('dashboard.store'), [
            'content' => 'This is a valid tweet!',
        ]);

        // Assert: Check the database and redirection
        $response->assertRedirect(route('dashboard'));
        $this->assertDatabaseHas('tweets', [
            'user_id' => $user->id,
            'content' => 'This is a valid tweet!',
        ]);
    }

    /** @test */
    public function it_fails_to_create_a_tweet_with_invalid_data()
    {
        // Arrange: Create a user
        $user = User::factory()->create();

        // Act: Make a POST request with invalid data (empty content)
        $response = $this->actingAs($user)->post(route('dashboard.store'), [
            'content' => '', // Invalid input
        ]);

        // Assert: Validation errors and no database entry
        $response->assertSessionHasErrors(['content']);
        $this->assertDatabaseCount('tweets', 0); // Ensure no tweets are created
    }
}
