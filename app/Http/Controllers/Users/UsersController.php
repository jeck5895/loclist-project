<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Events\UserEvent;
use Illuminate\Http\Request;
use App\User;
use App\VwUserRole;
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
        if(isset($_GET['type']) && $_GET['type'] == 'all')
        {
            $users = User::orderBy('initial','asc')->active()->get();

            return ['model' => $users];
        }
        else{
            $request = app()->make('request');

            $users = VwUserRole::
                        orderBy($request->sort_column, $request->order_by)
                        ->where(function($query) use ($request) {
                            if($request->has('keyword')){
                                $query->where('name', 'LIKE', '%'.$request->keyword.'%')
                                        ->orWhere('userType','LIKE','%'.$request->keyword.'%');
                            }
                        })
                        ->active()
                        ->paginate($request->per_page);
            // $users = User::
            //             orderBy($request->sort_column, $request->order_by)
            //             ->where(function($query) use ($request) {
            //                 if($request->has('keyword')){
            //                     $query->where('name', 'LIKE', '%'.$request->keyword.'%');
            //                 }
            //             })
            //             ->active()
            //             ->with('userType')
            //             ->paginate($request->per_page);

            return response()->json([
                'model' => $users,
                'columns' => User::$columns
            ]);
        
            // $paginator = $this->items()->where('position', '=', null)->paginate(15);
            // $paginator->getCollection()->transform(function ($value) {
            //     // Your code here    
            // })
        }

        
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
        $user_id = User::create(
            [
                'name' => $request['name'],
                'initial' => $request['initial'],
                'email' => $request['email'],
                'password' => bcrypt('secret'),
                'userType' => $request['userType'],
                'division' => $request['division']
            ]
        )->id;

        $user = User::find($user_id);
        
        event(new UserEvent($user));

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
                        'userType' => $request['userType'],
                        'division' => $request['division']
                    ]);

        return  [
                    'message' => 'Changes has been saved.',
                    // 'request' => $request['division'],
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
