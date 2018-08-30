<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfilesTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUserHasAProfile(){
      $this->signIn();

      $user = auth()->user();

      $this->get('user/'.$user->id)
            ->assertSee($user->name);
      }

      public function testOnProfileOnlyArticlesAssociatedWithUser(){
      $this->signIn();

      $user = auth()->user();

      create('App\Article',['user_id' => $user->id],3);

      $this->assertCount(3,$user->articles);
      }
}
