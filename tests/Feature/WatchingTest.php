<?php

namespace Tests\Feature;


use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class WatchingTest extends TestCase {
      use RefreshDatabase;

      public function testCanWatch()
      {
            $this->signIn();

            $article = create('App\Article');

            $article->watch();

            $this->assertCount(1 , $article->watchers);

      }

      public function testUserCanUnwatch()
      {
            $this->signIn();

            $article = create('App\Article');

            $article->watch();

            $this->delete('/articles/show/' . $article->id . '/watch');

            $this->assertCount(0 , $article->watchers);
      }


}
