<?php

namespace App\Http\Controllers\Maintainance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Maintainance\Manpower\StoreManpowerType;
use App\Http\Requests\Maintainance\Manpower\UpdateManpowerType;
use App\ClientManpowerType;

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
            $manpower_types = ClientManpowerType::get();
        }
        else{
            $manpower_types = ClientManpowerType::paginate(5);
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
        ClientManpowerType::destroy($id);

        return  [
            'message' => 'Record has been deleted',
            'status' => 'OK'
        ];
    }
}
