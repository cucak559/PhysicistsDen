<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class TopicsTest extends TestCase
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

      $this->user = factory('App\User')->create();
      $this->topic = factory('App\Topic')->create();
    }

     public function testTopicConsistsOfArticles()
    {
        $this->signIn();

        $topic = create('App\Topic');
        $article = create('App\Article',['topic_id' => $topic->id]);

        $this->assertTrue($topic->articles->contains($article));
    }

    public function testTopicsAll()
    {
      $this->signIn();

      $this->get('topics/all')
            ->assertSee($this->topic->title);
    }

     public function testArticlesShow()
    {

       $this->signIn();

      $this->get($this->topic->id.'/show')
            ->assertSee($this->topic->title);
    }


     public function testUnautorizedUsersMayNotSeeArticles()
    {
      $this->get('/topics/all')
            ->assertRedirect('/login');
    }

    public function testArticlesByUser()
    {
     $this->signIn();

     $articleByMe = create('App\Article',['user_id' => auth()->id()]);
     $articleNotByMe = create('App\Article');

     $this->get('/user/'.auth()->id())
            ->assertSee($articleByMe->title)
            ->assertDontSee($articleNotByMe->title);
    }
}
