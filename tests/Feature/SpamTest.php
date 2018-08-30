<?php

namespace Tests\Feature;


use App\Inspections\Spam;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SpamTest extends TestCase {
      use RefreshDatabase;

      public function testSpamValidation(){
            $spam = new Spam();

            $this->assertFalse($spam->detect('Innocent reply here'));

            $this->expectException('Exception');

            $spam->detect('yahoo customer support');
      }


}
