<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SearchSticketsController extends Controller
{
    public function index(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {
                $data = DB::table('stickets')
                    ->whereBetween('creation_date', array($request->from_date, $request->to_date))
                    ->where('libell_operation_type', $request->filter_libell_operation_type)
                    ->where('libell_state', $request->filter_libell_state)
                    ->get();
            } else {
                $data = DB::table('stickets')
                ->get();
            }

            return datatables()->of($data)->make(true);
        }

        $operation_type = DB::table('stickets') 
        ->select('libell_operation_type')
        ->groupBy('libell_operation_type')
        ->orderBy('libell_operation_type', 'ASC')
        ->get();
        


        $libell_state = DB::table('stickets')
            ->select('libell_state')
            ->groupBy('libell_state')
            ->orderBy('libell_state', 'ASC')
            ->get();
        //dd($status);

           
           // dd($tech);

        // $initia = DB::table('otickets')
        //     ->select(DB::raw("
        //     CASE    
        //     WHEN initiator_eds_name LIKE '%_ERI_%' THEN 'ERICSSON'
        //     WHEN initiator_eds_name LIKE '%GNOC%' THEN 'GNOC'
        //     WHEN initiator_eds_name LIKE '%OCM %' THEN 'OCM'
        //     WHEN initiator_eds_name LIKE '%NOKIA%' THEN 'NOKIA'
        //     WHEN initiator_eds_name LIKE '%GOS%' THEN 'GOS'
        //     WHEN initiator_eds_name LIKE '%SSPO%' THEN 'SSPO'
        //     WHEN initiator_eds_name LIKE '%SMC%' THEN 'OCM'
        //     WHEN initiator_eds_name LIKE '%ALCATEL%' THEN 'ALCATEL'
        //     END"))
        //     ->whereNotNull('initiator_eds_name')
        //     ->groupBy(DB::raw("
        //     CASE    
        //     WHEN initiator_eds_name LIKE '%_ERI_%' THEN 'ERICSSON'
        //     WHEN initiator_eds_name LIKE '%GNOC%' THEN 'GNOC'
        //     WHEN initiator_eds_name LIKE '%OCM %' THEN 'OCM'
        //     WHEN initiator_eds_name LIKE '%NOKIA%' THEN 'NOKIA'
        //     WHEN initiator_eds_name LIKE '%GOS%' THEN 'GOS'
        //     WHEN initiator_eds_name LIKE '%SSPO%' THEN 'SSPO'
        //     WHEN initiator_eds_name LIKE '%SMC%' THEN 'OCM'
        //     WHEN initiator_eds_name LIKE '%ALCATEL%' THEN 'ALCATEL'




        //     END"))
        //     ->get();
           
          
        return view('search_sticket', compact('operation_type','libell_state'));
    }
}
