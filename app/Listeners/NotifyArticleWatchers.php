<?php

namespace App\Listeners;

use App\Events\ArticleHasNewComment;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyArticleWatchers
{

    /**
     * Handle the event.
     *
     * @param  ArticleHasNewComment  $event
     * @return void
     */
    public function handle(ArticleHasNewComment $event)
    {
          $event->article->watchers
                  ->where('user_id','!=',$event->comment->user_id)
                  ->each
                  ->notify($event->comment);
    }
}
