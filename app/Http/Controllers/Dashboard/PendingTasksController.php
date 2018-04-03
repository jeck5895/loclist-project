<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PendingTask;

class PendingTasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pending_tasks = PendingTask::get();
        $data =  [];
        $recentCall = $forCall7d = $forCall1m = $forCall3m = $forCall6m = $forCall1y = 0;
        $recentSaturation = $forSaturation7d = $forSaturation1m = $forSaturation3m = $forSaturation6m = $forSaturation1y = 0;
        $recentPresentation = $forPresentation7d = $forPresentation1m = $forPresentation3m = $forPresentation6m = $forPresentation1y = 0;
        $recentNegotiation = $forNegotiation7d = $forNegotiation1m = $forNegotiation3m = $forNegotiation6m = $forNegotiation1y = 0;

        foreach ($pending_tasks as $key => $pending_task) {
            
            if($pending_task->task_status_id == 1){
                if($pending_task->days_difference >= -1 && $pending_task->days_difference <= 6){
                    $recentCall = $recentCall + 1;
                }
                elseif($pending_task->days_difference >= 7 && $pending_task->days_difference <= 29){
                    $forCall7d = $forCall7d + 1;
                }
                elseif($pending_task->days_difference >= 30 && $pending_task->days_difference <= 89){
                    $forCall1m = $forCall1m + 1;
                }
                elseif($pending_task->days_difference >= 90 && $pending_task->days_difference <= 179){
                    $forCall3m = $forCall3m + 1;
                }
                elseif($pending_task->days_difference >= 180 && $pending_task->days_difference <= 364){
                    $forCall6m = $forCall6m + 1;
                }
                elseif($pending_task->days_difference >= 365) {
                    $forCall1y = $forCall1y + 1;
                }
            }
            elseif ($pending_task->task_status_id == 2) 
            {
                if ($pending_task->days_difference >= -1 && $pending_task->days_difference <= 6) {
                    $recentSaturation = $recentSaturation + 1;
                }
                elseif ($pending_task->days_difference >= 7 && $pending_task->days_difference <= 29) {
                    $forSaturation7d = $forSaturation7d + 1;
                } elseif ($pending_task->days_difference >= 30 && $pending_task->days_difference <= 89) {
                    $forSaturation1m = $forSaturation1m + 1;
                } elseif ($pending_task->days_difference >= 90 && $pending_task->days_difference <= 179) {
                    $forSaturation3m = $forSaturation3m + 1;
                } elseif ($pending_task->days_difference >= 180 && $pending_task->days_difference <= 364) {
                    $forSaturation6m = $forSaturation6m + 1;
                } elseif($pending_task->days_difference >= 365){
                    $forSaturation1y = $forSaturation1y + 1;
                }
            }
            elseif ($pending_task->task_status_id == 5) {
                if ($pending_task->days_difference >= -1 && $pending_task->days_difference <= 6) {
                    $recentPresentation = $recentPresentation + 1;
                }
                elseif ($pending_task->days_difference >= 7 && $pending_task->days_difference <= 29) {
                    $forPresentation7d = $forPresentation7d + 1;
                } elseif ($pending_task->days_difference >= 30 && $pending_task->days_difference <= 89) {
                    $forPresentation1m = $forPresentation1m + 1;
                } elseif ($pending_task->days_difference >= 90 && $pending_task->days_difference <= 179) {
                    $forPresentation3m = $forPresentation3m + 1;
                } elseif ($pending_task->days_difference >= 180 && $pending_task->days_difference <= 364) {
                    $forPresentation6m = $forPresentation6m + 1;
                } elseif($pending_task->days_difference >= 365){
                    $forPresentation1y = $forPresentation1y + 1;
                }
            }
            else {
                if ($pending_task->days_difference >= -1 && $pending_task->days_difference <= 6) {
                    $recentNegotiation = $recentNegotiation + 1;
                }
                elseif ($pending_task->days_difference >= 7 && $pending_task->days_difference <= 29) {
                    $forNegotiation7d = $forNegotiation7d + 1;
                } elseif ($pending_task->days_difference >= 30 && $pending_task->days_difference <= 89) {
                    $forNegotiation1m = $forNegotiation1m + 1;
                } elseif ($pending_task->days_difference >= 90 && $pending_task->days_difference <= 179) {
                    $forNegotiation3m = $forNegotiation3m + 1;
                } elseif ($pending_task->days_difference >= 180 && $pending_task->days_difference <= 364) {
                    $forNegotiation6m = $forNegotiation6m + 1;
                } elseif($pending_task->days_difference >= 365) {
                    $forNegotiation1y = $forNegotiation1y + 1;
                }

            }

        }

        return $data = [
                [
                        'task_id' => 1,
                        'task_name' => 'FOR PRE-CALL',
                        'recent' => $recentCall,
                        'seven_days' => $forCall7d,
                        'one_month' => $forCall1m,
                        'three_months' => $forCall3m,
                        'six_months' => $forCall6m,
                        'one_year' => $forCall1y
                    
                ],
                [
                        'task_id' => 2,
                        'task_name' => 'FOR SATURATION',
                        'recent' => $recentSaturation,
                        'seven_days' => $forSaturation7d,
                        'one_month' => $forSaturation1m,
                        'three_months' => $forSaturation3m,
                        'six_months' => $forSaturation6m,
                        'one_year' => $forSaturation1y
                    
                ],
                [
                        'task_id' => 5,
                        'task_name' => 'FOR FOLLOW-UP ON PRESENTATION',
                        'recent' => $recentPresentation,
                        'seven_days' => $forPresentation7d,
                        'one_month' => $forPresentation1m,
                        'three_months' => $forPresentation3m,
                        'six_months' => $forPresentation6m,
                        'one_year' => $forPresentation1y
                    
                ],
                [
                        'task_id' => 4,
                        'task_name' => 'FOR FOLLOW-UP NEGOTIATION',
                        'recent' => $recentNegotiation,
                        'seven_days' => $forNegotiation7d,
                        'one_month' => $forNegotiation1m,
                        'three_months' => $forNegotiation3m,
                        'six_months' => $forNegotiation6m,
                        'one_year' => $forNegotiation1y,
                ]  
        ];
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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

    public function clientsList($task_name, $task_id, $range) 
    {
        
        $client_list = PendingTask::where(function($query) use ($task_id, $range){
            
            if($range == 0) {
                $query->where([
                    ['days_difference', '>=', $range],
                    ['days_difference', '<=', 6],
                    ['task_status_id', '=', $task_id]
                ]);
            }
            elseif($range == 7) {
                $query->where([
                    ['days_difference', '>=', $range],
                    ['days_difference', '<=', 29],
                    ['task_status_id', '=', $task_id]
                ]);
            }
            elseif ($range == 30){
                $query->where([
                    ['days_difference', '>=', $range],
                    ['days_difference', '<=', 89],
                    ['task_status_id', '=', $task_id]
                ]);
            }
            elseif ($range == 90) {
                $query->where([
                    ['days_difference', '>=', $range],
                    ['days_difference', '<=', 179],
                    ['task_status_id', '=', $task_id]
                ]);

            }
            elseif ($range == 180) {
                $query->where([
                    ['days_difference', '>=', $range],
                    ['days_difference', '<=', 364],
                    ['task_status_id', '=', $task_id]
                ]);

            }
            elseif ($range == 365) {
                $query->where([
                    ['days_difference', '>=', $range],
                    // ['days_difference', '<=', 364],
                    ['task_status_id', '=', $task_id]
                ]);

            }
        })->with('contact_persons.department')
        ->with('contact_persons.position')
        ->get();

        return $client_list;
    }
}
