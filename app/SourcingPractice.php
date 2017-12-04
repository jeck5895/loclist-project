<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SourcingPractice extends Model
{
    protected $fillable = ['name'];

    public function scopeActive($query) //can pass 2nd argument as parameters for where condition i.e scopeActive($query, $param)
    {
        return $query->where('is_active', 1);
    }

    public  function scopeInactive($query)
    {
        return $query->where('is_active', 0);
    }

    public function clients() 
    {   /**
        *   use in retrieving clients with roles
        */
        return $this->belongsToMany(Client::class,'client_sourcing_practices','client_id','sourcing_practice_id')->using(ClientSourcingPractice::class)->withTimestamps(); 
    }
}
