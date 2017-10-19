<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uid','name', 'initial','email', 'userType','password','api_token','user_img',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','api_token',
    ];

    public function socialProviders(){
        return $this->hasOne(SocialProvider::class);
    }

    public function UserType(){
        return $this->belongsTo(UserType::class, 'userType')->select(['id','userType']); //userType is the foreign key in users Table
    }
}
