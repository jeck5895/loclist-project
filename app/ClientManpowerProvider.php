<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientManpowerProvider extends Model
{
    protected $fillabel = ['manpower_provider']; 
    protected $guarded = [];

    public function client() 
    {
        return $this->belongsTo(Client::class);
    }
}
