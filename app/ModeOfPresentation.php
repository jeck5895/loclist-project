<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModeOfPresentation extends Model
{
    protected $fillable = ['presentation_mode'];

    public function client_saturation() 
    {   /**
        *   use in retrieving clients
        */
        return $this->hasOne(ClientSaturation::class,'presentation_mode','id'); 
    }
}
