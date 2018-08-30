<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserCanCommentTest extends TestCase {
      use RefreshDatabase;

      /**
       * A basic test example.
       *
       * @return void
       */
      public function testUserCanCommentArticle()
      {
            //Sign up
            $this->signIn();

            //Create comment and article
            $article = create('App\Article');
            $comment = make('App\Comment');

            $this->post('/articles/show/' . $article->id . '/comments' , $comment->toArray());
            $this->assertDatabaseHas('comments' , ['body' => $comment->body]);
      }

      public function testUserCanCommentMaxOncePerMinute()
      {
            //Sign up
            $this->signIn();

            //Create comment and article
            $article = create('App\Article');

            $comment = make('App\Comment' , [
                  'body' => 'My simple reply.'
            ]);

            $this->post('/articles/show/' . $article->id . '/comments' , $comment->toArray())
                  ->assertStatus(201);

            $this->post('/articles/show/' . $article->id . '/comments' , $comment->toArray())
                  ->assertStatus(429);

      }

//      public function testCommentMustHaveBody()
//      {
//            $this->expectException('Exception');
//
//            $this->publishComment(['body' => null]);
//      }


      //  public function testUserCanUpdateComment(){
      //   $this->signIn();

      //   $user = create('App\User');

      //   $comment = create('App\Comment',['user_id' => $user->id]);

      //   $updatedComment = 'Changed Comment';

      //   $this->patch("/comments/{$comment->id}/update",['body' => $updatedComment]);

      //   $this->assertDatabaseHas('comments',['id' => $comment->id , 'body' => $updatedComment]);
      // }


      public function publishComment($overrides = [])
      {
            //Sign up
            $this->signIn();

            //Create Article
            $article = create('App\Article');

            //Create comment
            $comment = make('App\Comment' , $overrides);

            //Post comment on article
            return $this->post('/articles/show/' . $article->id . '/comments' , $comment->toArray());
      }


}
