<?php

namespace App\Http\Controllers\Clients;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Clients\Calls\StoreClientCall;
use App\Http\Requests\Clients\Calls\UpdateClientCall;
use App\Client;
use App\ClientCall;
use Illuminate\Support\Facades\Auth;
use App\Events\ClientSubrecordEvent;
use App\Events\ClientCallEvent;

class ClientCallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($clientId)
    {
        $request = app()->make('request');

        $calls = ClientCall::orderBy($request->sort_column, $request->order_by)
                            ->where(function($query) use ($request) {
                                if($request->has('keyword')){
                                    $query->where('caller', 'LIKE', '%'.$request->keyword.'%');
                                            // ->orWhere('userType','LIKE','%'.$request->keyword.'%');
                                }
                            })
                            ->where('client_id', $clientId)
                            ->with('user')
                            ->with('company')
                            ->paginate($request->per_page);
        
        return response()->json([
                'model' => $calls,
                'columns' => ClientCall::$columns
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
    public function store(StoreClientCall $request, $clientId)
    {
        ClientCall::create([
            'caller' => $request['caller'],
            'company_id' => $request['company_id'],
            'date_of_call' => $request['date_of_call'],
            'confirmation_preCall' => $request['confirmation_preCall'],
            'productive_call' => $request['productive_call'],
            'proposal_sent' => $request['proposal_sent'],
            'client_response' => $request['client_response'],
            'client_id' => $request['client_id'],
            'updated_by' => Auth::user()->id
        ]);
        
        $client = Client::find($clientId);
        
        if($request['productive_call'] == 1){
            $client->task_status = 2;
            $client->negotiation_status = 10;
        }
        else{
            $client->task_status = 1;
            $client->negotiation_status = 10;
        }
        $client->save();

        $message = [
                'user' => auth()->user(),
                'response' => auth()->user()->name . " has added call record to ".$client->client_name,
                'new_client' => $client  
            ];
            
            
        broadcast(new ClientCallEvent($message,$clientId))->toOthers();
        event(new ClientSubrecordEvent($message));

        return ['message' => 'Call record has been saved.'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($client_id, $call_id)
    {
        $call = ClientCall::where('client_id' , $client_id)->where('id', $call_id)->first();
        return $call;
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
    public function update(UpdateClientCall $request, $clientId, $callId)
    {
        ClientCall::findOrFail($callId)
                    ->update([
                        'caller' => $request['caller'],
                        'company_id' => $request['company_id'],
                        'date_of_call' => $request['date_of_call'],
                        'confirmation_preCall' => $request['confirmation_preCall'],
                        'productive_call' => $request['productive_call'],
                        'proposal_sent' => $request['proposal_sent'],
                        'client_response' => $request['client_response'],
                        'updated_by' => auth()->user()->id,
                    ]);

        $client = Client::find($clientId);
        
        if($request['productive_call'] == 1){
            $client->task_status = 2;
            $client->negotiation_status = 10;
        }
        else{
            $client->task_status = 1;
            $client->negotiation_status = 10;
        }
        $client->save();

        $message = [
                'user' => auth()->user(),
                //'response' => auth()->user()->name . " has updated ".$client->client_name." call record  ",
                'response' => "Call record ".$callId." has updated by " . auth()->user()->name,
                'client' => $client,
                'call_id' => $callId   
            ];

        broadcast(new ClientCallEvent($message,$clientId))->toOthers();
        event(new ClientSubrecordEvent($message));


        return $message;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($clientId, $call_id)
    {
        if(!auth()->user()->userRole->delete_client_calls == 1)
            return response()->json(['message' => 'This action is unauthorized.'], 403);

        ClientCall::destroy($call_id);

        $message = ['message' => 'Record has been deleted'];

        broadcast(new ClientCallEvent($message, $clientId))->toOthers();
        event(new ClientSubrecordEvent($message));

        return $message;
    }
}
