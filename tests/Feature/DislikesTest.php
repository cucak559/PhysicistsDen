<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class DislikesTest extends TestCase
{
      use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */

      public function testDislikeArticle(){
            $this->signIn();

            $article = create('App\Article');
             $this->post($article->id.'/dislike');

            $this->assertCount(1,$article->dislikes);

      }

       public function testDislikeOnlyOnce(){
            $this->signIn();

            $article = create('App\Article');

            try{
                  $this->post($article->id.'/dislike');
                  $this->post($article->id.'/dislike');
            }catch(\Exception $e){
                  $this->fail('Did not excpect to insert the same record twice');
            }

            $this->assertCount(1,$article->dislikes);


      }

}
