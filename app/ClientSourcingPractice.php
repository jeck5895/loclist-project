<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientSourcingPractice extends Model
{
    protected $fillable = ['name'];

    public function client() 
    {   /**
        *   Create relationship to Client Model depends on hasOne or hasMany
        */
        return $this->belongsTo(Client::class); 
    }
}
