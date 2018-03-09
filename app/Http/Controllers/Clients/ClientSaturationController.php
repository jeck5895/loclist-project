<?php

namespace App\Http\Controllers\clients;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Clients\Saturation\StoreClientSaturation;
use App\Http\Requests\Clients\Saturation\UpdateClientSaturation;
use App\Client;
use App\ClientSaturation;
use App\Events\ClientSaturationEvent;

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
                            ->with('company')
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
    public function store(StoreClientSaturation $request, $clientId)
    {
        $saturation = new ClientSaturation;
        $saturation->client_id = $request['client_id'];
        $saturation->company_id = $request['company_id'];
        $saturation->saturation_date = $request['saturation_date'];
        $saturation->saturation_mode = $request['saturation_mode'];
        $saturation->proposal_by = $request['proposal_by'];
        $saturation->call_slip = $request['call_slip'];
        $saturation->date_received = $request['date_received'];
        $saturation->proposal_accepted = $request['proposal_accepted'];
        $saturation->manner_of_confirmation = $request['manner_of_confirmation'];
        $saturation->client_response1 = $request['client_response1'];
        $saturation->ff_calls_made = $request['ff_calls_made'];
        if($request['ff_calls_made'] == 1){
            $saturation->last_ffup_date = $request['last_ffup_date'];
        }
        $saturation->updated_by = auth()->user()->id;
        $saturation->save();

        $client = Client::find($request['client_id']);

        $message = [
                'user' => auth()->user(),
                'response' => auth()->user()->name . " has added saturation record to ".$client->client_name,
                'client' => $client  
            ];
        
        broadcast(new ClientSaturationEvent($message, $clientId))->toOthers();
        
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
    public function update(UpdateClientSaturation $request, $clientId, $saturation_id)
    {
        $saturation = ClientSaturation::findOrFail($saturation_id);
        $saturation->client_id = $request['client_id'];
        $saturation->company_id = $request['company_id'];
        $saturation->saturation_date = $request['saturation_date'];
        $saturation->saturation_mode = $request['saturation_mode'];
        $saturation->proposal_by = $request['proposal_by'];
        $saturation->call_slip = $request['call_slip'];
        $saturation->date_received = $request['date_received'];
        $saturation->proposal_accepted = $request['proposal_accepted'];
        $saturation->manner_of_confirmation = $request['manner_of_confirmation'];
        $saturation->client_response1 = $request['client_response1'];
        $saturation->ff_calls_made = $request['ff_calls_made'];
        if($request['ff_calls_made'] == 1){
            $saturation->last_ffup_date = $request['last_ffup_date'];
        }
        $saturation->updated_by = auth()->user()->id;
        $saturation->save();

        $client = Client::find($clientId);

        $message = [
                'user' => auth()->user(),
                'response' => auth()->user()->name . " has updated a saturation record of ".$client->client_name,
                'client' => $client  
            ];

        broadcast(new ClientSaturationEvent($message, $clientId))->toOthers();
        
        return  [
                'message' => 'Changes has been saved',
                'client_id' => $clientId,
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
        if(!auth()->user()->userRole->delete_client_saturations == 1)
            return response()->json(['message' => 'This action is unauthorized.'], 403);

        ClientSaturation::destroy($saturation_id);

        return [
            'message' => 'Record has been deleted', 
        ];
    }
}
