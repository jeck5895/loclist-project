<?php

namespace App\Http\Controllers\Maintenance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Maintenance\Acquisition\StoreAcquisition;
use App\Http\Requests\Maintenance\Acquisition\UpdateAcquisition;
use App\Acquisition;
use App\Events\MaintenanceEvent;

class AcquisitionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(isset($_GET['type']) && $_GET['type'] == 'all'){
            $acquisitions = Acquisition::orderBy('acquisition_name','asc')->get();
        }
        else{
            $acquisitions = Acquisition::orderBy('acquisition_name','asc')->paginate(10);
        }

        return $acquisitions;
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
    public function store(StoreAcquisition $request)
    {
        Acquisition::create([
            'acquisition_name' => $request['acquisition_name']
        ]);

        event(new MaintenanceEvent('acquisitions'));

        return ['message' => 'New Record has been saved'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $acquisition = Acquisition::find($id);

        return $acquisition;
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
    public function update(UpdateAcquisition $request, $id)
    {
        Acquisition::find($id)
                    ->update([
                        'acquisition_name' => $request['acquisition_name']
                    ]);

        event(new MaintenanceEvent('acquisitions'));

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
            
        Acquisition::destroy($id);

        event(new MaintenanceEvent('acquisitions'));

        return ['message' => 'Record has been deleted'];
    }
}
