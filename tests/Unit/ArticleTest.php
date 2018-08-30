<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleTest extends TestCase
{
      use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */

       public function setUp()
    {
      parent::setUp();
      $this->article = factory('App\Article')->create();
    }

     public function testArticleHasComment()
    {
          $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection' ,$this->article->comments);
    }

     public function testArticleHasUser()
    {
        $this->assertInstanceOf('App\User',$this->article->user);
    }

      public function testArticleHasTopic()
    {
        $this->assertInstanceOf('App\Topic',$this->article->topic);
    }
}
