<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientContactPerson extends Model
{
     protected $table = 'client_contact_persons';
    protected $guarded = [];

    public function client() 
    {
        return $this->belongsTo(Client::class);
    }
    /** for VwClients */
    public function clients() 
    {
        return $this->belongsTo(VwClient::class, 'client_id');
    }

     public function department()
    {
        return $this->belongsTo(Department::class, 'department')->select(['id','department_name']);
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'position')->select(['id','position_name']);
    }

    public function pending_task() 
    {
        return $this->belongsTo(PendingTask::class, 'client_id','client_id');
    }
}
