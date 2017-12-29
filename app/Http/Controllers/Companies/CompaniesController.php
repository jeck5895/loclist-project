<?php

namespace App\Http\Controllers\Companies;

use Illuminate\Http\Request;
use App\Company;
use App\Http\Controllers\Controller;
use App\Http\Requests\Companies\StoreCompany;
use App\Http\Requests\Companies\UpdateCompany;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(isset($_GET['type']) && $_GET['type'] == 'all'){
            $companies = Company::active()->get();
        }
        else{
            $companies = Company::active()->paginate(5);
        }
        
        return $companies;
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
    public function store(StoreCompany $request)
    {
        $company = Company::create([
            'company_name' => $request['company_name'],
            'code' => $request['code']
        ]);

        return ['message' => 'Company has been saved'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::find($id);

        return $company;
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
    public function update(UpdateCompany $request, $id)
    {
        $company = Company::find($id)
                    ->update([
                        'company_name' => $request['company_name'],
                        'code' => $request['code']
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
        if(auth()->user()->userType != 1)
        {
            // abort(403,'Request Unauthorized');
            return response('Unauthorized action', 403);
        }
        Company::destroy($id);

        return ['message' => 'Record has been deleted'];
    }
}
