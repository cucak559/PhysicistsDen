<?php

namespace Tests\Unit;

use App\Comment;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentTest extends TestCase {
      use RefreshDatabase;

      /**
       * A basic test example.
       *
       * @return void
       */
      public function testCommentHasUser()
      {
            $comment = create('App\Comment');
            $this->assertInstanceOf('App\User' , $comment->user);
    }

      public function testCommentKnowsIfItWasJustPublished()
      {
            $comment = create('App\Comment');

            $this->assertTrue($comment->wasJustPublished());

            $comment->created_at = Carbon::now()->subMonth();

            $this->assertFalse($comment->wasJustPublished());

      }

      public function testCommentKnowsAllMentionedUsersInTheBody()
      {
            $comment = new Comment([
                  'body' => '@JaneDoe wants to talk to @JohnDoe'
            ]);

            $this->assertEquals(['JaneDoe','JohnDoe'],$comment->mentionedUsers());

      }

      public function itWrapsMentionedUsersWithinAnchorTags()
      {
            $comment = new Comment([
                  'body' => 'Hello @Jane-Doe.'
            ]);

            $this->assertEquals(
                  'Hello <a href="/user/Jane-Doe">@Jane-Doe</a>',
                  $comment->body
            );

      }
}
