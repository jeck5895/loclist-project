<?php

namespace App\Http\Controllers\Maintenance;

use App\Http\Controllers\Controller;
use App\Saturation;
use Illuminate\Http\Request;
use App\Http\Requests\Maintenance\Saturation\StoreSaturation;
use App\Http\Requests\Maintenance\Saturation\UpdateSaturation;

class SaturationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(isset($_GET['type']) && $_GET['type'] == 'all'){
            $saturations = Saturation::orderBy('saturation_mode','asc')->get();
        }
        else{
            $saturations = Saturation::orderBy('saturation_mode','asc')->paginate(10);
        }

        return $saturations;
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
    public function store(StoreSaturation $request)
    {
        Saturation::create([
            'saturation_mode' => $request['saturation_mode']
        ]);

        return ['message' => 'New Record has been saved'];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Saturation  $saturation
     * @return \Illuminate\Http\Response
     */
    public function show(Saturation $saturation)
    {
        return $saturation;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Saturation  $saturation
     * @return \Illuminate\Http\Response
     */
    public function edit(Saturation $saturation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Saturation  $saturation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSaturation $request, Saturation $saturation)
    {
        /**
         * UPDATE method with model binding 
         */
        $saturation->update($request->all());

        return ['message' => 'Changes has been saved'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Saturation  $saturation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Saturation $saturation)
    {
        if(auth()->user()->userType != 1)
        {
            // abort(403,'Request Unauthorized');
            return response('Unauthorized action', 403);
        }

        $saturation->delete();
        
        return ['message' => 'Record has been deleted'];
    }
}
