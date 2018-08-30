<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class LikesTest extends TestCase
{
      use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */

      public function testLikeArticle(){
            $this->signIn();

            $article = create('App\Article');
            $this->post($article->id.'/like');

            $this->assertCount(1,$article->likes);


      }

       public function testLikeOnlyOnce(){
            $this->signIn();

            $article = create('App\Article');

            try{
                   $this->post($article->id.'/like');
                    $this->post($article->id.'/like');
            }catch(\Exception $e){
                  $this->fail('Did not excpect to insert the same record twice');
            }

            $this->assertCount(1,$article->likes);
      }

}
