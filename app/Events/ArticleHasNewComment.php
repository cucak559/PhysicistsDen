<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;


class ArticleHasNewComment {
      use Dispatchable , InteractsWithSockets , SerializesModels;
      public $article;
      public $comment;

      /**
       * Create a new event instance.
       *
       * @param $article
       * @param $comment
       */
      public function __construct($article , $comment)
      {
            //
            $this->article = $article;
            $this->comment = $comment;
      }

}
