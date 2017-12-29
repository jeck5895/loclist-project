<?php

namespace App\Http\Controllers\clients;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Clients\Saturation\StoreClientSaturation;
use App\Http\Requests\Clients\Saturation\UpdateClientSaturation;
use App\Client;
use App\ClientSaturation;

class ClientSaturationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($clientId)
    {
        $request = app()->make('request');

        $saturations = ClientSaturation::orderBy($request->sort_column, $request->order_by)
                            ->where(function($query) use ($request) {
                                if($request->has('keyword')){
                                    $query->where('proposal_by', 'LIKE', '%'.$request->keyword.'%');
                                            // ->orWhere('userType','LIKE','%'.$request->keyword.'%');
                                }
                            })
                            ->where('client_id', $clientId)
                            ->with('user')
                            ->with('saturation')
                            ->with('confirmation')
                            ->paginate($request->per_page);
        
        return response()->json([
                'model' => $saturations,
                'columns' => ClientSaturation::$columns
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
    public function store(StoreClientSaturation $request)
    {
        ClientSaturation::create([
            'client_id' => $request['client_id'],
            'saturation_date' => $request['saturation_date'],
            'saturation_mode' => $request['saturation_mode'],
            'proposal_by' => $request['proposal_by'],
            'call_slip' => $request['call_slip'],
            'date_received' => $request['date_received'],
            'proposal_accepted' => $request['proposal_accepted'],
            'manner_of_confirmation' => $request['manner_of_confirmation'],
            'client_response1' => $request['client_response1'],
            'ff_calls_made' => $request['ff_calls_made'],
            'last_ffup_date' => $request['last_ffup_date'],
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
    public function show($client_id, $saturation_id)
    {
        $client_saturation = ClientSaturation::where('client_id' , $client_id)->where('id', $saturation_id)->first();

        return $client_saturation;
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
    public function update(UpdateClientSaturation $request, $client_id, $saturation_id)
    {
        
        ClientSaturation::findOrFail($saturation_id)
                            ->update([
                                'saturation_date' => $request['saturation_date'],
                                'saturation_mode' => $request['saturation_mode'],
                                'proposal_by' => $request['proposal_by'],
                                'call_slip' => $request['call_slip'],
                                'date_received' => $request['date_received'],
                                'proposal_accepted' => $request['proposal_accepted'],
                                'manner_of_confirmation' => $request['manner_of_confirmation'],
                                'client_response1' => $request['client_response1'],
                                'ff_calls_made' => $request['ff_calls_made'],
                                'last_ffup_date' => $request['last_ffup_date'],
                                'updated_by' => auth()->user()->id,
                            ]);
        return  [
                'message' => 'Changes has been saved',
                'client_id' => $client_id,
                'saturation' => $saturation_id
            ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($client_id, $saturation_id)
    {
        if(auth()->user()->userType != 1)
        {
            // abort(403,'Request Unauthorized');
            return response('Unauthorized action', 403);
        }

        ClientSaturation::destroy($saturation_id);

        return [
            'message' => 'Record has been deleted', 
        ];
    }
}
