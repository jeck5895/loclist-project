<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OverallStatus extends Model
{
    protected $fillable = ['status'];

    public function scopeActive($query) 
    {
        return $query->where('is_active', 1);
    }

    public function client()
    {
        return $this->hasOne(Client::class);
    }
}
