<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\Users\StoreNewUser;
use App\Http\Requests\Users\UpdateUser;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::active()->with('userType')->paginate(5);

        // foreach($query as $user){
        //     $users[] = array (
                
        //     );
        // }

        // $paginator = $this->items()->where('position', '=', null)->paginate(15);
        // $paginator->getCollection()->transform(function ($value) {
        //     // Your code here    
        // })

        return $users;
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
    public function store(StoreNewUser $request)
    {
        //$this->authorize('create');
        User::create(
            [
                'name' => $request['name'],
                'initial' => $request['initial'],
                'email' => $request['email'],
                'password' => bcrypt('secret'),
                'userType' => $request['userType']
            ]
        );
        
        return ['message' => $request['name'] . ' has been saved.'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = \App\User::find($id);
        return $user;
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
    public function update(UpdateUser $request, $id)
    {
        //
        $user_info = User::find($id)
                    ->update([
                        'name' => $request['name'],
                        'initial' => $request['initial'],
                        'email' => $request['email'],
                        'userType' => $request['userType']
                    ]);

        return  [
                    'message' => 'Changes has been saved.',
                    'request' => $id
                ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //User::find($id)->delete();
        User::destroy($id);
        
        return  [
            'message' => 'Record has been deleted',
            'status' => 'OK'
        ];
    }
}
