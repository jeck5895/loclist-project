<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VwUserRole extends Model
{
    protected $table = 'vw_user_roles';

    public function scopeActive($query) //can pass 2nd argument as parameters for where condition i.e scopeActive($query, $param)
    {
        return $query->where('is_active', 1);
    }

    public  function scopeInactive($query)
    {
        return $query->where('is_active', 0);
    }
}
