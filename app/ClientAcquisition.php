<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientAcquisition extends Model
{
    protected $guarded = [];

    public static $columns = [
        'status_as_of', 'acquired_by', 'status',
        'date_acquired','signed_contract', 'initial_hc_acquired',
        'company_id', 'manner_of_acquisition','name_of_related_client',
        'created_at'
    ];

    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function user() {
        return $this->belongsTo(User::class, 'acquired_by', 'id');
    }

    public function manner_of_acquisition() 
    {
        return $this->belongsTo(Acquisition::class, 'manner_of_acquisition', 'id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function status() 
    {
        return $this->belongsTo(OverallStatus::class,'status')->select(['id','status']);
    }
}
