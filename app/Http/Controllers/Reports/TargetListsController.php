<?php

namespace App\Http\Controllers\Reports;

use App\ReportTargetList;
use App\ReportMonth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Reports\StoreTargetList;
use App\Http\Requests\Reports\UpdateTargetList;

class TargetListsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $target_lists = ReportTargetList::orderBy('target_year','asc')->orderBy('month_id','asc')->with('report_month')->paginate(12);

        return $target_lists;
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
    public function store(StoreTargetList $request)
    {
        $target_list_id = ReportTargetList::create([
            'month_id' => $request['month_id'],
            'target_increase_potential_client' => $request['target_increase_potential_client'],
            'target_no_of_calls_made' => $request['target_no_of_calls_made'],
            'target_proposal_tobe_sent' => $request['target_proposal_tobe_sent'],
            'target_no_formal_presentation' => $request['target_no_formal_presentation'],
            'target_client_tobe_acquired' => $request['target_client_tobe_acquired'],
            'target_year' => $request['target_year'],
        ])->id;

        $report_month = ReportMonth::find($request['month_id']);

        return ['message' => 'Target list has been set for '. ucfirst(strtolower( $report_month->name)) .", ". $request['target_year']];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ReportTargetList  $reportTargetList
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $target_list = ReportTargetList::find($id);
        return $target_list;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ReportTargetList  $reportTargetList
     * @return \Illuminate\Http\Response
     */
    public function edit(ReportTargetList $reportTargetList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ReportTargetList  $reportTargetList
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTargetList $request, $id)
    {
        $target_list = ReportTargetList::find($id)
                        ->update([
                            'month_id' => $request['month_id'],
                            'target_increase_potential_client' => $request['target_increase_potential_client'],
                            'target_no_of_calls_made' => $request['target_no_of_calls_made'],
                            'target_proposal_tobe_sent' => $request['target_proposal_tobe_sent'],
                            'target_no_formal_presentation' => $request['target_no_formal_presentation'],
                            'target_client_tobe_acquired' => $request['target_client_tobe_acquired'],
                            'target_year' => $request['target_year'],
                        ]);

        return ['message' => 'Changes has been saved'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ReportTargetList  $reportTargetList
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReportTargetList $reportTargetList)
    {
        //
    }

    public function years() {
        $years = ReportTargetList::select('target_year')->distinct()->orderBy('target_year','DESC')->get();

        return $years;
    }
}
