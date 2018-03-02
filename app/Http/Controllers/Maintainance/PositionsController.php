<?php

namespace App\Http\Controllers\Maintainance;

use Illuminate\Http\Request;
use App\Http\Requests\Maintainance\Position\StorePosition;
use App\Http\Requests\Maintainance\Position\UpdatePosition;
use App\Http\Controllers\Controller;
use App\Position;
use App\Events\MaintainanceEvent;

class PositionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(isset($_GET['type']) && $_GET['type'] == 'all')
        {
            $department = $request->department;
            $positions = Position::active()
            ->when($department, function($query) use($department) {
                return $query->where('department_id', $department);
            })
            ->with('department')->orderBy('position_name','asc')->get();
        }
        // if(isset($_GET['department']))
        // {
        //     $positions = Position::active()->where('department_id', $request->department)->with('department')->orderBy('position_name','asc')->get();
        // }
        else{
            $positions = Position::active()->with('department')->orderBy('position_name','asc')->paginate(10);
        }

        return $positions;
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
    public function store(StorePosition $request)
    {
        $position = Position::create([
            'department_id' => $request['department_id'],
            'position_name' => $request['position_name']
        ]);

        event(new MaintainanceEvent('positions'));

        return ['message' => 'Position has been saved'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $position = Position::find($id);

        return $position;
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
    public function update(UpdatePosition $request, $id)
    {
        $position = Position::find($id)
                    ->update([
                        'department_id' => $request['department_id'],
                        'position_name' => $request['position_name']
                    ]);
        event(new MaintainanceEvent('positions'));
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
        
        Position::destroy($id);
        event(new MaintainanceEvent('positions'));
        return  [
            'message' => 'Record has been deleted',
            'status' => 'OK'
        ];
    }
}
