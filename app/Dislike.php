<?php

namespace App;

use App\RecordsActivity;
use Illuminate\Database\Eloquent\Model;

class Dislike extends Model
{
      use RecordsActivity;

      protected $guarded = [];

      public function dislikeable(){
        return $this->morphTo();
     }

      public function user(){
        return $this->belongsTo(User::class);
    }
}
