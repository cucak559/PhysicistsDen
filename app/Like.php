<?php

namespace App;

use App\RecordsActivity;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{

      protected $guarded = [];

       use RecordsActivity;

      public function likeable(){
        return $this->morphTo();
     }

      public function user(){
        return $this->belongsTo(User::class);
    }
}
