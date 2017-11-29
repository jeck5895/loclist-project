<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    protected $fillable = [];

    public function client_sourcing_practice()
    {
        return $this->hasMany(ClientSourcingPractice::class);
    }
}
