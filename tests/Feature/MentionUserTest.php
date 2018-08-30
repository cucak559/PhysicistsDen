<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class MentionUserTest extends TestCase {
      use RefreshDatabase;

      public function testUsersMentionedInCommentShouldBeNotified()
      {
            $john = create('App\User' , ['name' => 'JohnDoe']);
            $this->signIn($john);

            $jane = create('App\User' , ['name' => 'JaneDoe']);

            $article = create('App\Article');

            $comment = make('App\Comment' , [
                  'body' => '@JaneDoe look at this... @JohnDoe also.'
            ]);

            $this->post('/articles/show/' . $article->id . '/comments' , $comment->toArray())
                  ->assertStatus(201);

            $this->assertCount(1 , $jane->notifications);
      }

      public function testFetchMentionedUsersStartingWithGivenCharacters()
      {
            create('App\User' , ['name' => 'JaneDoe']);
            create('App\User' , ['name' => 'JohnDoe']);
            create('App\User' , ['name' => 'JohnDoe2']);

            $results = $this->json('GET','api/users',['name' => 'John']);

            $this->assertCount(2,$results->json());
      }
}
