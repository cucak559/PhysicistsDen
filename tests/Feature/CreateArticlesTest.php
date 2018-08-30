<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateArticlesTest extends TestCase
{
       use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAuthenticatedUserCanCreateArticle()
    {
       //Sign up
      $this->signIn();

      //Create article
      $article = factory('App\Article')->create();

     //Post article
      $this->post('/'.$article->topic->id.'/articles/store',$article->toArray());

      //Show article
      $this->get('/articles/show/'.$article->id)
            ->assertSee($article->body);
    }

     public function testTitleCantBeNull()
    {
      $this->publishArticle(['title' => null])
            ->assertSessionHasErrors('title');
    }

     public function testDescriptionCantBeNull()
    {
      $this->publishArticle(['description' => null])
            ->assertSessionHasErrors('description');
    }

     public function testBodyCantBeNull()
    {
      $this->publishArticle(['body' => null])
            ->assertSessionHasErrors('body');
    }



    public function publishArticle($overrides = [])
   {
      //Sign up
      $this->signIn();

      //Create article
      $article = make('App\Article',$overrides);

     //Post article
      return $this->post('/'.$article->topic->id.'/articles/store',$article->toArray());
    }


}
