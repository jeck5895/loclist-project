<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Confirmation extends Model
{
    protected $table = 'manner_of_confirmations';

    protected $fillable = ['confirmation_name'];
}
