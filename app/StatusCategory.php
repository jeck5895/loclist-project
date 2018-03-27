<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusCategory extends Model
{
    protected $guarded = [];

    public function statuses() 
    {
        return $this->hasMany(OverallStatus::class, 'status_category_id');
    }
}
