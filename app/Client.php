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

    public function company_manpower_type() {
        return $this->belongsTo(ClientManpowerType::class, 'manpower')->select(['id','type']);
    }

    public function sourcing_practices()
    {
        return $this->belongsToMany(SourcingPractice::class, 'client_sourcing_practices','client_id','sourcing_practice_id')->withTimestamps();
    }

    public function company_certificate() 
    {
        return $this->belongsTo(Certificate::class, 'iso_certf')->select(['id','iso_name']);
    }

    public function company_department()
    {
        return $this->belongsTo(Department::class, 'department')->select(['id','department_name']);
    }

    public function contact_person_position()
    {
        return $this->belongsTo(Position::class, 'position')->select(['id','position_name']);
    }

    public function company_nationality()
    {
        return $this->belongsTo(Nationality::class, 'nationality')->select(['id','nationality']);
    }

    public function provider_company() 
    {
        return $this->belongsTo(Company::class, 'company')->select(['id','company_name']);
    }

    public function company_industry() {
        return $this->belongsTo(Industry::class, 'industry')->select(['id','industry_name']);
    }

    public function company_overall_status() {
        return $this->belongsTo(OverallStatus::class, 'overall_status');
    }

    public function calls() 
    {
        return $this->hasMany(ClientCall::class);
    }

    public function saturations() 
    {
        return $this->hasMany(ClientSaturation::class);
    }
}
