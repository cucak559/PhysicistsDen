<?php

namespace App;

use App\Notifications\ArticleWasUpdated;
use Illuminate\Database\Eloquent\Model;

class ArticleWatcher extends Model {
      protected $guarded = [];

      public function user()
      {
            return $this->belongsTo(User::class);
      }

      public function article()
      {
            return $this->belongsTo(Article::class);
      }

      public function notify($comment)
      {
            $this->user->notify(new ArticleWasUpdated($this->article , $comment));
      }
}
