<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ArticleWasUpdated extends Notification {
      use Queueable;

      protected $article;

      protected $comment;

      /**
       * Create a new notification instance.
       *
       * @return void
       */
      public function __construct($article , $commment)
      {
            //
            $this->article = $article;
            $this->comment = $commment;
      }

      /**
       * Get the notification's delivery channels.
       *
       * @param  mixed $notifiable
       * @return array
       */
      public function via($notifiable)
      {
            return ['database'];
      }


      /**
       * Get the array representation of the notification.
       *
       * @param  mixed $notifiable
       * @return array
       */
      public function toArray($notifiable)
      {
            return [
                  'message' => $this->comment->user->name . ' commented ' . $this->article->title ,
                  'link' => '/articles/show/' . $this->article->id
            ];
      }
}
