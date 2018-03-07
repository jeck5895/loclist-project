<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = ['position_name','department_id'];

    public function scopeActive($query) //can pass 2nd argument as parameters for where condition i.e scopeActive($query, $param)
    {
        return $query->where('is_active', 1);
    }

    public  function scopeInactive($query)
    {
        return $query->where('is_active', 0);
    }

    public function contact_person()
    {
        return $this->hasOne(ClientContactPerson::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
