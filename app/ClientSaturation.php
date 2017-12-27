<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientSaturation extends Model
{
    protected $guarded = [];

    public static $columns = [
        'saturation_date', 'saturation_mode', 'proposal_by',
        'date_received','manner_of_confirmation', 'last_ffup_date',
        'created_at'
    ];

    public function client()
    {
        return  $this->belongsTo(Client::class);
    }

    public function user() 
    {
        return $this->belongsTo(User::class, 'proposal_by', 'id');
    }
}
