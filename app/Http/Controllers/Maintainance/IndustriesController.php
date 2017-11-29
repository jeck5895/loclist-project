<?php

namespace App\Http\Controllers\Maintainance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreIndustry;
use App\Http\Requests\UpdateIndustry;
use \App\Industry;

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
            $industries = Industry::get();
        }
        else{
            $industries = Industry::paginate(5);
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
        Industry::destroy($id);
        
        return  [
            'message' => 'Record has been deleted',
            'status' => 'OK'
        ];
    }
}