<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


trait Dislikeable
{
      protected static function bootDislikeable(){
            static::deleting(function($model){
                  $model->dislikes->each->delete();
            });
      }


      public function dislikes(){
            return $this->morphMany('App\Dislike', 'dislikeable');
      }

      public function unlike(){
            $attributes = ['user_id' => auth()->id()];
            $this->likes()->where($attributes)->get()->each->delete();
      }

      public function isDisliked(){
            return $this->dislikes()->where(['user_id' =>auth()->id()])->exists();
      }

      public function getIsDislikedAttribute(){
            return $this->isDisliked();
      }

      public function dislike(){
            if (! $this->isDisliked()){
                  $this->dislikes()->create(['user_id' =>auth()->id()]);

                  if($this->isLiked()){
                        $this->unlike();
                  }

                  session()->flash('message','Article has been disliked');
            }else{
                  session()->flash('error','Article has already been disliked by you!');
            }
      }
}
