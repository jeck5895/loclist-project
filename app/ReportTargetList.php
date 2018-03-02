<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportTargetList extends Model
{
    protected $guarded = [];

    public function report_month(){
        return $this->belongsTo(ReportMonth::class, 'month_id', 'id');
    }
}
