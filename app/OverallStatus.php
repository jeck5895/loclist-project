<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OverallStatus extends Model
{
    protected $guarded = [];

    public function scopeActive($query) 
    {
        return $query->where('is_active', 1);
    }

    public function client()
    {
        return $this->hasOne(Client::class);
    }

    public function client_acquisitions()
    {
        return $this->hasMany(ClientAcquisition::class,'status');
    }

    public function status_category() 
    {
        return $this->belongsTo(StatusCategory::class,'status_category_id');
    }
}
