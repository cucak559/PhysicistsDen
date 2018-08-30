<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


trait Favouritable
{
      protected static function bootFavouritable(){
            static::deleting(function($model){
                  $model->favourites->each->delete();
            });
      }


      public function unfavorite(){
            $attributes = ['user_id' => auth()->id()];
            $this->favourites()->where($attributes)->get()->each->delete();
      }

      public function favourites(){
            return $this->morphMany('App\Favourite', 'favouritable');
      }

      public function isFavourited(){
            return $this->favourites()->where(['user_id' =>auth()->id()])->exists();
      }

      public function getIsFavouritedAttribute(){
            return $this->isFavourited();
      }

      public function favourite(){
            if (! $this->isFavourited()){
                  $this->favourites()->create(['user_id' =>auth()->id()]);
                  session()->flash('message','Article added to favourites');
            }else{
                  session()->flash('error','Article has already been added to favourites!');
            }
      }
}
