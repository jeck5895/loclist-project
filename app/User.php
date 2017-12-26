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

    public static $columns = [
        'id', 'name' , 'initial', 'email', 'userType', 'created_at'
    ];

    public function scopeActive($query) //can pass 2nd argument as parameters for where condition i.e scopeActive($query, $param)
    {
        return $query->where('is_active', 1);
    }

    public  function scopeInactive($query)
    {
        return $query->where('is_active', 0);
    }

    public function socialProviders()
    {
        return $this->hasOne(SocialProvider::class);
    }

    public function UserType()
    {
        return $this->belongsTo(UserType::class, 'userType')->select(['id','userType']); //userType is the foreign key in users Table
    }

    public function clients()
    {
        /**
         * entry_by foreign key in Client model 
         * uid local key in this model
         */
        return $this->hasMany(Client::class ,'entry_by', 'uid'); 
    }

    public function client_call() 
    {
        return $this->hasOne(ClientCall::class, 'caller', 'id');
    }
}
