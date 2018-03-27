<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PendingTask extends Model
{
    protected $table = 'vw_overall_pending_tasks';

    public function contact_persons() 
    {
        return $this->hasMany(ClientContactPerson::class, 'client_id','client_id');

    }
}
