<?php
declare(strict_types=1);
namespace App\Http\Controllers\Reports;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Excel;
use App\VwClient;
use Carbon\Carbon;

class KPIAnalysisReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('vw_kpi_report_potential_clients')->where('target_year', 2017)->get();

        //return $data->target_month;//
        return response()->json($data);
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
        //return $request;
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

    public function export(Request $request)
    {
        // $from_date = Carbon::createFromFormat('Y-m-d H:i:s', $request['from_date']." 00:00:00");//date('Y-m-d H:i:s', strtotime($from_date));
        //$to_date = Carbon::createFromFormat('Y-m-d H:i:s', $request['to_date']. "23:59:59");//date('Y-m-d 23:59:59', strtotime($to_date));
        //$clients = VwClient::select()->whereBetween('created_at',[$from_date, $to_date])->get();
        // $formatted_from_date = date('YMd', strtotime($request['from_date']));
        // $formatted_to_date = date('YMd', strtotime($request['to_date']));
        $report_year = $request['report_year'];
        
        $date = $request['report_year'];

        $report1_data = DB::table('vw_kpi_report_potential_clients')->where('target_year', $report_year)->get();
        $report2A_data = DB::table('vw_kpi_report2a')->where('target_year', $report_year)->get();
        $report2B_data = DB::table('vw_kpi_report2b')->where('target_year', $report_year)->get();
        $report2C_data = DB::table('vw_kpi_report2c')->where('target_year', $report_year)->get();
        $report2D_data = DB::table('vw_kpi_report2d')->where('target_year', $report_year)->get();
        $report2E_data = DB::table('vw_kpi_report2e')->where('target_year', $report_year)->get();
        $report2F_data = DB::table('vw_kpi_report2f')->where('target_year', $report_year)->get();
        $report2F1_data = DB::table('vw_kpi_report2f1')->where('target_year', $report_year)->get();
        $report3_data = DB::table('vw_kpi_report3')->where('target_year', $report_year)->get();
        $report4_data = DB::table('vw_kpi_report4')->where('target_year', $report_year)->get();
     
        $file = Excel::create('NB_LOCATORSLIST_'.$report_year.' - '.date('YMd'), function ($excel) use ($report1_data, $report2A_data, $report2B_data, $report2C_data , $report2D_data, $report2E_data, $report2F_data, $report2F1_data, $report3_data, $report4_data, $date) {
            $excel->setTitle('KPI Analysis NB GROUP')
                ->setCreator(auth()->user()->name)
                ->setCompany('Serbisyo Outsourcing Facility Inc.');
            //Create excel sheet
            $excel->sheet('KPI Analysis NB Group', function ($sheet) use ($report1_data, $report2A_data, $report2B_data, $report2C_data, $report2D_data, $report2E_data, $report2F_data, $report2F1_data, $report3_data, $report4_data, $date) {
                $report1_row = 12;
                $report2A_row = 34;
                $report2B_row = 54;
                $report2C_row = 74;
                $report2D_row = 94;
                $report2E_row = 114;
                $report2F_row = 134;
                $report2F1_row = 154;
                $report3_row = 175;
                $report4_row = 196;
                $total_clients = 0;
                $total_target_r1 = 0;
                $total_percentage_r1 = 0;
                $blank_rows = [
                                15, 19, 23, 27,
                                37, 41, 45, 49,
                                57, 61, 65, 69,
                                77, 81, 85, 89,
                                97, 101, 105, 109,
                                117, 121, 125, 129,
                                137, 141, 145, 149,
                                157, 161, 165, 169,
                                178, 182, 186, 190,
                                199, 203, 207, 211
                            ];
                $current_quarter = 0;

                /** Start Loop report 1 data */
                foreach ($report1_data as $key => $report1) {
                    /** Check if current row is in blank rows which are rows for quarter 1,2,3,4 */
                    if ($boolean = in_array($report1_row + $key, $blank_rows)) {
                        if ($current_quarter == 1) {
                            $sheet->setCellValueByColumnAndRow(1, $report1_row + $key, "Q" . $current_quarter);
                        }
                        if ($current_quarter == 2) {
                            $sheet->setCellValueByColumnAndRow(1, $report1_row + $key, "Q" . $current_quarter);
                        }
                        if ($current_quarter == 3) {
                            $sheet->setCellValueByColumnAndRow(1, $report1_row + $key, "Q" . $current_quarter);
                        }
                        $sheet->setCellValueByColumnAndRow(2, $report1_row + $key, $total_clients);
                        $sheet->setCellValueByColumnAndRow(3, $report1_row + $key, $total_target_r1);
                        $sheet->setCellValueByColumnAndRow(4, $report1_row + $key, round($total_percentage_r1, 2) . "%");
                        $sheet->setCellValueByColumnAndRow(5, $report1_row + $key, 100 . "%");
                        $sheet->setCellValueByColumnAndRow(6, $report1_row + $key, $status);

                        $report1_row = $report1_row + 1;
                    }
                    /** start report 1 computation */
                    $report1_percentage = $report1->clients_count != null ? (intval($report1->clients_count) / intval($report1->target_increase_potential_client))*100:0;
                    $total_clients = $total_clients + $report1->clients_count;
                    $total_target_r1 = $total_target_r1 + $report1->target_increase_potential_client;
                    $total_percentage_r1 = ($total_clients / $total_target_r1) * 100;
                    $current_quarter = $report1->quarter;
                    $status = $report1_percentage >=  100 ? "MET" : "UNMET";
                    /** end report 1 computation */
                        
                    /** start setting value report 1 */
                    $sheet->setCellValueByColumnAndRow(1, $report1_row + $key, $report1->target_month); // . $report1_row."+".$key
                    $sheet->setCellValueByColumnAndRow(2, $report1_row + $key, $report1->clients_count != null ? $report1->clients_count : 0);
                    $sheet->setCellValueByColumnAndRow(3, $report1_row + $key, $report1->target_increase_potential_client); //. "|".$bolean
                    $sheet->setCellValueByColumnAndRow(4, $report1_row + $key, $report1_percentage . "%");
                    $sheet->setCellValueByColumnAndRow(5, $report1_row + $key, 100 . "%");
                    $sheet->setCellValueByColumnAndRow(6, $report1_row + $key, $status);
                    /** end setting vaue report 1 */
                }
                /** End Loop Report 1 */

                /** Start setting value for quarter 4 report 1 */
                $sheet->setCellValueByColumnAndRow(1, 27, "Q" . 4);
                $sheet->setCellValueByColumnAndRow(2, 27, $total_clients);
                $sheet->setCellValueByColumnAndRow(3, 27, $total_target_r1);
                $sheet->setCellValueByColumnAndRow(4, 27, round($total_percentage_r1, 2) . "%");
                $sheet->setCellValueByColumnAndRow(5, 27, 100 . "%");
                $sheet->setCellValueByColumnAndRow(6, 27, $status);
                    
                /**
                 * Start Report 2
                 *
                 */
                $this->generate_report2($sheet, $report2A_data, $report2A_row, $blank_rows, 49);//2A  last row for Quarter 4
                $this->generate_report2($sheet, $report2B_data, $report2B_row, $blank_rows, 69);//2B last row for Quarter 4
                $this->generate_report2($sheet, $report2C_data, $report2C_row, $blank_rows, 89); //2C last row for Quarter 4
                $this->generate_report2($sheet, $report2D_data, $report2D_row, $blank_rows, 109);//2D last row for Quarter 4
                $this->generate_report2($sheet, $report2E_data, $report2E_row, $blank_rows, 129);//2E last row for Quarter 4
                $this->generate_report2($sheet, $report2F_data, $report2F_row, $blank_rows, 149);//2F  last row for Quarter 4
                $this->generate_report2($sheet, $report2F1_data, $report2F1_row, $blank_rows, 169);//2F1 last row for Quarter 4
                $this->generate_report2($sheet, $report3_data, $report3_row, $blank_rows, 190); //3 last row for Quarter 4
                $this->generate_report2($sheet, $report4_data, $report4_row, $blank_rows, 211);

                $sheet->cells('B12:B211', function ($cells) {
                    $cells->setFontWeight('bold');
                });

                $sheet->mergeCells('A1:J1');
                $sheet->cells('A1:J1', function ($cells) {
                    $cells->setAlignment('center');
                    $cells->setFontSize(16);
                    $cells->setFontWeight('bold');
                });
                $sheet->row('1', array(
                        'FUNCTIONAL QUALITY OBJECTIVE-MONITORING'
                    ));
                $sheet->mergeCells('A2:B2');
                $sheet->cell('A2', function ($cell) {
                    $cell->setValue('GROUP/SECTION:');
                });
                $sheet->cells('A2:B2', function ($cells) {
                    $cells->setFontSize(12);
                    $cells->setFontWeight('bold');
                    $cells->setBorder('thin', 'thin', 'thin', 'thin');
                });
                  
                $sheet->mergeCells('C2:J2');
                $sheet->cell('C2', function ($cell) {
                    $cell->setValue('NEW BUSINESS');
                });
                $sheet->cells('C2:J2', function ($cells) {
                    $cells->setAlignment('center');
                    $cells->setFontWeight('bold');
                    $cells->setBorder('thin', 'thin', 'thin', 'thin');
                });
         
                $sheet->mergeCells('A3:B3');
                $sheet->cell('A3', function ($cell) {
                    $cell->setValue('YEAR:');
                });

                $sheet->cells('A3:B3', function ($cells) {
                    $cells->setFontSize(12);
                    $cells->setFontWeight('bold');
                    $cells->setBorder('thin', 'thin', 'thin', 'thin');
                });

                $sheet->mergeCells('C3:D3');
                $sheet->cell('C3', function ($cell) use ($date) {
                    $cell->setValue($date);
                    //$year = date("Y", strtotime($date['from_date'])) . "-" .date("Y", strtotime($date['to_date']));
                    // if (date("Y", strtotime($date['from_date'])) == date("Y", strtotime($date['to_date']))) {
                    //     $cell->setValue(date("Y", strtotime($date['from_date'])));
                    // } else {
                    //     $cell->setValue($year);
                    // }
                });
                $sheet->cells('C3:D3', function ($cells) {
                    $cells->setFontSize(12);
                    $cells->setFontWeight('bold');
                    $cells->setBorder('thin', 'thin', 'thin', 'thin');
                    $cells->setAlignment('center');
                });
                    
                    
                $sheet->mergeCells('E3:G3');
                $sheet->cell('E3', function ($cell) {
                    $cell->setValue('QUARTER');
                });
                $sheet->cells('E3:G3', function ($cells) {
                    $cells->setFontSize(12);
                    $cells->setFontWeight('bold');
                    $cells->setBorder('thin', 'thin', 'thin', 'thin');
                });
                    

                $sheet->mergeCells('H3:J3');
                $sheet->cell('H3', function ($cell) {
                    $cell->setValue('4th QUARTER');
                });
                $sheet->cells('H3:J3', function ($cells) {
                    $cells->setFontSize(12);
                    $cells->setFontWeight('bold');
                    $cells->setBorder('thin', 'thin', 'thin', 'thin');
                    $cells->setAlignment('center');
                });
                    

                $sheet->mergeCells('A6:B6');
                $sheet->cell('A6', function ($cell) {
                    $cell->setValue('PROCESS OWNER:');
                });
                $sheet->setBorder('A6:B6', 'thin');
                $sheet->cells('A6:B6', function ($cells) {
                    $cells->setFontSize(12);
                    $cells->setFontWeight('bold');
                });
                    

                $sheet->cell('D6', function ($cell) {
                    $cell->setValue('NB GROUP');
                });
                    
                $sheet->cells('D6', function ($cells) {
                    $cells->setFontSize(12);
                    $cells->setFontWeight('bold');
                    $cells->setBorder('thin', 'thin', 'thin', 'thin');
                    $cells->setAlignment('center');
                });

                /**
                 * Start Sub headers with numbers
                 */

                $sheet->cell('A8', function ($cell) {
                    $cell->setValue('1');
                });
                $sheet->cell('A29', function ($cell) {
                    $cell->setValue('2');
                });
                $sheet->cell('A171', function ($cell) {
                    $cell->setValue('3');
                });
                $sheet->cell('A192', function ($cell) {
                    $cell->setValue('4');
                });
                $sheet->cell('A213', function ($cell) {
                    $cell->setValue('5');
                });
                    
                $sub_number_arr = [8, 29, 171, 192, 213];
                for ($i = 0; $i < count($sub_number_arr); $i++) {
                    $sheet->row($sub_number_arr[$i], function ($row) {
                        $row->setAlignment('center');
                        $row->setFontColor('#4286f4');
                        $row->setFontWeight('bold');
                    });
                }
                /** End*/
                /**
                 * Start Sub header beside numbering 1. 2. 3.4.5
                 */
                $sheet->mergeCells('B8:E8');
                $sheet->cell('B8', function ($cell) {
                    $cell->setValue('To increase database of potential clients');
                });
                    
                $sheet->mergeCells('B29:J29');
                $sheet->cell('B29', function ($cell) {
                    $cell->setValue('To ensure steady growth of client base in all areas regardless of territory and to ensure that proposals made to prospective clients are accepted.');
                });

                $sheet->mergeCells('B171:E171');
                $sheet->cell('B171', function ($cell) {
                    $cell->setValue('To increase number of Clients by at least one (1) per quarter');
                });

                $sheet->mergeCells('B192:G192');
                $sheet->cell('B192', function ($cell) {
                    $cell->setValue('To secure a duly-signed Service Contract which is approved by the Client and the Company.');
                });

                $sheet->mergeCells('B213:G213');
                $sheet->cell('B213', function ($cell) {
                    $cell->setValue('To ensure continual improvement of the process and to provide corrective action to prevent recurrence of a nonconformity raised');
                });
                $sheet->getStyle('B213')->getAlignment()->setWrapText(true);
                    
                for ($i = 0; $i < count($sub_number_arr); $i++) {
                    $sheet->cells('B'.$sub_number_arr[$i], function ($cells) {
                        $cells->setAlignment('center');
                        $cells->setFontColor('#4286f4');
                        $cells->setFontWeight('bold');
                    });
                }
                /**END */
                    
                /**
                 * Start Sub headers Letters for no.2 A, B, C, D, E, F
                 * 2 To ensure steady growth of client base in all areas regardless of territory and to ensure that proposals made to prospective clients are accepted
                 */
                $sub_letters_arr = [31, 51, 71, 91, 111, 131, 151];
                    
                $sheet->cell('B31', function ($cell) {
                    $cell->setValue('A');
                });
                $sheet->cell('B51', function ($cell) {
                    $cell->setValue('B');
                });
                $sheet->cell('B71', function ($cell) {
                    $cell->setValue('C');
                });
                $sheet->cell('B91', function ($cell) {
                    $cell->setValue('D');
                });
                $sheet->cell('B111', function ($cell) {
                    $cell->setValue('E');
                });
                $sheet->cell('B131', function ($cell) {
                    $cell->setValue('F');
                });
                $sheet->mergeCells('B151:C151');
                $sheet->cell('B151', function ($cell) {
                    $cell->setValue('F.1 FOR ANALYSIS ONLY');
                });
                    
                for ($i = 0; $i < count($sub_letters_arr); $i++) {
                    $sheet->cells('B'.$sub_letters_arr[$i], function ($cells) {
                        $cells->setAlignment('left');
                        $cells->setFontColor('#4286f4');
                        $cells->setFontWeight('bold');
                    });
                }
                /** END */
                /**
                 * 5.A | 5.B | 5.C | 5.D | 5.E
                 */

                $sub5_letters_arr = [215, 237, 259, 281, 303];
                    
                $sheet->cell('B215', function ($cell) {
                    $cell->setValue('A');
                });
                $sheet->cell('B237', function ($cell) {
                    $cell->setValue('B');
                });
                $sheet->cell('B259', function ($cell) {
                    $cell->setValue('C');
                });
                $sheet->cell('B281', function ($cell) {
                    $cell->setValue('D');
                });
                $sheet->cell('B303', function ($cell) {
                    $cell->setValue('E');
                });
                    
                for ($i = 0; $i < count($sub5_letters_arr); $i++) {
                    $sheet->cells('B'.$sub5_letters_arr[$i], function ($cells) {
                        $cells->setAlignment('left');
                        $cells->setFontColor('#4286f4');
                        $cells->setFontWeight('bold');
                    });
                }
                /** END */

                $sub_row_no2 = [10, 32, 52, 72, 92, 112, 132, 152, 173, 194, 216, 238, 260, 282, 304];
                for ($i = 0; $i < count($sub_row_no2); $i++) {
                    $sheet->mergeCells('B'.$sub_row_no2[$i].':'.'F'.$sub_row_no2[$i]);
                        
                    $sheet->setBorder('B'.$sub_row_no2[$i].':'.'F'.$sub_row_no2[$i], 'thick');
                    $sheet->cells('B'.$sub_row_no2[$i].':'.'F'.$sub_row_no2[$i], function ($cells) {
                        $cells->setAlignment('center');
                        $cells->setValignment('center');
                        $cells->setFontWeight('bold');
                    });
                    $sheet->getStyle('B'.$sub_row_no2[$i])->getAlignment()->setWrapText(true);
                }
                /**Start A header/subheaders */
                $sheet->cell('B10', function ($cell) {
                    $cell->setValue('Increase in prospective clients listing vs No. of clients per existing database');
                });
                $sheet->cell('B11', function ($cell) {
                    $cell->setValue('Months');
                });
              
                $sheet->cell('C11', function ($cell) {
                    $cell->setValue('Increase in prospective clients listing');
                });
                $sheet->getStyle('C11')->getAlignment()->setWrapText(true);

                $sheet->cell('D11', function ($cell) {
                    $cell->setValue('Target increase in prospective clients listing per existing database');
                    $cell->setFontSize(9);
                });
                $sheet->getStyle('D11')->getAlignment()->setWrapText(true); //Wrap text for this cell

                $sheet->cell('E11', function ($cell) {
                    $cell->setValue('Percentage %');
                });

                $sheet->cell('F11', function ($cell) {
                    $cell->setValue('Target');
                });
                /**END */
                    
                /**
                 * START 2.A headers
                 */
                $sheet->cell('B32', function ($cell) {
                    $cell->setValue('Target No. of Calls vs. No. of Calls made');
                });
                $sub2A_headers_arr = [
                        'B33' => 'Months', 'C33' => 'No. of Calls Made', 'D33'=>'Target No. of Calls Made',
                        'E33' =>'Percentage %', 'F33' => 'Target'
                    ];
                foreach ($sub2A_headers_arr as $cell => $value) {
                    $sheet->cell($cell, function ($cell) use ($value) {
                        $cell->setValue($value);
                    });
                    $sheet->getStyle($cell)->getAlignment()->setWrapText(true);
                }
                $sheet->cells('B33:F33', function ($cells) {
                    $cells->setFontWeight('bold');
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });
                /** END */
                /**
                 * Start 2.B headers
                 */
                $sheet->cell('B52', function ($cell) {
                    $cell->setValue('No. of productive calls made vs.  Actual No. of proposal sent related to calls made');
                });
                $sub2B_headers_arr = [
                        'B53' => 'Months', 'C53' => 'Actual No. of proposal sent related to calls made', 'D53'=>'No. of Productive Calls',
                        'E53' =>'Percentage %', 'F53' => 'Target'
                    ];
                foreach ($sub2B_headers_arr as $cell => $value) {
                    $sheet->cell($cell, function ($cell) use ($value) {
                        $cell->setValue($value);
                    });
                    $sheet->getStyle($cell)->getAlignment()->setWrapText(true);
                }
                $sheet->cells('B53:F53', function ($cells) {
                    $cells->setFontWeight('bold');
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });
                /** END */

                /**START 2C header */
                $sheet->cell('B72', function ($cell) {
                    $cell->setValue('Actual No. of Proposal sent vs Target Proposal to be sent out');
                });
                $sub2C_headers_arr = [
                        'B73' => 'Months', 'C73' => 'Actual No. of proposal sent', 'D73'=>'Target Proposal to be sent out',
                        'E73' =>'Percentage %', 'F73' => 'Target'
                    ];
                foreach ($sub2C_headers_arr as $cell => $value) {
                    $sheet->cell($cell, function ($cell) use ($value) {
                        $cell->setValue($value);
                    });
                    $sheet->getStyle($cell)->getAlignment()->setWrapText(true);
                }
                $sheet->cells('B73:F73', function ($cells) {
                    $cells->setFontWeight('bold');
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });

                /**END */

                /**START 2D header*/
                $sheet->cell('B92', function ($cell) {
                    $cell->setValue('No. of proposal submitted vs No. of proposals  received and accepted');
                });
                $sub2D_headers_arr = [
                        'B93' => 'Months', 'C93' => 'No. of proposals receive and accepted', 'D93'=>'Actual No. of Proposal sent',
                        'E93' =>'Percentage %', 'F93' => 'Target'
                    ];
                foreach ($sub2D_headers_arr as $cell => $value) {
                    $sheet->cell($cell, function ($cell) use ($value) {
                        $cell->setValue($value);
                    });
                    $sheet->getStyle($cell)->getAlignment()->setWrapText(true);
                }
                $sheet->cells('B93:F93', function ($cells) {
                    $cells->setFontWeight('bold');
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });
                /**END */

                /**START 2E header */
                $sheet->cell('B112', function ($cell) {
                    $cell->setValue('No. of proposals  received and accepted  vs. No. of Follow-up calls made related to accepted and received proposals');
                });
                $sub2E_headers_arr = [
                        'B113' => 'Months', 'C113' => 'No. of follow-up calls made related to submitted proposals', 'D113'=>'No. of Proposals received and accepted',
                        'E113' =>'Percentage %', 'F113' => 'Target'
                    ];
                foreach ($sub2E_headers_arr as $cell => $value) {
                    $sheet->cell($cell, function ($cell) use ($value) {
                        $cell->setValue($value);
                    });
                    $sheet->getStyle($cell)->getAlignment()->setWrapText(true);
                }
                $sheet->cells('B113:F113', function ($cells) {
                    $cells->setFontWeight('bold');
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });
                /**END */

                /**START 2F */
                $sheet->cell('B132', function ($cell) {
                    $cell->setValue('Actual No. of Formal Presentation vs. Target Number of Formal Presentation');
                });
                $sub2F_headers_arr = [
                        'B133' => 'Months', 'C133' => 'Actual No. of Formal Presentation', 'D133'=>'Target Number of Formal Presentation',
                        'E133' =>'Percentage %', 'F133' => 'Target'
                    ];
                foreach ($sub2F_headers_arr as $cell => $value) {
                    $sheet->cell($cell, function ($cell) use ($value) {
                        $cell->setValue($value);
                    });
                    $sheet->getStyle($cell)->getAlignment()->setWrapText(true);
                }
                $sheet->cells('B133:F133', function ($cells) {
                    $cells->setFontWeight('bold');
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });
                /**END */

                /**START 2F.1 FOR ANALYSIS ONLY */
                $sheet->cell('B152', function ($cell) {
                    $cell->setValue('Actual No. of CALL Presentation vs. Actual No. of Formal Presentation');
                });
                $sub2F1_headers_arr = [
                        'B153' => 'Months', 'C153' => 'Actual No. of Call Presentation', 'D153'=>'Actual No. of Formal Presentation',
                        'E153' =>'Percentage %', 'F153' => 'Target'
                    ];
                foreach ($sub2F1_headers_arr as $cell => $value) {
                    $sheet->cell($cell, function ($cell) use ($value) {
                        $cell->setValue($value);
                    });
                    $sheet->getStyle($cell)->getAlignment()->setWrapText(true);
                }
                $sheet->cells('B153:F153', function ($cells) {
                    $cells->setFontWeight('bold');
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });
                /**END */

                /**START 3. */
                $sheet->cell('B173', function ($cell) {
                    $cell->setValue('Number of Newly acquired Client');
                });
                $sub3_headers_arr = [
                        'B174' => 'Months', 'C174' => 'Number of client acquired', 'D174'=>'Target Number of client to be acquired',
                        'E174' =>'Percentage %', 'F174' => 'Target'
                    ];
                foreach ($sub3_headers_arr as $cell => $value) {
                    $sheet->cell($cell, function ($cell) use ($value) {
                        $cell->setValue($value);
                    });
                    $sheet->getStyle($cell)->getAlignment()->setWrapText(true);
                }
                $sheet->cells('B174:F174', function ($cells) {
                    $cells->setFontWeight('bold');
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });
                /**END */

                /**START 4 */
                $sheet->cell('B194', function ($cell) {
                    $cell->setValue('Number of duly-signed contracts vs. number of client acquired');
                });
                $sub4_headers_arr = [
                        'B195' => 'Months', 'C195' => 'Number duly-signed contract/s', 'D195'=>'Number of client acquired',
                        'E195' =>'Percentage %', 'F195' => 'Target'
                    ];
                foreach ($sub4_headers_arr as $cell => $value) {
                    $sheet->cell($cell, function ($cell) use ($value) {
                        $cell->setValue($value);
                    });
                    $sheet->getStyle($cell)->getAlignment()->setWrapText(true);
                }
                $sheet->cells('B195:F195', function ($cells) {
                    $cells->setFontWeight('bold');
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });
                /**END */

                /**
                 * START 5.A headers
                 */
                $sheet->cell('B216', function ($cell) {
                    $cell->setValue('No. of Nonconformity raised vs. No. of Issued CPIAR for the Conformities raised');
                });
                $sub5A_headers_arr = [
                        'B217' => 'Months', 'C217' => 'No. of Nonconformity raised', 'D217'=>'No. of Issued CPIAR for Nonconformities raised',
                        'E217' =>'Percentage %', 'F217' => 'Target'
                    ];
                foreach ($sub5A_headers_arr as $cell => $value) {
                    $sheet->cell($cell, function ($cell) use ($value) {
                        $cell->setValue($value);
                    });
                    $sheet->getStyle($cell)->getAlignment()->setWrapText(true);
                }
                $sheet->cells('B217:F217', function ($cells) {
                    $cells->setFontWeight('bold');
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });
                /** END */

                /**
                 * START 5.B headers
                 */
                $sheet->cell('B238', function ($cell) {
                    $cell->setValue('No. of Improvement raised vs. No. of Issued CPIAR for the Observations raised');
                });
                $sub5B_headers_arr = [
                        'B239' => 'Months', 'C239' => 'No. of Improvement raised', 'D239'=>'No. of Issued CPIAR for the Observation raised',
                        'E239' =>'Percentage %', 'F239' => 'Target'
                    ];
                foreach ($sub5B_headers_arr as $cell => $value) {
                    $sheet->cell($cell, function ($cell) use ($value) {
                        $cell->setValue($value);
                    });
                    $sheet->getStyle($cell)->getAlignment()->setWrapText(true);
                }
                $sheet->cells('B239:F239', function ($cells) {
                    $cells->setFontWeight('bold');
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });
                /** END */

                /**
                 * START 5.C headers
                 */
                $sheet->cell('B260', function ($cell) {
                    $cell->setValue('No. of Nonconformity resolved vs. No. of Issued CPIAR for the Conformities raised');
                });
                $sub5C_headers_arr = [
                        'B261' => 'Months', 'C261' => 'No. of Nonconformity resolved', 'D261'=>'No. of Issued CPIAR for the Nonconformities raised',
                        'E261' =>'Percentage %', 'F261' => 'Target'
                    ];
                foreach ($sub5C_headers_arr as $cell => $value) {
                    $sheet->cell($cell, function ($cell) use ($value) {
                        $cell->setValue($value);
                    });
                    $sheet->getStyle($cell)->getAlignment()->setWrapText(true);
                }
                $sheet->cells('B261:F261', function ($cells) {
                    $cells->setFontWeight('bold');
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });
                /** END */

                /**
                 * START 5.D headers
                 */
                $sheet->cell('B282', function ($cell) {
                    $cell->setValue('No. of effected improvement  vs. No. of Issued CPIAR for the obeservation raised');
                });
                $sub5D_headers_arr = [
                        'B283' => 'Months', 'C283' => 'No. of effected improvement', 'D283'=>'No. of Issued CPIAR for the Observation raised',
                        'E283' =>'Percentage %', 'F283' => 'Target'
                    ];
                foreach ($sub5D_headers_arr as $cell => $value) {
                    $sheet->cell($cell, function ($cell) use ($value) {
                        $cell->setValue($value);
                    });
                    $sheet->getStyle($cell)->getAlignment()->setWrapText(true);
                }
                $sheet->cells('B283:F283', function ($cells) {
                    $cells->setFontWeight('bold');
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });
                /** END */

                /**
                 * START 5.E headers
                 */
                $sheet->cell('B304', function ($cell) {
                    $cell->setValue('No. of nonrecurring Nonconformity vs. No. of Issued CPIAR for the Nonconformities raise');
                });
                $sub5E_headers_arr = [
                        'B305' => 'Months', 'C305' => 'No. of Nonconformity raised without recurrence', 'D305'=>'No. of Issued CPIAR for the Nonconformities raised',
                        'E305' =>'Percentage %', 'F305' => 'Target'
                    ];
                foreach ($sub5E_headers_arr as $cell => $value) {
                    $sheet->cell($cell, function ($cell) use ($value) {
                        $cell->setValue($value);
                    });
                    $sheet->getStyle($cell)->getAlignment()->setWrapText(true);
                }
                $sheet->cells('B305:F305', function ($cells) {
                    $cells->setFontWeight('bold');
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });
                /** END */
                    
                /** Start styling of row of Months, subheaders. */
                $table_col_header = ['B', 'C', 'D', 'E', 'F'];
                $table_header_arr = [11, 33, 53, 73, 93, 113, 133, 153, 174, 195, 217, 239, 261, 283, 305];
                for ($i = 0; $i < count($table_col_header); $i++) {
                    for ($j = 0; $j < count($table_header_arr); $j++) {
                        $sheet->cells($table_col_header[$i].$table_header_arr[$j], function ($cells) {
                            $cells->setBorder('thick', 'thick', 'thin', 'thick');
                        });
                    }
                }
                    
                    
                /**
                 * Set column header for status
                 */

                $status_header_arr = [ 10 => 11, 32 => 33, 52 => 53, 72 => 73, 92 => 93, 112 => 113, 132 => 133, 152 => 153, 173 => 174, 194 => 195, 216 => 217, 238 => 239, 260 => 261, 282 => 283, 304 => 305];
                foreach ($status_header_arr as $row1 => $row2) {
                    $sheet->mergeCells('G'.$row1.':G'.$row2);
                    $sheet->cells('G'.$row1.':G'.$row2, function ($cells) {
                        $cells->setAlignment('center');
                        $cells->setValignment('center');
                        $cells->setFontWeight('bold');
                        $cells->setBorder('thick', 'thick', 'thin', 'thick');
                    });
                    $sheet->mergeCells('H'.$row1.':H'.$row2);
                    $sheet->cells('H'.$row1.':H'.$row2, function ($cells) {
                        $cells->setAlignment('center');
                        $cells->setValignment('center');
                        $cells->setFontWeight('bold');
                        $cells->setBorder('thick', 'thick', 'thin', 'thick');
                    });
                    $sheet->mergeCells('I'.$row1.':I'.$row2);
                    $sheet->cells('I'.$row1.':I'.$row2, function ($cells) {
                        $cells->setAlignment('center');
                        $cells->setValignment('center');
                        $cells->setFontWeight('bold');
                        $cells->setBorder('thick', 'thick', 'thin', 'thick');
                    });
                    $sheet->mergeCells('J'.$row1.':J'.$row2);
                    $sheet->cells('J'.$row1.':J'.$row2, function ($cells) {
                        $cells->setAlignment('center');
                        $cells->setValignment('center');
                        $cells->setFontWeight('bold');
                        $cells->setBorder('thick', 'thick', 'thin', 'thick');
                    });
                    $sheet->cell('G'.$row1, function ($cell) {
                        $cell->setValue('Status');
                    });
                    $sheet->cell('H'.$row1, function ($cell) {
                        $cell->setValue('Other details and/or Explanation if below the target');
                    });
                    $sheet->setSize('H'.$row1, 58.57, 50);
                    $sheet->cell('I'.$row1, function ($cell) {
                        $cell->setValue('Actions to be Taken (Action Plans)');
                    });
                    $sheet->setSize('I'.$row1, 37.57, 40);
                    $sheet->cell('J'.$row1, function ($cell) {
                        $cell->setValue('Commit Date');
                    });
                    $sheet->setSize('J'.$row1, 20, 30);
                }
                /**
                 * Set row attribute for rows
                 */
                $sheet->row(11, function ($row) {
                    $row->setAlignment('center');
                    $row->setValignment('center');
                    $row->setFontWeight('bold');
                });
                /**
                 * Set alignment/border for row 12 to 23
                 * This is the cells that contains data
                 * used in foreach
                 * */
                    
                $column_header = ['B','C','D', 'E', 'F','G','H','I','J'];
                /** Start report 1 cell styling */
                for ($i = 12; $i <= 27; $i++) {
                    $sheet->row($i, function ($row) {
                        $row->setAlignment('center');
                        $row->setValignment('center');
                    });
                    for ($j = 0; $j < count($column_header); $j++) {
                        $sheet->cells($column_header[$j].$i, function ($cells) {
                            $cells->setBorder('thin', 'thin', 'thin', 'thin');
                        });
                    }
                }
                /**END */
                /** Start report 2A */
                for ($i = 34; $i <= 49; $i++) {
                    $sheet->row($i, function ($row) {
                        $row->setAlignment('center');
                        $row->setValignment('center');
                    });
                    for ($j = 0; $j < count($column_header); $j++) {
                        $sheet->cells($column_header[$j].$i, function ($cells) {
                            $cells->setBorder('thin', 'thin', 'thin', 'thin');
                        });
                    }
                }
                /**END */
                /** Start report 2B */
                for ($i = 54; $i <= 69; $i++) {
                    $sheet->row($i, function ($row) {
                        $row->setAlignment('center');
                        $row->setValignment('center');
                    });
                    for ($j = 0; $j < count($column_header); $j++) {
                        $sheet->cells($column_header[$j].$i, function ($cells) {
                            $cells->setBorder('thin', 'thin', 'thin', 'thin');
                        });
                    }
                }
                /**END */
                /** Start report 2C */
                for ($i = 74; $i <= 89; $i++) {
                    $sheet->row($i, function ($row) {
                        $row->setAlignment('center');
                        $row->setValignment('center');
                    });
                    for ($j = 0; $j < count($column_header); $j++) {
                        $sheet->cells($column_header[$j].$i, function ($cells) {
                            $cells->setBorder('thin', 'thin', 'thin', 'thin');
                        });
                    }
                }
                /**END */
                /** Start report 2D */
                for ($i = 94; $i <= 109; $i++) {
                    $sheet->row($i, function ($row) {
                        $row->setAlignment('center');
                        $row->setValignment('center');
                    });
                    for ($j = 0; $j < count($column_header); $j++) {
                        $sheet->cells($column_header[$j].$i, function ($cells) {
                            $cells->setBorder('thin', 'thin', 'thin', 'thin');
                        });
                    }
                }
                /**END */
                /** Start report 2E */
                for ($i = 114; $i <= 129; $i++) {
                    $sheet->row($i, function ($row) {
                        $row->setAlignment('center');
                        $row->setValignment('center');
                    });
                    for ($j = 0; $j < count($column_header); $j++) {
                        $sheet->cells($column_header[$j].$i, function ($cells) {
                            $cells->setBorder('thin', 'thin', 'thin', 'thin');
                        });
                    }
                }
                /**END */
                /** Start report 2F */
                for ($i = 134; $i <= 149; $i++) {
                    $sheet->row($i, function ($row) {
                        $row->setAlignment('center');
                        $row->setValignment('center');
                    });
                    for ($j = 0; $j < count($column_header); $j++) {
                        $sheet->cells($column_header[$j].$i, function ($cells) {
                            $cells->setBorder('thin', 'thin', 'thin', 'thin');
                        });
                    }
                }
                /**END */
                /** Start report 2F.1 */
                for ($i = 154; $i <= 169; $i++) {
                    $sheet->row($i, function ($row) {
                        $row->setAlignment('center');
                        $row->setValignment('center');
                    });
                    for ($j = 0; $j < count($column_header); $j++) {
                        $sheet->cells($column_header[$j].$i, function ($cells) {
                            $cells->setBorder('thin', 'thin', 'thin', 'thin');
                        });
                    }
                }
                /**END */
                /** Start report 3 */
                for ($i = 175; $i <= 190; $i++) {
                    $sheet->row($i, function ($row) {
                        $row->setAlignment('center');
                        $row->setValignment('center');
                    });
                    for ($j = 0; $j < count($column_header); $j++) {
                        $sheet->cells($column_header[$j].$i, function ($cells) {
                            $cells->setBorder('thin', 'thin', 'thin', 'thin');
                        });
                    }
                }
                /**END */
                /** Start report 4 */
                for ($i = 196; $i <= 211; $i++) {
                    $sheet->row($i, function ($row) {
                        $row->setAlignment('center');
                        $row->setValignment('center');
                    });
                    for ($j = 0; $j < count($column_header); $j++) {
                        $sheet->cells($column_header[$j].$i, function ($cells) {
                            $cells->setBorder('thin', 'thin', 'thin', 'thin');
                        });
                    }
                }
                /**END */
                    
                /**
                 * For report #5 with different format (Quarter and Semister)
                **/
                $rep5_months = (object) [
                        0 => 'JANUARY', 1 => 'FEBRUARY', 2 =>'MARCH', 3 =>'Q1',
                        4 =>'APRIL', 5 =>'MAY', 6 =>'JUNE' , 7 => 'Q2', 8 => 'SEM 1',
                        9 => 'JULY', 10 => 'AUGUST', 11 => 'SEPTEMBER', 12 => 'Q3',
                        13 => 'OCTOBER', 14 => 'NOVEMBER', 15 => 'DECEMBER', 16 => 'Q4', 17 => 'SEM 2'
                        // [
                        //     'month' => 'JANUARY',
                        //     'quarter' => 'Q1',
                        //     'semester' => 'SEM 1',
                        // ],
                        // [
                        //     'month' => 'FEBRUARY',
                        //     'quarter' => 'Q1',
                        //     'semester' => 'SEM 1',
                        // ],
                        // [
                        //     'month' => 'MARCH',
                        //     'quarter' => 'Q1',
                        //     'semester' => 'SEM 1',
                        // ],
                        // [
                        //     'month'=>'APRIL',
                        //     'quarter' => 'Q2',
                        //     'semester' => 'SEM 1',
                        // ],
                        // [
                        //     'month'=>'MAY',
                        //     'quarter' => 'Q2',
                        //     'semester' => 'SEM 1',
                        // ],
                        // [
                        //     'month'=>'JUNE',
                        //     'quarter' => 'Q2',
                        //     'semester' => 'SEM 1',
                        // ],
                        // [
                        //     'month'=>'JULY',
                        //     'quarter' => 'Q3',
                        //     'semester' => 'SEM 2',
                        // ],
                        // [
                        //     'month'=>'AUGUST',
                        //     'quarter' => 'Q3',
                        //     'semester' => 'SEM 2',
                        // ],
                        // [
                        //     'month'=>'SEPTEMBER',
                        //     'quarter' => 'Q3',
                        //     'semester' => 'SEM 2',
                        // ],
                        // [
                        //     'month'=>'OCTOBER',
                        //     'quarter' => 'Q4',
                        //     'semester' => 'SEM 2',
                        // ],
                        // [
                        //     'month'=>'NOVEMBER',
                        //     'quarter' => 'Q4',
                        //     'semester' => 'SEM 2',
                        // ],
                        // [
                        //     'month'=>'DECEMBER',
                        //     'quarter' => 'Q4',
                        //     'semester' => 'SEM 2',
                        // ]
                    ];

                /**
                 * Printing report months
                **/
                $rep5A_row = 218;
                $rep5B_row = 240;
                $rep5C_row = 262;
                $rep5D_row = 284;
                $rep5E_row = 306;

                foreach ($rep5_months as $key => $value) {
                    //$sheet->setCellValueByColumnAndRow(1, $rep5A_row + $key, $value['month']);
                    $r1 = $rep5A_row + $key;
                    $r2 = $rep5B_row + $key;
                    $r3 = $rep5C_row + $key;
                    $r4 = $rep5D_row + $key;
                    $r5 = $rep5E_row + $key;
                    /** set months for 5.A */
                    $sheet->setCellValueByColumnAndRow(1, $r1, $value);
                    $sheet->setCellValueByColumnAndRow(2, $r1, 0);
                    $sheet->setCellValueByColumnAndRow(4, $r1, '-');
                    $sheet->setCellValueByColumnAndRow(5, $r1, '100%');
                    $sheet->setCellValueByColumnAndRow(6, $r1, 'MET');
                    /** set months for 5.B */
                    $sheet->setCellValueByColumnAndRow(1, $r2, $value);
                    $sheet->setCellValueByColumnAndRow(2, $r2, 0);
                    $sheet->setCellValueByColumnAndRow(4, $r2, '-');
                    $sheet->setCellValueByColumnAndRow(5, $r2, '100%');
                    $sheet->setCellValueByColumnAndRow(6, $r2, 'MET');
                    /** set months for 5.C */
                    $sheet->setCellValueByColumnAndRow(1, $r3, $value);
                    $sheet->setCellValueByColumnAndRow(2, $r3, 0);
                    $sheet->setCellValueByColumnAndRow(4, $r3, '-');
                    $sheet->setCellValueByColumnAndRow(5, $r3, '100%');
                    $sheet->setCellValueByColumnAndRow(6, $r3, 'MET');
                    /** set months for 5.D */
                    $sheet->setCellValueByColumnAndRow(1, $r4, $value);
                    $sheet->setCellValueByColumnAndRow(2, $r4, 0);
                    $sheet->setCellValueByColumnAndRow(4, $r4, '-');
                    $sheet->setCellValueByColumnAndRow(5, $r4, '100%');
                    $sheet->setCellValueByColumnAndRow(6, $r4, 'MET');
                    /** set months for 5.E */
                    $sheet->setCellValueByColumnAndRow(1, $r5, $value);
                    $sheet->setCellValueByColumnAndRow(2, $r5, 0);
                    $sheet->setCellValueByColumnAndRow(4, $r5, '-');
                    $sheet->setCellValueByColumnAndRow(5, $r5, '100%');
                    $sheet->setCellValueByColumnAndRow(6, $r5, 'MET');

                    if ($value == 'Q1' || $value == 'Q2' || $value == 'Q3' || $value == 'Q4' || $value == 'SEM 1' || $value == 'SEM 2') {
                        $sheet->cells('B'.$r1.':G'.$r1, function ($cells) {
                            $cells->setFontWeight('bold');
                        });
                        $sheet->cells('B'.$r2.':G'.$r2, function ($cells) {
                            $cells->setFontWeight('bold');
                        });
                        $sheet->cells('B'.$r3.':G'.$r3, function ($cells) {
                            $cells->setFontWeight('bold');
                        });
                        $sheet->cells('B'.$r4.':G'.$r4, function ($cells) {
                            $cells->setFontWeight('bold');
                        });
                        $sheet->cells('B'.$r5.':G'.$r5, function ($cells) {
                            $cells->setFontWeight('bold');
                        });
                    }
                    /** Set horizontal alignment to center for 5.A to 5.E */
                    $sheet->cells('B'.$r1.':J'.$r1, function ($cells) {
                        $cells->setAlignment('center');
                    });
                    $sheet->cells('B'.$r2.':J'.$r2, function ($cells) {
                        $cells->setAlignment('center');
                    });
                    $sheet->cells('B'.$r3.':J'.$r3, function ($cells) {
                        $cells->setAlignment('center');
                    });
                    $sheet->cells('B'.$r4.':J'.$r4, function ($cells) {
                        $cells->setAlignment('center');
                    });
                    $sheet->cells('B'.$r5.':J'.$r5, function ($cells) {
                        $cells->setAlignment('center');
                    });
                    $sheet->setBorder('B'.$r1.':J'.$r1, 'thin');
                    $sheet->setBorder('B'.$r2.':J'.$r2, 'thin');
                    $sheet->setBorder('B'.$r3.':J'.$r3, 'thin');
                    $sheet->setBorder('B'.$r4.':J'.$r4, 'thin');
                    $sheet->setBorder('B'.$r5.':J'.$r5, 'thin');
                }

                /**
                 * END
                **/

                /**
                 * SET COLUMN WIDTH
                 * You can set multiple columns here
                 */
                $sheet->setWidth(
                        array(
                            'A' => 3.86,
                            'B' => 14.30,
                            'C' => 14,
                            'D' => 18,
                            'E' => 22,
                            'F' => 14,
                            'G' => 17
                        )
                    );
                /**
                 * Set height for multitple rows
                 */
                $sheet->setHeight(array(
                        10 =>  31.5,
                        112 => 33
                    ));
                /**
                 * Set single cell size
                 */
                // $sheet->setSize(array(
                //     'C6' => array(
                //         'width'     => 17.43,
                //         'height'    => 500
                //     )
                // ));
                /**
                 * Set Sheet Protection settings
                 * excel itself is not supported in PHPExcel
                 * only in PHPSpreadsheet
                 */
                $sheet->getProtection()->setPassword('l0cl!$t');
                $sheet->getProtection()->setSheet(true);
                $sheet->getProtection()->setSort(true);
                $sheet->getProtection()->setInsertRows(true);
                $sheet->getProtection()->setFormatCells(true);
            });
        });

        $filename = $file->filename;
        $file = $file->string('xlsx');

        return [
            'filename' => $filename,
            'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($file),
            'year' => $report_year
        ];
    }

    public function generate_report2($sheet, $data, int $row, array $blank_rows, int $row_quarter4)
    {
        $total = 0;
        $total_target = 0;
        $total_percentage = 0;
        $current_quarter = 0;
        $month_status = null;
        $total_proposals_sent = 0; //for 2C
        /** Start Loop report 1 data */
        foreach ($data as $key => $report) {
            /** Check if current row is in blank rows which are rows for quarter 1,2,3,4 */
            if ($boolean = in_array($row + $key, $blank_rows)) {
                if ($current_quarter == 1) {
                    $sheet->setCellValueByColumnAndRow(1, $row + $key, "Q" . $current_quarter);
                }
                if ($current_quarter == 2) {
                    $sheet->setCellValueByColumnAndRow(1, $row + $key, "Q" . $current_quarter);
                }
                if ($current_quarter == 3) {
                    $sheet->setCellValueByColumnAndRow(1, $row + $key, "Q" . $current_quarter);
                }
                $sheet->setCellValueByColumnAndRow(2, $row + $key, $total);
                $sheet->setCellValueByColumnAndRow(3, $row + $key, $total_target);
                $sheet->setCellValueByColumnAndRow(4, $row + $key, round($total_percentage, 2) . "%");
                /** CHECK if the current report is 2.D then set target to 40  */
                if (property_exists($report, 'report_name') && $report->report_name == "kpi_report_2D") {
                    $sheet->setCellValueByColumnAndRow(5, $row + $key, 40 . "%");
                } elseif ($report->report_name == "kpi_report_2F1") {
                    $sheet->setCellValueByColumnAndRow(5, $row + $key, "-");
                } else {
                    $sheet->setCellValueByColumnAndRow(5, $row + $key, 100 . "%");
                }
                /** END */
                $sheet->setCellValueByColumnAndRow(6, $row + $key, $report->report_name == "kpi_report_2F1" ? "-" : $quarter_status);

                $row = $row + 1;
            }
            /**
             * start report 2.A computation
             * */
            if (property_exists($report, 'calls_count')) {
                $percentage = $report->calls_count != null ? (intval($report->calls_count) / intval($report->target_no_of_calls_made))*100:0;
                $total = $total + $report->calls_count;
                $total_target = $total_target + $report->target_no_of_calls_made;
                if ($report->calls_count == null && $report->target_no_of_calls_made == null) {
                    $month_status = "-";
                } else {
                    $month_status = $report->calls_count >=  $report->target_no_of_calls_made ? "MET" : "UNMET";
                }
            }
            /**
             * 2B Check if report object has a key proposal_related_to_call
             */
            if (property_exists($report, 'proposal_related_to_call_count') && property_exists($report, 'no_of_productive_calls')) {
                $percentage = $report->proposal_related_to_call_count != null ? (intval($report->proposal_related_to_call_count) / intval($report->no_of_productive_calls)) * 100 : 0;
                $total = $total + $report->proposal_related_to_call_count;
                $total_target = $total_target + $report->no_of_productive_calls;
                if ($report->proposal_related_to_call_count == null && $report->no_of_productive_calls == null) {
                    $month_status = "-";
                } else {
                    $month_status = $report->proposal_related_to_call_count >=  $report->no_of_productive_calls ? "MET" : "UNMET";
                }
            }

            /**
             * 2C Computation
             * */
            if (property_exists($report, 'report_name') && $report->report_name == "kpi_report_2C") {
                //$total_proposals_sent = (intval($report->proposal_related_to_call_count) + intval($report->proposal_sent_saturations));
                $percentage = ($report->proposal_sent_saturations != null) ? ($report->proposal_sent_saturations / intval($report->target_proposal_tobe_sent)) * 100 : 0 ;
                $total = $total + $report->proposal_sent_saturations;
                $total_target = $total_target + $report->target_proposal_tobe_sent;
                if ($report->proposal_sent_saturations == null && $report->target_proposal_tobe_sent == null) {
                    $month_status = "-";
                } else {
                    $month_status = $report->proposal_sent_saturations >=  $report->target_proposal_tobe_sent ? "MET" : "UNMET";
                }
            }

            /**
             * 2D Computation
             * */
            if (property_exists($report, 'report_name') && $report->report_name == "kpi_report_2D") {
                //$total_proposals_sent = (intval($report->proposal_related_to_call_count) + intval($report->proposal_sent_saturations));
                $percentage = $report->total_no_proposals_received_accepted != null ? (intval($report->total_no_proposals_received_accepted) / $report->proposal_sent_saturations) * 100 : 0;
                $total = $total + $report->total_no_proposals_received_accepted;
                $total_target = $total_target + $report->proposal_sent_saturations;
                if ($report->total_no_proposals_received_accepted == null && $report->proposal_sent_saturations == null) {
                    $month_status = "-";
                } else {
                    $month_status = $report->total_no_proposals_received_accepted >=  $report->proposal_sent_saturations ? "MET" : "UNMET";
                }
            }
            /**
             * 2E Computation
             * */
            if (property_exists($report, 'report_name') && $report->report_name == "kpi_report_2E") {
                $percentage = $report->no_of_followups_made != null ? (intval($report->no_of_followups_made) / intval($report->total_no_proposals_received_accepted)) * 100 : 0;
                $total = $total + $report->no_of_followups_made;
                $total_target = $total_target + intval($report->total_no_proposals_received_accepted);
                if ($report->no_of_followups_made == null && $report->total_no_proposals_received_accepted == null) {
                    $month_status = "-";
                } else {
                    $month_status = $report->no_of_followups_made >=  $report->total_no_proposals_received_accepted ? "MET" : "UNMET";
                }
            }
            /**
             * 2F Computation
             */
            if (property_exists($report, 'report_name') && $report->report_name == "kpi_report_2F") {
                $percentage = $report->no_of_actual_presentations != null ? (intval($report->no_of_actual_presentations) / intval($report->target_no_formal_presentation)) * 100 : 0;
                $total = $total + $report->no_of_actual_presentations;
                $total_target = $report->target_no_formal_presentation;
                if ($report->no_of_actual_presentations == null && $report->target_no_formal_presentation == null) {
                    $month_status = "-";
                } else {
                    $month_status = $report->no_of_actual_presentations >=  $report->target_no_formal_presentation ? "MET" : "UNMET";
                }
            }
            /**
             * 2F.1 computation
             */
            if (property_exists($report, 'report_name') && $report->report_name == "kpi_report_2F1") {
                $percentage = $report->no_of_call_presentations != null && $report->no_of_actual_presentations != null ? (intval($report->no_of_call_presentations) / intval($report->no_of_actual_presentations)) * 100 : 0;
                $total = $total + $report->no_of_call_presentations;
                $total_target = $total_target + $report->no_of_actual_presentations;
                if ($report->no_of_call_presentations == null && $report->no_of_actual_presentations == null) {
                    $month_status = "-";
                } else {
                    $month_status = $report->no_of_call_presentations >=  $report->no_of_actual_presentations ? "MET" : "UNMET";
                }
            }
            /** 
             * Start report 3 Computation
             */
            if (property_exists($report, 'report_name') && $report->report_name == "kpi_report_3") {
                $percentage = $report->no_of_acquired_clients != null && $report->target_client_tobe_acquired != null ? (intval($report->no_of_acquired_clients) / intval($report->target_client_tobe_acquired)) * 100 : 0;
                $total = $total + $report->no_of_acquired_clients;
                $total_target = $total_target + $report->target_client_tobe_acquired;
                
                if ($report->no_of_acquired_clients == null && $report->target_client_tobe_acquired == null) {
                    $month_status = "-";
                } else {
                    $month_status = $report->no_of_acquired_clients >=  $report->target_client_tobe_acquired ? "MET" : "UNMET";
                }
            }
            /**
             * Start report 4 computation
             */
            if (property_exists($report, 'report_name') && $report->report_name == "kpi_report_4") {
                $percentage = $report->no_of_signed_contracts != null && $report->no_of_acquired_clients != null ? (intval($report->no_of_signed_contracts) / intval($report->no_of_acquired_clients)) * 100 : 0;
                $total = $total + $report->no_of_signed_contracts;
                $total_target = $total_target + $report->no_of_acquired_clients;
                
                if ($report->no_of_signed_contracts == null && $report->no_of_acquired_clients == null) {
                    $month_status = "-";
                } else {
                    $month_status = $report->no_of_signed_contracts >=  $report->no_of_acquired_clients ? "MET" : "UNMET";
                }
            }
            
            if ($total_target != null && $total_target != 0) {
                $total_percentage = ($total / $total_target) * 100;
            }
    
            $current_quarter = $report->quarter;
            
            if ($total == 0 && $total_target == 0) {
                $quarter_status = "-";
            } else {
                $quarter_status = $total >=  $total_target ? "MET" : "UNMET";
            }
            /** end report 1 computation */
                        
            /** start setting value report 2A */
            $sheet->setCellValueByColumnAndRow(1, $row + $key, $report->target_month); // . $row."+".$key
            if (property_exists($report, 'calls_count')) {
                $sheet->setCellValueByColumnAndRow(2, $row + $key, $report->calls_count != null ? $report->calls_count : 0);
                $sheet->setCellValueByColumnAndRow(3, $row + $key, $report->target_no_of_calls_made); //. "|".$bolean
            }
            /** start setting value report 2B */
            if (property_exists($report, 'proposal_related_to_call_count') && property_exists($report, 'no_of_productive_calls')) {
                $sheet->setCellValueByColumnAndRow(2, $row + $key, $report->proposal_related_to_call_count != null ? $report->proposal_related_to_call_count : 0);
                $sheet->setCellValueByColumnAndRow(3, $row + $key, $report->no_of_productive_calls != null ? $report->no_of_productive_calls : 0);
            }
            /** start setting value report 2C */
            if (property_exists($report, 'report_name') && $report->report_name == "kpi_report_2C") {
                $sheet->setCellValueByColumnAndRow(2, $row + $key, $report->proposal_sent_saturations != null ? $report->proposal_sent_saturations : 0);
                $sheet->setCellValueByColumnAndRow(3, $row + $key, $report->target_proposal_tobe_sent != null ? $report->target_proposal_tobe_sent : 0);
            }
            /** start setting value report 2D */
            if (property_exists($report, 'report_name') && $report->report_name == "kpi_report_2D") {
                $sheet->setCellValueByColumnAndRow(2, $row + $key, $report->total_no_proposals_received_accepted != null ? $report->total_no_proposals_received_accepted : 0);
                $sheet->setCellValueByColumnAndRow(3, $row + $key, $report->proposal_sent_saturations != null ?$report->proposal_sent_saturations : 0);
            }
            /** start setting value report 2E */
            if (property_exists($report, 'report_name') && $report->report_name == "kpi_report_2E") {
                $sheet->setCellValueByColumnAndRow(2, $row + $key, $report->no_of_followups_made != null ? $report->no_of_followups_made : 0);
                $sheet->setCellValueByColumnAndRow(3, $row + $key, $report->total_no_proposals_received_accepted != null ? $report->total_no_proposals_received_accepted : 0);
            }
            /** start setting value report 2F */
            if (property_exists($report, 'report_name') && $report->report_name == "kpi_report_2F") {
                $sheet->setCellValueByColumnAndRow(2, $row + $key, $report->no_of_actual_presentations != null ? $report->no_of_actual_presentations : 0);
                $sheet->setCellValueByColumnAndRow(3, $row + $key, $report->target_no_formal_presentation != null ? $report->target_no_formal_presentation : 0);
            }
            /** start setting value report 2F.1 */
            if (property_exists($report, 'report_name') && $report->report_name == "kpi_report_2F1") {
                $sheet->setCellValueByColumnAndRow(2, $row + $key, $report->no_of_call_presentations != null ? $report->no_of_call_presentations : 0);
                $sheet->setCellValueByColumnAndRow(3, $row + $key, $report->no_of_actual_presentations != null ? $report->no_of_actual_presentations : 0);
            }
            /** start setting value report 3 */
            if (property_exists($report, 'report_name') && $report->report_name == "kpi_report_3") {
                $sheet->setCellValueByColumnAndRow(2, $row + $key, $report->no_of_acquired_clients != null ? $report->no_of_acquired_clients : 0);
                $sheet->setCellValueByColumnAndRow(3, $row + $key, $report->target_client_tobe_acquired != null ? $report->target_client_tobe_acquired : 0);
            }
            /** start setting value report 4 */
            if (property_exists($report, 'report_name') && $report->report_name == "kpi_report_4") {
                $sheet->setCellValueByColumnAndRow(2, $row + $key, $report->no_of_signed_contracts != null ? $report->no_of_signed_contracts : 0);
                $sheet->setCellValueByColumnAndRow(3, $row + $key, $report->no_of_acquired_clients != null ? $report->no_of_acquired_clients : 0);
            }

            $sheet->setCellValueByColumnAndRow(4, $row + $key, $percentage . "%");
            /** CHECK if the current report is 2.D then set target to 40  */
            if (property_exists($report, 'report_name') && $report->report_name == "kpi_report_2D") {
                $sheet->setCellValueByColumnAndRow(5, $row + $key, 40 . "%");
            } elseif ($report->report_name == "kpi_report_2F1") {
                $sheet->setCellValueByColumnAndRow(5, $row + $key, "-");
            } else {
                $sheet->setCellValueByColumnAndRow(5, $row + $key, 100 . "%");
            }
            /** END */
            $sheet->setCellValueByColumnAndRow(6, $row + $key, $report->report_name == "kpi_report_2F1" ? "-" : $month_status);
            /** end setting vaue report 1 */
        }
        $sheet->setCellValueByColumnAndRow(1, $row_quarter4, "Q" . 4);
        $sheet->setCellValueByColumnAndRow(2, $row_quarter4, $total);
        $sheet->setCellValueByColumnAndRow(3, $row_quarter4, $total_target);
        $sheet->setCellValueByColumnAndRow(4, $row_quarter4, round($total_percentage, 2) . "%");
        if (property_exists($report, 'report_name') && $report->report_name == "kpi_report_2D") {
            $sheet->setCellValueByColumnAndRow(5, $row_quarter4, 40 . "%");
        } elseif ($report->report_name == "kpi_report_2F1") {
            $sheet->setCellValueByColumnAndRow(5, $row + $key, "-");
        } else {
            $sheet->setCellValueByColumnAndRow(5, $row_quarter4, 100 . "%");
        }
        $sheet->setCellValueByColumnAndRow(6, $row_quarter4, $report->report_name == "kpi_report_2F1" ? "-" : $quarter_status);
    }
}
