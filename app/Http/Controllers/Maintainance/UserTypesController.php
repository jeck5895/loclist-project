<?php

namespace App\Http\Controllers\Maintainance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Maintainance\UserType\StoreUserType;
use App\Http\Requests\Maintainance\UserType\UpdateUserType;
use App\UserType;

class UserTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         if(isset($_GET['type']) && $_GET['type'] == 'all'){
           $user_types = UserType::all();
        }
        else{
           $user_types = UserType::paginate(5);
        }        
        return $user_types;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserType $request)
    {
        $user_type = UserType::create([
            'userType' => $request['userType']
        ]);

        return ['message' => 'User type has been saved'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_type = UserType::find($id);

        return $user_type;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserType $request, $id)
    {
        $user_type = UserType::find($id)
                    ->update([
                        'userType' => $request['userType']
                    ]);
                        
        return ['message' => 'Changes has been saved'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        UserType::destroy($id);

        return  [
            'message' => 'Record has been deleted',
            'status' => 'OK'
        ];
    }
}
