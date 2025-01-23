<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Tweet;
use Tests\TestCase;

class UserTest extends TestCase
{
    /** @test */
    public function a_user_can_have_many_tweets()
    {
        $user = User::factory()->create();
        Tweet::factory()->count(3)->create(['user_id' => $user->id]);

        $this->assertCount(3, $user->tweets);
    }
}
