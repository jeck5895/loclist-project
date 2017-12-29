<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Saturation extends Model
{
    protected $table = 'mode_of_saturations';

    protected $fillable = ['saturation_mode'];

    public function client_saturation() 
    {   /**
        *   use in retrieving clients
        */
        return $this->hasOne(ClientSaturation::class,'saturation_mode','id'); 
    }
}
