<?php

namespace Tests\Feature;


use App\Notifications\ArticleWasUpdated;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class ArticlesTest extends TestCase {
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
            $this->article = factory('App\Article')->create();
      }

      public function testArticlesAll()
      {
            $response = $this->actingAs($this->user)
                  ->get('/articles/all');

            $response->assertSee($this->article->title);
      }

      public function testArticlesShow()
      {
            $response = $this->actingAs($this->user)
                  ->get('/articles/show/' . $this->article->id);

            $response->assertSee($this->article->title);
      }

      public function testUnautorizedUsersMayNotSeeArticles()
      {
            $this->get('/articles/all')
                  ->assertRedirect('/login');
      }

      public function testArticleHasTopic()
      {
            $this->signIn();

            $topic = create('App\Topic');
            $articleInTopic = create('App\Article' , ['topic_id' => $topic->id]);
            $articleNotInTopic = create('App\Article');

            $this->get('/' . $topic->id . '/show')
                  ->assertSee($articleInTopic->title);
            // ->assertDontSee($articleNotInTopic->title);
      }

      public function testArticlesByUser()
      {
            $this->signIn();

            $articleByMe = create('App\Article' , ['user_id' => auth()->id()]);
            $articleNotByMe = create('App\Article');

            $this->get('/user/' . auth()->id())
                  ->assertSee($articleByMe->title)
                  ->assertDontSee($articleNotByMe->title);
      }


      public function testFilterByViews()
      {
            $this->signIn();

            $articleWithOneView = create('App\Article' , ['views' => 1]);
            $articleWithTwoViews = create('App\Article' , ['views' => 2]);
            $articleWithFourViews = create('App\Article' , ['views' => 4]);


            $response = $this->getJson('articles/all?views=1')->json();
            unset($response['data'][0]);

            $this->assertEquals([4 , 2 , 1] , array_column($response['data'] , 'views'));
      }

      public function testFetchAllCommentsFromArticle()
      {
            $this->signIn();

            $article = create('App\Article');
            create('App\Comment' , ['commentable_id' => $article->id] , 2);

            $response = $this->getJson('/articles/show/' . $article->id . '/comments')->json();

            $this->assertCount(2 , $response['data']);
            $this->assertEquals(2 , $response['total']);
      }

      public function testArticleCanBeWatched()
      {
            $this->signIn();

            $article = create('App\Article');

            $article->watch();

            $this->assertEquals(1 , $article->watchers()->where('user_id' , auth()->id())->count());
      }

      public function testArticleCanBeUnwatched()
      {
            $this->signIn();

            $article = create('App\Article');

            $article->watch();
            $article->unwatch();

            $this->assertEquals(0 , $article->watchers()->where('user_id' , auth()->id())->count());
      }

      public function testArticleNotifiesAllWatchersWhenReplyIsAdded()
      {
            $this->signIn();

            $article = create('App\Article');


            Notification::fake();

            $article->watch();

            $article->comment([
                  'user_id' => create('App\User')->id ,
                  'body' => 'Foobar'
            ]);



            Notification::assertSentTo(auth()->user() , ArticleWasUpdated::class);
      }

      public function testArticleCanCheckIfUserReadAllComments()
      {
            $this->signIn();

            $article = create('App\Article');

            $article->watch();

            $article->comment([
                  'user_id' => create('App\User')->id ,
                  'body' => 'Foobar'
            ]);


            $this->assertTrue($article->hasUpdatesFor());


      }


      // public function testDeleteArticle(){
      //       $this->signIn();

      //       $article = create('App\Article',['user_id' => auth()->user()->id]);

      //       $this->json('DELETE','/articles/'.$article->id);

      //       $this->assertDatabaseMissing('articles',$article->toArray());
      // }
      //

}
