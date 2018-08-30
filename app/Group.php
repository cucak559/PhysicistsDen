<?php

namespace App;

use App\Topic;
use App\Article;
use App\Aplicant;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $guarded = [];

     public function users(){
        return $this->belongsToMany(User::class);
    }

    public function aplicants(){
        return $this->belongsToMany(Aplicant::class);
    }

    public function topics(){
        return $this->hasMany(Topic::class);
    }

    public function articles(){
        return $this->hasMany(Article::class);
    }
}
