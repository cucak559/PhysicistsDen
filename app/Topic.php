<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;
use App\Article;

class Topic extends Model
{
      use RecordsActivity;

      protected $guarded = [];


      protected static function boot(){
            parent::boot();
       }

      public function user(){
        return $this->belongsTo(User::class);
    }

     public function articles(){
        return $this->hasMany(Article::class);
    }
}
