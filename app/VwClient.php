<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VwClient extends Model
{
    /**
     * For eager loading contact persons with VwClient and ClientContactPerson
     */
    public function contact_persons()
    {
        return $this->hasMany(ClientContactPerson::class, 'client_id');
    }
}
