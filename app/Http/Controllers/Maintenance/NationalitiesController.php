<?php

namespace App\Http\Controllers\Maintenance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Maintenance\Nationality\StoreNationality;
use App\Http\Requests\Maintenance\Nationality\UpdateNationality;
use App\Nationality;
use App\Events\MaintenanceEvent;

class NationalitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(isset($_GET['type']) && $_GET['type'] == 'all'){
            $nationalities = Nationality::active()->orderBy('nationality','asc')->get();   
        }
        else{
            $nationalities = Nationality::active()->orderBy('nationality','asc')->paginate(10);
        }
            
        return $nationalities;
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
    public function store(StoreNationality $request)
    {
        Nationality::create([
            'nationality' => $request['nationality']
        ]);
        
        event(new MaintenanceEvent('nationalities'));

        return ['message' => 'Nationality has been saved'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $nationality = Nationality::find($id);

        return $nationality;
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
    public function update(UpdateNationality $request, $id)
    {
        $nationality_info = Nationality::find($id)
                            ->update([
                                'nationality' => $request['nationality']
                            ]);
        
        event(new MaintenanceEvent('nationalities'));

        return  [
                    'message' => 'Changes has been saved',
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
        if(auth()->user()->userRole->id != 1)
            return response()->json(['message' => 'This action is unauthorized.'], 403);
        
        Nationality::destroy($id);

        event(new MaintenanceEvent('nationalities'));

        return  [
            'message' => 'Record has been deleted',
            'status' => 'OK'
        ];
    }
}
