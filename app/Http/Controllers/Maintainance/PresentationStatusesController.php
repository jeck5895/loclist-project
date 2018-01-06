<?php

namespace App\Http\Controllers\Maintainance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PresentationStatus;
use App\Http\Requests\Maintainance\ActionPlan\StorePresentationStatus;
use App\Http\Requests\Maintainance\ActionPlan\UpdatePresentationStatus;

class PresentationStatusesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         if(isset($_GET['type']) && $_GET['type'] == 'all'){
            $statuses = PresentationStatus::orderBy('status','asc')->get();
        }
        else{
            $statuses = PresentationStatus::orderBy('status','asc')->paginate(10);
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
    public function store(StorePresentationStatus $request)
    {
        PresentationStatus::create([
            'status' => $request['status']
        ]);

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
        $status = PresentationStatus::find($id);

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
    public function update(UpdatePresentationStatus $request, $id)
    {
        PresentationStatus::find($id)
                    ->update([
                        'status' => $request['status']
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
        if(auth()->user()->userType != 1)
        {
            // abort(403,'Request Unauthorized');
            return response('Unauthorized action', 403);
        }
        
        PresentationStatus::destroy($id);

        return ['message' => 'Record has been deleted'];
    }
}
