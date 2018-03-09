<?php

namespace App\Http\Controllers\Maintenance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Maintenance\UserType\StoreUserType;
use App\Http\Requests\Maintenance\UserType\UpdateUserType;
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
           $user_types = UserType::orderBy('userType','asc')->get();
        }
        else{
           $user_types = UserType::orderBy('userType','asc')->paginate(10);
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
        $user_type = new UserType;
        if($request->has('userType'))
        $user_type->userType = $request['userType'];
        
        if($request->has('add_clients'))
        $user_type->add_clients = $request['add_clients'];
        
        if($request->has('edit_clients'))
        $user_type->edit_clients = $request['edit_clients'];

        if($request->has('delete_clients'))
        $user_type->delete_clients = $request['delete_clients'];

        if($request->has('add_client_calls'))
        $user_type->add_client_calls = $request['add_client_calls'];

        if($request->has('edit_client_calls'))
        $user_type->edit_client_calls = $request['edit_client_calls'];

        if($request->has('delete_client_calls'))
        $user_type->delete_client_calls = $request['delete_client_calls'];

        if($request->has('add_client_saturations'))
        $user_type->add_client_saturations = $request['add_client_saturations'];

        if($request->has('edit_client_saturations'))
        $user_type->edit_client_saturations = $request['edit_client_saturations'];

        if($request->has('delete_client_saturations'))
        $user_type->delete_client_saturations = $request['delete_client_saturations'];

        if($request->has('add_client_presentations'))
        $user_type->add_client_presentations = $request['add_client_presentations'];

        if($request->has('edit_client_presentations'))
        $user_type->edit_client_presentations = $request['edit_client_presentations'];

        if($request->has('delete_client_presentations'))
        $user_type->delete_client_presentations = $request['delete_client_presentations'];

        if($request->has('add_client_acquisitions'))
        $user_type->add_client_acquisitions = $request['add_client_acquisitions'];

        if($request->has('edit_client_acquisitions'))
        $user_type->edit_client_acquisitions = $request['edit_client_acquisitions'];

        if($request->has('delete_client_acquisitions'))
        $user_type->delete_client_acquisitions = $request['delete_client_acquisitions'];

        if($request->has('add_user'))
        $user_type->add_user = $request['add_user'];

        if($request->has('edit_user'))
        $user_type->edit_user = $request['edit_user'];

        if($request->has('delete_user'))
        $user_type->delete_user = $request['delete_user'];
        $user_type->save();

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
        $user_type = UserType::findOrFail($id);
        if($request->has('userType'))
        $user_type->userType = $request['userType'];
        
        if($request->has('add_clients'))
        $user_type->add_clients = $request['add_clients'];
        
        if($request->has('edit_clients'))
        $user_type->edit_clients = $request['edit_clients'];

        if($request->has('delete_clients'))
        $user_type->delete_clients = $request['delete_clients'];

        if($request->has('add_client_calls'))
        $user_type->add_client_calls = $request['add_client_calls'];

        if($request->has('edit_client_calls'))
        $user_type->edit_client_calls = $request['edit_client_calls'];

        if($request->has('delete_client_calls'))
        $user_type->delete_client_calls = $request['delete_client_calls'];

        if($request->has('add_client_saturations'))
        $user_type->add_client_saturations = $request['add_client_saturations'];

        if($request->has('edit_client_saturations'))
        $user_type->edit_client_saturations = $request['edit_client_saturations'];

        if($request->has('delete_client_saturations'))
        $user_type->delete_client_saturations = $request['delete_client_saturations'];

        if($request->has('add_client_presentations'))
        $user_type->add_client_presentations = $request['add_client_presentations'];

        if($request->has('edit_client_presentations'))
        $user_type->edit_client_presentations = $request['edit_client_presentations'];

        if($request->has('delete_client_presentations'))
        $user_type->delete_client_presentations = $request['delete_client_presentations'];

        if($request->has('add_client_acquisitions'))
        $user_type->add_client_acquisitions = $request['add_client_acquisitions'];

        if($request->has('edit_client_acquisitions'))
        $user_type->edit_client_acquisitions = $request['edit_client_acquisitions'];

        if($request->has('delete_client_acquisitions'))
        $user_type->delete_client_acquisitions = $request['delete_client_acquisitions'];

        if($request->has('add_user'))
        $user_type->add_user = $request['add_user'];

        if($request->has('edit_user'))
        $user_type->edit_user = $request['edit_user'];

        if($request->has('delete_user'))
        $user_type->delete_user = $request['delete_user'];
        $user_type->save();
                    
        return ['message' => 'Changes has been saved','request' => $request['add_clients']];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(auth()->user()->userRole->id != 1)
            return response()->json(['message' => 'This action is unauthorized.'], 403);
        
        UserType::destroy($id);

        return  [
            'message' => 'Record has been deleted',
            'status' => 'OK'
        ];
    }
}