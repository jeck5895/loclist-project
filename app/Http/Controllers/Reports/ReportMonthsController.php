<?php

namespace App\Http\Controllers\Reports;

use App\ReportMonth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportMonthsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $report_months = ReportMonth::get();

        return $report_months;
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reports\ReportMonth  $reportMonth
     * @return \Illuminate\Http\Response
     */
    public function show(ReportMonth $reportMonth)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reports\ReportMonth  $reportMonth
     * @return \Illuminate\Http\Response
     */
    public function edit(ReportMonth $reportMonth)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reports\ReportMonth  $reportMonth
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReportMonth $reportMonth)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reports\ReportMonth  $reportMonth
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReportMonth $reportMonth)
    {
        //
    }
}
