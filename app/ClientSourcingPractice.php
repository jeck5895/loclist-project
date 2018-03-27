<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ClientSourcingPractice extends Pivot
{
    public function clients()
    {
        return $this->hasMany(Client::class, 'id', 'client_id');
    }

    public function sourcing_practices()
    {
        return $this->hasMany(SourcingPractice::class, 'id', 'sourcing_practice_id');
    }

    public function client()
    {
        return $this->hasOne(Client::class, 'id', 'client_id');
    }

    public function sourcing_practice()
    {
        return $this->hasOne(SourcingPractice::class, 'id', 'sourcing_practice_id');
    }
}
