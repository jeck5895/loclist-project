<?php

namespace App\Http\Controllers\Clients;

use Illuminate\Http\Request;
use App\Http\Requests\Clients\StoreClient;
use App\Http\Requests\Clients\UpdateClient;
use App\Http\Controllers\Controller;
use App\Client;
use App\ClientSourcingPractice;
use App\ClientManpowerProvider;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::active()->with('user')->paginate(10);

        return $clients;
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
    public function store(StoreClient $request)
    {
        $client_id = Client::create(
            [
                'entry_by' => $request['entry_by'],
                'client_name' => $request['client_name'],
                'industry' => $request['industry'],
                'nationality' => $request['nationality'],
                'iso_certf' => $request['iso_certf'],
                'complete_mailing_address' => $request['complete_mailing_address'],
                'techno_park' => $request['techno_park'],
                'street_address' => $request['street_address'],
                'province' => $request['province'],
                'administrative_area_level_1' => $request['administrative_area_level_1'],
                'postal_code' => $request['postal_code'],
                'website' => $request['website'],
                'primary_landline' => $request['primary_landline'],
                'other_landline' => $request['other_landline'],
                'mobile_number' => $request['mobile_number'],
                'email_address' => $request['email_address'],
                'contact_person' => $request['contact_person'],
                'gender' => $request['gender'],
                'department' => $request['department'],
                'position' => $request['position'],
                'proposal' => $request['proposal'],
                'company' => $request['company'],
                'manpower' => $request['manpower'],
                'updated_by' => $request['entry_by']
            ]
        )->id;
        
        if($client_id) {

            $client = Client::find($client_id);

            foreach($request['manpower_providers'] as $provider){
                $client_provider = new ClientManpowerProvider(array('manpower_provider' => $provider['manpower_provider']));
                $client->manpower_providers()->save($client_provider);
            }

            foreach($request['sourcing_practices'] as $sp ){
                $client->sourcing_practices()->attach($sp);
            }

        }
        
        return ['message' => $request['client_name'] . ' has been saved.'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::where('id', $id)
                        ->with('user')
                        ->with('department')
                        ->with('industry')
                        ->with('company')
                        ->with('position')
                        ->with('manpower_providers')
                        ->with('manpower_type')
                        ->with('sourcing_practices')
                        ->first();

        return $client;
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
    public function update(Request $request, $id)
    {
        //
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
