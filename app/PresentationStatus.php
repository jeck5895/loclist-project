<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PresentationStatus extends Model
{
    protected $fillable = ['status'];

    public function client_saturation() 
    {   /**
        *   use in retrieving clients
        */
        return $this->hasOne(ClientSaturation::class,'presentation_status','id'); 
    }
}
