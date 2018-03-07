<?php

namespace App\Http\Controllers\Maintenance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ActionPlan;
use App\Http\Requests\Maintenance\ActionPlan\StoreActionPlan;
use App\Http\Requests\Maintenance\ActionPlan\UpdateActionPlan;

class ActionPlansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         if(isset($_GET['type']) && $_GET['type'] == 'all'){
            $action_plans = ActionPlan::orderBy('action_name','asc')->get();
        }
        else{
            $action_plans = ActionPlan::orderBy('action_name','asc')->paginate(10);
        }

        return $action_plans;
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
    public function store(StoreActionPlan $request)
    {
         ActionPlan::create([
            'action_name' => $request['action_name']
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
        $action_plan  = ActionPlan::find($id);

        return $action_plan;
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
    public function update(UpdateActionPlan $request, $id)
    {
        ActionPlan::find($id)
                    ->update([
                        'action_name' => $request['action_name']
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
        
        ActionPlan::destroy($id);

        return ['message' => 'Record has been deleted'];
    }
}
