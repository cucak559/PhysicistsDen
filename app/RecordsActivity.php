<?php

namespace App;

trait RecordsActivity{

        protected static function bootRecordsActivity(){
            static::deleting(function($model){
                  $model->recordActivity('deleted');
                  $model->activity()->delete();
            });

            static::created(function($model){
               $model->recordActivity('created');
            });
        }

        protected function recordActivity($event){
            $this->activity()->create([
                  'type' => $this->getActivityType($event),
                  'user_id' => $this->user->id
            ]);
      }

      protected function activity(){
          return $this->morphMany('App\Activity','subject');
      }

       protected function getActivityType($event){
           $type = strtolower((new \ReflectionClass($this))->getShortName());
           return "{$event}_{$type}";
      }


}



 ?>
