<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomSearchController extends Controller
{
    public function index(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {
                $data = DB::table('otickets')
                    ->whereBetween('creation_date', array($request->from_date, $request->to_date))
                    ->where('ticket_type', $request->filter_tickettype)
                    ->where('status', $request->filter_status)
                    ->where('product_identifier_1', $request->filter_pro_identifier)
                    ->where('technician_incharge', $request->filter_technicienEnCharge)
                    ->get();
            } else {
                $data = DB::table('otickets')
                ->get();
            }

            return datatables()->of($data)->make(true);
        }

        $tickettype = DB::table('otickets') 
        ->select('ticket_type')
        ->groupBy('ticket_type')
        ->orderBy('ticket_type', 'ASC')
        ->get();
        //dd($tickettype);
        /*$activeEds = DB::table('otickets') 
        ->select('active_eds_name')
        ->groupBy('active_eds_name')
        ->orderBy('active_eds_name', 'ASC')
        ->whereNotNull('active_eds_name')
        ->get();*/
        $pro_identi = DB::table('otickets') 
        ->select('product_identifier_1')
        ->groupBy('product_identifier_1')
        ->orderBy('product_identifier_1', 'ASC')
        ->whereNotNull('product_identifier_1')
        ->get();
        //dd($activeEds);
        /*$priority = DB::table('otickets') 
        ->select('priority')
        ->groupBy('priority')
        ->orderBy('priority', 'ASC')
        ->whereNotNull('technician_incharge')
        ->get();*/
        //dd($priority);


        $status = DB::table('otickets')
            ->select('status')
            ->groupBy('status')
            ->orderBy('status', 'ASC')
            ->get();
        //dd($status);

            $tech = DB::table('otickets')
            ->select('technician_incharge')
            ->groupBy('technician_incharge')
            ->orderBy('technician_incharge', 'ASC')
            ->whereNotNull('technician_incharge')
            ->get();
           // dd($tech);

        $initia = DB::table('otickets')
            ->select(DB::raw("
            CASE    
            WHEN initiator_eds_name LIKE '%_ERI_%' THEN 'ERICSSON'
            WHEN initiator_eds_name LIKE '%GNOC%' THEN 'GNOC'
            WHEN initiator_eds_name LIKE '%OCM %' THEN 'OCM'
            WHEN initiator_eds_name LIKE '%NOKIA%' THEN 'NOKIA'
            WHEN initiator_eds_name LIKE '%GOS%' THEN 'GOS'
            WHEN initiator_eds_name LIKE '%SSPO%' THEN 'SSPO'
            WHEN initiator_eds_name LIKE '%SMC%' THEN 'OCM'
            WHEN initiator_eds_name LIKE '%ALCATEL%' THEN 'ALCATEL'
            END"))
            ->whereNotNull('initiator_eds_name')
            ->groupBy(DB::raw("
            CASE    
            WHEN initiator_eds_name LIKE '%_ERI_%' THEN 'ERICSSON'
            WHEN initiator_eds_name LIKE '%GNOC%' THEN 'GNOC'
            WHEN initiator_eds_name LIKE '%OCM %' THEN 'OCM'
            WHEN initiator_eds_name LIKE '%NOKIA%' THEN 'NOKIA'
            WHEN initiator_eds_name LIKE '%GOS%' THEN 'GOS'
            WHEN initiator_eds_name LIKE '%SSPO%' THEN 'SSPO'
            WHEN initiator_eds_name LIKE '%SMC%' THEN 'OCM'
            WHEN initiator_eds_name LIKE '%ALCATEL%' THEN 'ALCATEL'




            END"))
            ->get();
           
          //dd($initia);


           /* $initiaa = DB::table('otickets')->select(
                DB::raw("
                    CASE
     WHEN initiator_groupname LIKE '%OCM_ERI%' THEN'ERICSSON'
     WHEN initiator_groupname LIKE '%GNOC%' THEN 'GNOC'
     WHEN initiator_groupname LIKE '%OCM%' THEN 'OCM'
    ELSE 'Null'
    END
                ")
            )
                ->whereNotNull('initiator_groupname')
                ->groupBy(DB::raw("
                CASE
                WHEN initiator_groupname LIKE '%OCM_ERI%' THEN 'ERICSSON'
                WHEN initiator_groupname LIKE '%GNOC%' THEN 'GNOC'
                WHEN initiator_groupname LIKE '%OCM%' THEN 'OCM'
                END"))->get();
           // $rededs = json_decode(json_encode($initia), true);
        //dd($initia);*/

        return view('custom_search', compact('status','pro_identi','tech', 'tickettype'));
    }
}
