<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class FavouritesTest extends TestCase
{
      use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */

      public function testFavouriteArticle(){
            $this->signIn();

            $article = create('App\Article');
            $this->post('favourites/'.$article->id);

            $this->get('/favourites')
                  ->assertSee($article->title);

      }

       public function testFavouriteOnlyOnce(){
            $this->signIn();

            $article = create('App\Article');

            try{
                  $this->post('favourites/'.$article->id);
                  $this->post('favourites/'.$article->id);
            }catch(\Exception $e){
                  $this->fail('Did not excpect to insert the same record twice');
            }



            $this->assertCount(1,$article->favourites);


      }

}
