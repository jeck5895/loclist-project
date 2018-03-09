<?php

namespace App\Http\Controllers\Maintenance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Maintenance\Certificate\StoreCertificate;
use App\Http\Requests\Maintenance\Certificate\UpdateCertificate;
use App\Certificate;
use App\Events\MaintenanceEvent;

class CertificatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(isset($_GET['type']) && $_GET['type'] == 'all'){
            $certificates = Certificate::active()->orderBy('iso_name','asc')->get();
        }
        else{
            $certificates = Certificate::active()->orderBy('iso_name','asc')->paginate(10);
        }
        
        return $certificates;
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
    public function store(StoreCertificate $request)
    {
        Certificate::create([
            'iso_name' => $request['iso_name']
        ]);
        
        event(new MaintenanceEvent('certificates'));

        return ['message' => 'Certificate has been saved'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $certificate = Certificate::find($id);
        
        return $certificate;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCertificate $request, $id)
    {
        $certificate = Certificate::find($id)
                        ->update([
                            'iso_name' => $request['iso_name']
                        ]);
        
        event(new MaintenanceEvent('certificates'));

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
        if(auth()->user()->userRole->id != 1)
            return response()->json(['message' => 'This action is unauthorized.'], 403);
        
        Certificate::destroy($id);

        event(new MaintenanceEvent('certificates'));

        return  [
            'message' => 'Record has been deleted',
            'status' => 'OK'
        ];
    }
}
