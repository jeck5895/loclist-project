<?php

namespace App\Http\Controllers\Maintenance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Maintenance\Status\StoreStatus;
use App\Http\Requests\Maintenance\Status\UpdateStatus;
use App\OverallStatus;
use App\Events\MaintenanceEvent;

class StatusesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(isset($_GET['type']) && $_GET['type'] == 'all' )
        {
            if(isset($_GET['category']))
            {
                $statuses = OverallStatus::where('status_category_id', $_GET['category'])
                        ->active()->orderBy('status', 'asc')
                        ->get();
            }   
            else{
                $statuses = OverallStatus::active()->orderBy('status', 'asc')->get();

            } 
        }
        else{
            $statuses = OverallStatus::active()->orderBy('status','asc')->with('status_category')->paginate(10);
        }
        
        return $statuses;
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
    public function store(StoreStatus $request)
    {
        $status = OverallStatus::create([
            'status' => $request['status'],
            'status_category_id' => $request['status_category'],
        ]);

        event(new MaintenanceEvent('statuses'));

        return ['message' => 'Status has been saved'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $status = OverallStatus::find($id);

       return $status;
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
    public function update(UpdateStatus $request, $id)
    {
        $status = OverallStatus::find($id)
                    ->update([
                        'status' => $request['status'],
                        'status_category_id' => $request['status_category'],
                    ]);

        event(new MaintenanceEvent('statuses'));

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
        
        OverallStatus::destroy($id);

        event(new MaintenanceEvent('statuses'));


        return ['message' => 'Record has been deleted'];
    }
}
