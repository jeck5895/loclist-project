<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['company_name', 'code'];

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeInactive($query)
    {
        return $query->where('is_active', 0);
    }

    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    public function client_calls() 
    {
        return $this->hasMany(ClientCall::class);
    }

    public function client_saturations()
    {
        return $this->hasMany(ClientSaturation::class);
    }

    public function client_presentations()
    {
        return $this->hasMany(ClientPresentation::class);
    }
}
