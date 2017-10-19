<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialProvider extends Model
{
    protected $fillable = ['provider_id','provider']; //list of fields to be filled up

    public function user(){
        return $this->belongsTo(User::class);
    }
}
