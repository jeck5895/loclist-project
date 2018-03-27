<?php

namespace App\Http\Controllers\Maintenance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Maintenance\Manpower\StoreManpowerType;
use App\Http\Requests\Maintenance\Manpower\UpdateManpowerType;
use App\ClientManpowerType;
use App\Events\MaintenanceEvent;

class ManpowersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(isset($_GET['type']) && $_GET['type'] == 'all'){
            $manpower_types = ClientManpowerType::active()->orderBy('type','asc')->get();
        }
        else{
            $manpower_types = ClientManpowerType::active()->orderBy('type','asc')->paginate(10);
        }

        return $manpower_types;
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
    public function store(StoreManpowerType $request)
    {
        $manpower_type = ClientManpowerType::create([
            'type' => $request['type']
        ]);

        event(new MaintenanceEvent('manpowers'));

        return ['message' => 'Record has been saved'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $manpower_type = ClientManpowerType::find($id);

        return $manpower_type;
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
    public function update(UpdateManpowerType $request, $id)
    {
        $manpower_type = ClientManpowerType::find($id)
                        ->update([
                            'type' => $request['type']
                        ]);
        
        event(new MaintenanceEvent('manpowers'));
        
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
        if(auth()->user()->userRole->id != 1)
            return response()->json(['message' => 'This action is unauthorized.'], 403);

        ClientManpowerType::destroy($id);

        event(new MaintenanceEvent('manpowers'));

        return  [
            'message' => 'Record has been deleted',
            'status' => 'OK'
        ];
    }
}
