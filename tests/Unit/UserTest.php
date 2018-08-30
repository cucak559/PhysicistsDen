<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase {
      use RefreshDatabase;

      public function testUserCanFetchMostRecentComment()
      {
            $user = create('App\User');
            $comment = create('App\Comment',['user_id' => $user->id]);

            $this->assertEquals($comment->id,$user->lastComment->id);

      }
}