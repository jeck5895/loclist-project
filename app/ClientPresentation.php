<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientPresentation extends Model
{
    protected $guarded = [];

    public static $columns = [
        'date_presented', 'presentation_mode', 'presentor',
        'presentation_status','follow_up_meeting_date', 'action_plan',
        'created_at'
    ];

    public function client()
    {
        return  $this->belongsTo(Client::class);
    }

    public function user() 
    {
        return $this->belongsTo(User::class, 'presentor', 'id');
    }

    public function action_plan()
    {
        return $this->belongsTo(ActionPlan::class, 'action_plan', 'id');
    }

    public function mode_of_presentation() 
    {
        return $this->belongsTo(ModeOfPresentation::class, 'presentation_mode','id');
    }

    public function presentation_status()
    {
        return $this->belongsTo(PresentationStatus::class, 'presentation_status','id');
    }

    public function company() 
    {
        return $this->belongsTo(Company::class);
    }
}
