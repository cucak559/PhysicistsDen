<?php

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddAvatarTest extends TestCase {
      use RefreshDatabase;

      /**
       * A basic test example.
       *
       * @return void
       */
      public function testOnlyMembersCanAddAvatars()
      {
            $this->json('POST' , '/api/users/1/avatar')
                  ->assertStatus(401);
      }

      public function testValidAvatarMustBeProvided()
      {
            $this->signIn();

            $this->json('POST','api/users/'. auth()->id() .'/avatar', [
                        'avatar' => 'not-an-image'
            ])->assertStatus(422);
      }

      public function testUserMayAddAnAvatarToTheirProfile()
      {
            $this->signIn();

            Storage::fake('public');

            $this->json('POST','api/users/'. auth()->id() .'/avatar', [
                  'avatar' => $file = UploadedFile::fake()->image('avatar.jpg')
            ]);

            $this->assertEquals('avatars/'. $file->hashName(),auth()->user()->avatar_path);

            Storage::disk('public')->assertExists('avatars/'. $file->hashName());
      }
}
