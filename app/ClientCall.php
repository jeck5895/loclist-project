<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientCall extends Model
{
    protected $guarded = [];

    public static $columns = [
        'id','caller','date_of_call','confirmation_preCall',
        'productive_call', 'proposal_sent', 'created_at'
    ];

    public function client()
    {
        return  $this->belongsTo(Client::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function user() 
    {
        return $this->belongsTo(User::class, 'caller', 'id');
    }
}
