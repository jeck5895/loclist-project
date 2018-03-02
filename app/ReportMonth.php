<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportMonth extends Model
{
    protected $guarded = [];

    protected $hidden = ['created_at', 'updated_at'];

    public function report_target_lists() {
        return $this->hasMany(ReportTargetList::class, 'month_id', 'id');
    }
}
