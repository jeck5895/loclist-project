<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    protected $guarded = [];

    public static $columns = ['id','entry_by','client_name','contact_person','mobile_number','email_address','created_at'];

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

    public function manpower_type() {
        return $this->belongsTo(ClientManpowerType::class, 'manpower')->select(['id','type']);
    }

    public function sourcing_practices()
    {
        return $this->belongsToMany(SourcingPractice::class, 'client_sourcing_practices','client_id','sourcing_practice_id')->withTimestamps();
    }

    public function certificate() 
    {
        return $this->belongsTo(Certificate::class, 'iso_certf')->select(['id','iso_name']);
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department')->select(['id','department_name']);
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'position')->select(['id','position_name']);
    }

    public function nationality()
    {
        return $this->belongsTo(Nationality::class, 'nationality')->select(['id','nationality']);
    }

    public function company() 
    {
        return $this->belongsTo(Company::class, 'company')->select(['id','company_name']);
    }

    public function industry() {
        return $this->belongsTo(Industry::class, 'industry')->select(['id','industry_name']);
    }
}
