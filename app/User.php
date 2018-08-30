<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
      use Notifiable;

      /**
       * The attributes that are mass assignable.
       *
       * @var array
       */
      protected $fillable = [
            'name' , 'email' , 'password' ,
      ];

      /**
       * The attributes that should be hidden for arrays.
       *
       * @var array
       */
      protected $hidden = [
            'password' , 'remember_token' , 'email'
      ];

      public function topics()
      {
            return $this->hasMany(Topic::class);
      }

      public function groups()
      {
            return $this->belongsToMany(Group::class);
      }

      public function articles()
      {
            return $this->hasMany(Article::class);
      }

      public function favourites()
      {
            return $this->hasMany(Favourite::class);
      }

      public function comments()
      {
            return $this->hasMany(Comment::class);
      }

      public function likes()
      {
            return $this->hasMany(Like::class);
      }

      public function dislikes()
      {
            return $this->hasMany(Dislike::class);
      }

      public function activity()
      {
            return $this->hasMany(Activity::class);
      }

      public function lastComment()
      {
            return $this->hasOne(Comment::class)->latest();
      }

      public function read(Article $article)
      {
            $key = sprintf("users.%s.visits.%s" , auth()->id() , $article->id);
            cache()->forever($key , Carbon::now());
      }


}
