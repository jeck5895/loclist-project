<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Confirmation extends Model
{
    protected $table = 'manner_of_confirmations';

    protected $fillable = ['confirmation_name'];

    public function client_saturation() 
    {
        return $this->hasOne(ClientSaturation::class,'manner_of_confirmation','id');
    }
}
