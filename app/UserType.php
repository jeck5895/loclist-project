<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    // protected $fillable = [
    //         'userType', 'add_clients','edit_clients','delete_clients',
    //         'add_client_calls','edit_client_calls','delete_client_calls' ,
    //         'add_client_saturations','edit_client_saturations','delete_client_saturations',
    //         'add_client_presentations','edit_client_presentations','delete_client_presentations',
    //         'add_client_acquisitions','edit_client_acquisitions','delete_client_acquisitions',
    //         'add_user','edit_user','delete_user'];
    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
