<?php

namespace App\Http\Controllers\Clients;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Clients\Calls\StoreClientCall;
use App\Http\Requests\Clients\Calls\UpdateClientCall;
use App\Client;
use App\ClientCall;
use Illuminate\Support\Facades\Auth;

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
            'date_of_call' => $request['date_of_call'],
            'confirmation_preCall' => $request['confirmation_preCall'],
            'productive_call' => $request['productive_call'],
            'proposal_sent' => $request['proposal_sent'],
            'client_response' => $request['client_response'],
            'client_id' => $request['client_id'],
            'updated_by' => Auth::user()->id
        ]);

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
                        'date_of_call' => $request['date_of_call'],
                        'confirmation_preCall' => $request['confirmation_preCall'],
                        'productive_call' => $request['productive_call'],
                        'proposal_sent' => $request['proposal_sent'],
                        'client_response' => $request['client_response'],
                        'updated_by' => Auth::user()->id
                    ]);
        return [
            'message' => 'Changes has been saved.',
            'client_id' => $clientId,
            'call_id' => $callId
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
        //
    }
}