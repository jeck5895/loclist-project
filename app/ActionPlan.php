<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActionPlan extends Model
{
    protected $fillable = ['action_name'];

    public function client_saturation() 
    {   /**
        *   use in retrieving clients
        */
        return $this->hasOne(ClientSaturation::class,'action_plan','id'); 
    }
}
