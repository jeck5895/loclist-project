<?php

namespace App\Http\Controllers\Maintenance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Maintenance\Industry\StoreIndustry;
use App\Http\Requests\Maintenance\Industry\UpdateIndustry;
use \App\Industry;
use App\Events\MaintenanceEvent;

class IndustriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(isset($_GET['type']) && $_GET['type'] == 'all'){
            $industries = Industry::active()->orderBy('industry_name','asc')->get();
        }
        else{
            $industries = Industry::active()->orderBy('industry_name','asc')->paginate(10);
        }

        return $industries;
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
    public function store(StoreIndustry $request)
    {
        //
        Industry::create([
            'industry_name' => $request['industry_name']
        ]);
         
        event(new MaintenanceEvent('industries'));

        return ['message' => 'Industry has been saved'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $industry = Industry::find($id);

        return $industry;
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
    public function update(UpdateIndustry $request, $id)
    {
        $industry_info = Industry::find($id)
                        ->update([
                            'industry_name' => $request['industry_name']
                        ]);
        
        event(new MaintenanceEvent('industries'));

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
        if(auth()->user()->userRole->id != 1)
            return response()->json(['message' => 'This action is unauthorized.'], 403);

        Industry::destroy($id);

        event(new MaintenanceEvent('industries'));
        
        return  [
            'message' => 'Record has been deleted',
            'status' => 'OK'
        ];
    }
}
