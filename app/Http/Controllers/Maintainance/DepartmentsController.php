<?php

namespace App\Http\Controllers\Maintainance;

use Illuminate\Http\Request;
use App\Http\Requests\Maintainance\Department\StoreDepartment;
use App\Http\Requests\Maintainance\Department\UpdateDepartment;
use App\Http\Controllers\Controller;
use App\Department;

class DepartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(isset($_GET['type']) && $_GET['type'] == 'all'){
            $deparments = Department::active()->orderBy('department_name','asc')->get();
        }
        else{
            $deparments = Department::active()->orderBy('department_name','asc')->paginate(10);
        }

        return $deparments;
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
    public function store(StoreDepartment $request)
    {
        $department = Department::create([
            'department_name' => $request['department_name']
        ]);

        return ['message' => 'Department has been saved'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $department = Department::find($id);

        return $department;
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
    public function update(UpdateDepartment $request, $id)
    {
        $department = Department::find($id)
                        ->update([
                            'department_name' => $request['department_name']
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
        Department::destroy($id);

        return  [
            'message' => 'Record has been deleted',
            'status' => 'OK'
        ];
    }
}
