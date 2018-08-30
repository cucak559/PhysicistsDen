<?php

namespace Tests\Unit;

use App\Activity;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActivityTest extends TestCase
{
      use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */

      public function testItRecordsActivityWhenArticleIsCreated()
    {
         $this->recordActivity('article');
    }

    public function testItRecordsActivityWhenCommentIsCreated()
    {
        $this->recordActivity('comment');
    }

     public function testItFetchesFeedForAnyUser()
    {
      $this->signIn();

      //User will create two articles
      create('App\Article',['user_id' => auth()->id()],2);

      //One will be from last week
      auth()->user()->activity()->first()->update(['created_at' => Carbon::now()->subWeek()]);

      //Fetch his feed
      $feed = Activity::feed(auth()->user());

      //Must contain article published now
      $this->assertTrue($feed->keys()->contains(
            Carbon::now()->format('Y-m-d')
      ));

      //Must contain article published week ago
      $this->assertTrue($feed->keys()->contains(
            Carbon::now()->subWeek()->format('Y-m-d')
      ));


    }

    public function recordActivity($name)
   {
      //Sign up
      $this->signIn();

      $model = "App\\".ucfirst($name);

      $sub = create($model,['user_id' => auth()->id()]);


      $this->assertDatabaseHas('activities',[
            'type' => "created_{$name}",
            'user_id' => auth()->user()->id,
            'subject_id' => $sub->id,
            'subject_type' => $model
      ]);

      $activity = Activity::first();

      $this->assertEquals($activity->subject->id,$sub->id);
    }
}
