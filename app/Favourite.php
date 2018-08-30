<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use App\RecordsActivity;

class Favourite extends Model
{
    use RecordsActivity;

    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function favouritable(){
        return $this->morphTo();
    }
}
