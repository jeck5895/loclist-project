<?php

namespace App\Http\Controllers\Maintenance;

use App\Confirmation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Maintenance\Confirmation\StoreConfirmation;
use App\Http\Requests\Maintenance\Confirmation\UpdateConfirmation;

class ConfirmationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(isset($_GET['type']) && $_GET['type'] == 'all'){
            $confirmations = Confirmation::orderBy('confirmation_name','asc')->get();
        }
        else{
            $confirmations = Confirmation::orderBy('confirmation_name','asc')->paginate(10);
        }

        return $confirmations;
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
    public function store(StoreConfirmation $request)
    {
        Confirmation::create([
            'confirmation_name' => $request['confirmation_name']
        ]);

        return ['message' => 'New record has been saved'];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Confirmation  $confirmation
     * @return \Illuminate\Http\Response
     */
    public function show(Confirmation $confirmation)
    {
        return $confirmation;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Confirmation  $confirmation
     * @return \Illuminate\Http\Response
     */
    public function edit(Confirmation $confirmation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Confirmation  $confirmation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateConfirmation $request, Confirmation $confirmation)
    {
       $confirmation->update($request->all());

       return ['message' => 'Changes has been saved'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Confirmation  $confirmation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Confirmation $confirmation)
    {
        if(auth()->user()->userRole->id != 1)
            return response()->json(['message' => 'This action is unauthorized.'], 403);

        $confirmation->delete();
        
        return ['message' => 'Record has been deleted'];
    }
}
