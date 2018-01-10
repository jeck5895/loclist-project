<?php

namespace App\Http\Controllers\Clients;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Clients\Presentations\StoreClientPresentation;
use App\Http\Requests\Clients\Presentations\UpdateClientPresentation;
use App\ClientPresentation;

class ClientPresentationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($clientId)
    {
        $request = app()->make('request');

        $presentations = ClientPresentation::orderBy($request->sort_column, $request->order_by)
                            ->where(function($query) use ($request) {
                                if($request->has('keyword')){
                                    $query->where('presentation_mode', 'LIKE', '%'.$request->keyword.'%');
                                            // ->orWhere('userType','LIKE','%'.$request->keyword.'%');
                                }
                            })
                            ->where('client_id', $clientId)
                            ->with('user')
                            ->with('mode_of_presentation')
                            ->with('presentation_status')
                            ->with('action_plan')
                            ->with('company')
                            ->paginate($request->per_page);
        
        return response()->json([
                'model' => $presentations,
                'columns' => ClientPresentation::$columns
            ]);
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
    public function store(StoreClientPresentation $request)
    {
        ClientPresentation::create([
            'client_id' => $request['client_id'],
            'company_id' => $request['company_id'],
            'presentation_mode' =>$request['presentation_mode'],
            'presentor' => $request['presentor'],
            'date_presented' => $request['date_presented'],
            'call_slip2' => $request['call_slip2'],
            'client_response2' => $request['client_response2'],
            'presentation_status'=> $request['presentation_status'],
            'follow_up_meeting_date' => $request['follow_up_meeting_date'],
            'action_plan' => $request['action_plan'],
            'updated_by' => auth()->user()->id,
        ]);

        return ['message' => 'New client saturation has been saved'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($client_id, $presentation_id)
    {
        $presentation = ClientPresentation::find($presentation_id);

        return $presentation;
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
    public function update(UpdateClientPresentation $request, $client_id, $presentation_id)
    {
        ClientPresentation::findOrFail($presentation_id)
                        ->update([
                            'client_id' => $request['client_id'],
                            'company_id' => $request['company_id'],
                            'presentation_mode' =>$request['presentation_mode'],
                            'presentor' => $request['presentor'],
                            'date_presented' => $request['date_presented'],
                            'call_slip2' => $request['call_slip2'],
                            'client_response2' => $request['client_response2'],
                            'presentation_status'=> $request['presentation_status'],
                            'follow_up_meeting_date' => $request['follow_up_meeting_date'],
                            'action_plan' => $request['action_plan'],
                            'updated_by' => auth()->user()->id,
                        ]);

        return  [
                'message' => 'Changes has been saved',
            ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($client_id, $presentation_id)
    {
        if(auth()->user()->userType != 1)
        {
            // abort(403,'Request Unauthorized');
            return response('Unauthorized action', 403);
        }

        ClientPresentation::destroy($presentation_id);

        return [
            'message' => 'Record has been deleted', 
        ];
    }
}
