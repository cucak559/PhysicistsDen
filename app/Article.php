<?php

namespace App;


use App\Events\ArticleHasNewComment;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentTaggable\Taggable;

class Article extends Model {
      use Taggable;
      use RecordsActivity;

      use Favouritable;
      use Likeable;
      use Dislikeable;

      protected $guarded = [];

      protected $with = ['favourites'];

      protected $appends = ['isFavourited' , 'isLiked' , 'isDisliked' , 'isWatched'];


      protected static function boot()
      {
            parent::boot();

            static::deleting(function ($model)
            {
                  $model->comments->each->delete();
            });
      }

      //Watching

      public function watchers()
      {
            return $this->hasMany(ArticleWatcher::class);
      }

      public function isWatched()
      {
            return $this->watchers()->where(['user_id' => auth()->id()])->exists();
      }


      public function getIsWatchedAttribute()
      {
            return $this->isWatched();
      }


      public function watch($userId = null)
      {
            if ( ! $this->isWatched())
            {
                  $this->watchers()->create([
                        'user_id' => $userId ?: auth()->id()
                  ]);
            }
      }

      public function unwatch($userId = null)
      {
            $this->watchers()
                  ->where(['user_id' => $userId ?: auth()->id()])
                  ->delete();
      }

      public function hasUpdatesFor(){
            if ($this->isWatched()){
                  $key = sprintf("users.%s.visits.%s",auth()->id(),$this->id);
                  return $this->updated_at > cache($key);
            }
      }

      //Relationships
      public function user()
      {
            return $this->belongsTo(User::class);
      }

      public function topic()
      {
            return $this->belongsTo(Topic::class);
      }

      public function comments()
      {
            return $this->morphMany('App\Comment' , 'commentable');
      }

      public function comment($comment)
      {

            $comment = $this->comments()->create($comment);

            event(new ArticleHasNewComment($this,$comment));

            return $comment;
      }



      //---SearchAndFilters---
      public function scopeSearch($query , $s)
      {
            $ids = [0];
            foreach (auth()->user()->groups as $group)
            {
                  $ids[] = $group->id;
            }

            return $query->where("title" , "like" , "%" . $s . "%")->whereIn('group_id' , $ids);
      }

      public function scopeArchive($query , $filters)
      {

            if (isset($filters['month']))
            {
                  if ($month = $filters['month'])
                  {
                        $query->whereMonth('created_at' , Carbon::parse($month)->month);
                  }
            }

            if (isset($filters['year']))
            {
                  if ($year = $filters['year'])
                  {
                        $query->whereYear('created_at' , $year);
                  }
            }
      }

      public function scopeFilter($query , $filters)
      {
            return $filters->apply($query);
      }

      public static function archives()
      {
            return static::selectRaw("year(created_at) year,monthname(created_at) month,count(*) published")
                  ->groupBy("year" , "month")
                  ->orderByRaw("min(created_at)" , "desc")
                  ->get()
                  ->toArray();
      }
}
