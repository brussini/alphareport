<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Oticket;
use App\Charts\OticketChart;
use Illuminate\Support\Carbon;
use DB;
use App\Reports\MyReport;
use Charts;



class TestController extends Controller
{
    public function indexraw()
    {
         $technician = Oticket::where('id', '>', 0)
            ->selectRaw('technician_incharge,  COUNT(*) as count')
            ->groupBy('technician_incharge')
            ->whereNotNull('technician_incharge')
            ->pluck('count', 'technician_incharge');
        //dd($technician);
        $viewer = Oticket::where('id', '>', 0)
            ->selectRaw('technician_incharge,  COUNT(*) as count')
            ->groupBy('technician_incharge')
            ->whereNotNull('technician_incharge')
            ->pluck('count', 'technician_incharge');
        //$viewer = array_column($viewer, 'count');
        //dd($viewer);

        $click = Oticket::select(DB::raw("ticket_type as count"))
            ->orderBy("created_at")
            ->groupBy('id')
            ->get()->toArray();
        $click = array_column($click, 'count');
        return view('testhome')
            ->with('viewer', json_encode($viewer, JSON_NUMERIC_CHECK))
            ->with('click', json_encode($click, JSON_NUMERIC_CHECK));
    }

    public function highchart()
    {
        $viewer = Oticket::select(DB::raw("SUM(priority) as count"))
            ->orderBy("created_at")
            ->groupBy(DB::raw("year(created_at)"))
            ->get()->toArray();
        $viewer = array_column($viewer, 'count');

        $click = Oticket::select(DB::raw("SUM(ticket_type) as count"))
            ->orderBy("created_at")
            ->groupBy(DB::raw("year(created_at)"))
            ->get()->toArray();
        $click = array_column($click, 'count');
        return view('highchart')
            ->with('viewer', json_encode($viewer, JSON_NUMERIC_CHECK))
            ->with('click', json_encode($click, JSON_NUMERIC_CHECK));
    }

    public function Chartjs(){

        $technician = Oticket::where('id', '>', 0)
            ->selectRaw('technician_incharge,  COUNT(*) as count')
            ->groupBy('technician_incharge')
            ->whereNotNull('technician_incharge')
            ->pluck('count', 'technician_incharge');
        $month = array('Jan', 'Feb', 'Mar', 'Apr', 'May');
        $data  = array(1, 2, 3, 4, 5);
        return view('testhome',['Months' => $month, 'Data' => $data]);
      }

    
}
