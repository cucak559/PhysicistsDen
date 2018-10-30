<?php

namespace App\Notifications;

use App\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class YouWereMentioned extends Notification {
      use Queueable;

      protected $comment;

      /**
       * Create a new notification instance.
       *
       * @param $comment
       */
      public function __construct(Comment $comment)
      {
            $this->comment = $comment;
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
                  'message' => $this->comment->user->name . ' mentioned you in ' . $this->comment->commentable->title ,
                  'link' => '/articles/show/' . $this->comment->commentable->id
            ];
      }
}
