<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


trait Likeable
{
      protected static function bootLikeable(){
            static::deleting(function($model){
                  $model->likes->each->delete();
            });
      }

      public function likes(){
            return $this->morphMany('App\Like', 'likeable');
      }

       public function undislike(){
            $attributes = ['user_id' => auth()->id()];
            $this->dislikes()->where($attributes)->get()->each->delete();
      }

      public function isLiked(){
            return $this->likes()->where(['user_id' =>auth()->id()])->exists();
      }

      public function getIsLikedAttribute(){
            return $this->isLiked();
      }

      public function like(){
            if (! $this->isLiked()){
                  $this->likes()->create(['user_id' =>auth()->id()]);

                  if($this->isDisliked()){
                        $this->undislike();
                  }

                  session()->flash('message','Article has been liked');
            }else{
                  session()->flash('error','Article has already been liked by you!');
            }
      }
}
