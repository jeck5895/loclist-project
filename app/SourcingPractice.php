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

    public function client() 
    {   /**
        *   Create relationship to Client Model depends or hasMany
        */
        return $this->belongsToMany(Client::class)->using(ClientSourcingPractice::class); 
    }
}
