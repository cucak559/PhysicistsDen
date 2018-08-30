<?php

namespace App;

use App\RecordsActivity;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model {
      use RecordsActivity;

      protected $guarded = [];

      protected $with = ['user'];

      protected static function boot()
      {
            parent::boot();
      }

      public function user()
      {
            return $this->belongsTo(User::class);
      }


      public function commentable()
      {
            return $this->morphTo();
      }

      public function mentionedUsers()
      {
            preg_match_all('/@([\w\-]+)/' , $this->body , $matches);
            return $matches[1];
      }

      public function wasJustPublished(){
            return $this->created_at->gt(Carbon::now()->subMinute());
      }

      public function setBodyAttribute($body){
            $this->attributes['body'] = preg_replace('/@([\w\-]+)/','<a href="/$1"> $0 </a>',$body);
      }

}
