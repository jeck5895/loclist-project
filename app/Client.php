<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    protected $guarded = [];

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeInactive($query)
    {
        return $query->where('is_active', 0);
    }

    public function user()
    {
        /**
         * entry_by is the foreign key from Client model 
         * uid is the local key from User model
         */
        return $this->belongsTo(User::class, 'entry_by','uid'); 
    }

    public function manpower_providers()
    {
        return $this->hasMany(ClientManpowerProvider::class);
    }

    public function sourcing_practices()
    {
        return $this->belongsToMany(SourcingPractice::class, 'client_sourcing_practices','client_id','sourcing_practice_id')->withTimestamps();
    }

    public function certificate() 
    {
        return $this->belongsTo(Certificate::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function nationality()
    {
        return $this->belongsTo(Nationality::class);
    }
}
