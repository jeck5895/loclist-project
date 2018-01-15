<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Acquisition extends Model
{
    protected $table = "manner_of_acquisitions";

    protected $fillable = ['acquisition_name'];

    public function client_acquisition()
    {
        return $this->hasOne(ClientAcquisition::class, 'manner_of_acquisition', 'id');
    }
}
