<?php

namespace Tests\Unit;

use App\Models\Tweet;
use App\Models\User;
use Tests\TestCase;

class TweetTest extends TestCase
{
    /** @test */
    public function a_tweet_belongs_to_a_user()
    {
        $user = User::factory()->create();
        $tweet = Tweet::factory()->create(['user_id' => $user->id]);

        $this->assertEquals($user->id, $tweet->user->id);
    }
}
