<?php

namespace Tests\Feature;


use Illuminate\Notifications\DatabaseNotification;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class NotificationsTest extends TestCase {
      use RefreshDatabase;

      public function setUp()
      {
            parent::setUp();

            $this->signIn();
      }

      public function testNotifyOnlyUsersThatAreNotCreators()
      {


            $article = create('App\Article');

            $article->watch();


            $this->assertCount(0 , auth()->user()->notifications);

            $article->comment([
                  'user_id' => auth()->id() ,
                  'body' => 'Body'
            ]);


            $this->assertCount(0 , auth()->user()->fresh()->notifications);

            $article->comment([
                  'user_id' => create('App\User')->id ,
                  'body' => 'Body'
            ]);


            $this->assertCount(1 , auth()->user()->fresh()->notifications);
      }

      public function testUserCanFetchUnreadNotifications()
      {
            create(DatabaseNotification::class);

            $this->assertCount(1 ,
                  $this->getJson('/api/user/notifications')->json()
            );

      }

      public function testUserCanMarkNotificationAsRead()
      {


            create(DatabaseNotification::class);

            $this->assertCount(1 , auth()->user()->unreadNotifications);

            $notificationId = auth()->user()->unreadNotifications->first()->id;

            $this->delete('/api/user/notifications/' . $notificationId);

            $this->assertCount(0 , auth()->user()->fresh()->unreadNotifications);

      }


}
