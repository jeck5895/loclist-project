<?php

namespace App\Http\Controllers\Clients;

use Illuminate\Http\Request;
use App\Http\Requests\Clients\StoreClient;
use App\Http\Requests\Clients\UpdateClient;
use App\Http\Controllers\Controller;
use App\Events\ClientEvent;
use App\Client;
use App\VwClient;
use App\ClientSourcingPractice;
use App\ClientManpowerProvider;
use App\ClientContactPerson;
use Validator;
use Illuminate\Support\Facades\DB;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        /**
         * Make request 
         */
        $request = app()->make('request');


        //Check if there's any request parameters
        if(!empty($request->all()))
        {
            $validation = Validator::make($request->only([
                        'per_page','order_by', 'sort_column'
                    ]),[
                        'per_page' => 'required|integer|min:1',
                        'order_by' => 'required|in:asc,desc',
                        'sort_column' => 'required'
                    ]);
        
            if($validation->fails()) {
                dd($validation->messages());
            }
            $clients = VwClient::orderBy($request->sort_column, $request->order_by)
                        ->where(function($query) use ($request){
                            if($request->has('keyword'))
                            {
                                $query->where('client_name', 'LIKE' ,'%'.$request->keyword.'%');
                                    //->orWhere('user_initial', 'LIKE' ,'%'.$request->keyword.'%');
                                    // ->orWhere('administrative_area_level_1', 'LIKE' ,'%'.$request->keyword.'%');
                                if($request->has('industry') && $request->industry != null)
                                {
                                    $query->where('industry',$request->industry);
                                }
                                if($request->has('location') && $request->location != null)
                                {
                                    $query->where('province', 'LIKE' , '%'.$request->location.'%');
                                }
                                if(($request->has('from_date') && $request->from_date != null) && ($request->has('to_date') && $request->to_date != null))
                                {
                                    $query->whereBetween('created_at',[$request->from_date, $request->to_date]);
                                }
                                if($request->has('status') && $request->status != null)
                                {
                                    $query->where('overall_status', $request->status);
                                }
                            }
                            else{

                            }
                            
                        })
                        // ->active()
                        // ->with('user')
                        ->with('contact_persons.department')
                        ->with('contact_persons.position')
                        ->paginate($request->per_page);

            return response()->json([
                'model' => $clients,
                'columns' => Client::$columns,
            ]);
        }
        else{
            return Client::active()->get();
        }
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
                // 'mobile_number' => $request['mobile_number'],
                // 'email_address' => $request['email_address'],
                // 'contact_person' => $request['first_name'] . " " . $request['last_name'],//$request['contact_person'],
                // 'first_name' => $request['first_name'],
                // 'last_name' => $request['last_name'],
                // 'gender' => $request['gender'],
                // 'department' => $request['department'],
                // 'position' => $request['position'],
                'proposal' => $request['proposal'],
                'company' => $request['company'],
                'manpower' => $request['manpower'],
                'updated_by' => $request['entry_by'],
                'overall_status' => $request['overall_status']
            ]
        )->id;
        
        if($client_id) {

            $client = Client::find($client_id);

            foreach ($request['contact_persons'] as $contact_person) {
                $client_contact_persons = new ClientContactPerson(
                    array(
                        'first_name' => $contact_person['first_name'],
                        'last_name' => $contact_person['last_name'],
                        'email' => $contact_person['email'],
                        'mobile_number' => $contact_person['mobile_number'],
                        'gender' => $contact_person['gender'],
                        'department' => $contact_person['department']['id'],
                        'position' => $contact_person['position']['id']
                    )
                );
                $client->contact_persons()->save($client_contact_persons);
            }
        
            foreach($request['manpower_providers'] as $provider){
                /**
                 * Save record to related model
                 */
                $client_provider = new ClientManpowerProvider(array('manpower_provider' => $provider));
                $client->manpower_providers()->save($client_provider);
            }

            foreach($request['sourcing_practices'] as $sp ){
                /**
                 * Attach record to middle table (for many to many relationships)
                 */
                $client->sourcing_practices()->attach($sp);
            }

            //dispatch event for new created client
            $message = [
                'user' => auth()->user(),
                'response' => auth()->user()->name . " has added new client ".$client->client_name,
                'new_client' => $client
            ];

            broadcast(new ClientEvent($message))->toOthers();

            return ['message' => $request['client_name'] . ' has been saved.', 'others' => $message];
        }
        
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
                        // ->with('company_department')
                        ->with('company_industry')
                        ->with('provider_company')
                        ->with('company_nationality')
                        ->with('company_certificate')
                        ->with('contact_persons.department') //for nested eager loading https://laravel.com/docs/5.6/eloquent-relationships#querying-relations
                        ->with('contact_persons.position')
                        ->with('manpower_providers')
                        ->with('company_manpower_type')
                        ->with('sourcing_practices')
                        ->with('company_overall_status')
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
    public function update(UpdateClient $request, $id)
    {
        Client::find($id)->update([
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
                // 'mobile_number' => $request['mobile_number'],
                // 'email_address' => $request['email_address'],
                // 'contact_person' => $request['first_name'] . " " . $request['last_name'],//$request['contact_person'],
                // 'first_name' => $request['first_name'],
                // 'last_name' => $request['last_name'],
                // 'gender' => $request['gender'],
                // 'department' => $request['department'],
                // 'position' => $request['position'],
                'proposal' => $request['proposal'],
                'company' => $request['company'],
                'manpower' => $request['manpower'],
                'updated_by' => $request['entry_by'],
                'overall_status' => $request['overall_status']
            ]);
        
        if($id) {

            $client = Client::find($id);
            //Delete all records first then insert it again whatever changes has done
            DB::table('client_contact_persons')->where('client_id', $id)->delete();

            foreach ($request['contact_persons'] as $contact_person) {
                $client_contact_persons = new ClientContactPerson(
                    array(
                        'first_name' => $contact_person['first_name'],
                        'last_name' => $contact_person['last_name'],
                        'email' => $contact_person['email'],
                        'mobile_number' => $contact_person['mobile_number'],
                        'gender' => $contact_person['gender'],
                        'department' => $contact_person['department']['id'],
                        'position' => $contact_person['position']['id']
                    )
                );
                $client->contact_persons()->save($client_contact_persons);
            }

            DB::table('client_manpower_providers')->where('client_id', $id)->delete();
            foreach($request['manpower_providers'] as $provider){
                $client_provider = new ClientManpowerProvider(array('manpower_provider' => $provider));
                $client->manpower_providers()->save($client_provider);
            }

            DB::table('client_sourcing_practices')->where('client_id', $id)->delete();

            foreach($request['sourcing_practices'] as $sp ){
                $client->sourcing_practices()->attach($sp);
            }

            //dispatch event for new created client
            $message = [
                'user' => auth()->user(),
                'response' => auth()->user()->name . " has updated ".$client->client_name." record",
                'client' => $client  
            ];
            broadcast(new ClientEvent($message))->toOthers();

            return ['message' => 'Changes has been saved.'];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete clietn record
        //delete sourcing practices records of client
        //delete manpower providers records of client
        //delete saturation record
        //delete call record 
        //delete presentation record
        //delete acquisition record
    }

}
