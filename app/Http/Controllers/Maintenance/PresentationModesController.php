<?php

namespace App\Http\Controllers\Maintenance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ModeOfPresentation;
use App\Http\Requests\Maintenance\Presentation\StorePresentationMode;
use App\Http\Requests\Maintenance\Presentation\UpdatePresentationMode;

class PresentationModesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         if(isset($_GET['type']) && $_GET['type'] == 'all'){
            $presentation_modes = ModeOfPresentation::orderBy('presentation_mode','asc')->get();
        }
        else{
            $presentation_modes = ModeOfPresentation::orderBy('presentation_mode','asc')->paginate(10);
        }

        return $presentation_modes;
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
    public function store(StorePresentationMode $request)
    {
        ModeOfPresentation::create([
            'presentation_mode' => $request['presentation_mode']
        ]);

        return ['message' => 'New Record has been saved'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mode = ModeOfPresentation::find($id);

        return $mode;
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
    public function update(UpdatePresentationMode $request, $id)
    {
        ModeOfPresentation::find($id)
                    ->update([
                        'presentation_mode' => $request['presentation_mode']
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
        if(auth()->user()->userRole->id != 1)
            return response()->json(['message' => 'This action is unauthorized.'], 403);
        
        ModeOfPresentation::destroy($id);

        return ['message' => 'Record has been deleted'];
    }
}
