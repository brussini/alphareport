<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Oticket;

class OticketshowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function chartjs()
{
    $viewer = Oticket::select(DB::raw("priority as count"))
       ->where('priority','=','P1')
        ->groupBy('technician_incharge')
        ->get()->toArray();
    dd($viewer);
    
    $click = Oticket::select(DB::raw("SUM(priority) as count"))
        ->where('priority','=','P2')
       
        ->groupBy(DB::raw("year(created_at)"))
        ->get()->toArray();
    $click = array_column($click, 'count');
    

    return view('chartjs')
            ->with('viewer',json_encode($viewer,JSON_NUMERIC_CHECK))
            ->with('click',json_encode($click,JSON_NUMERIC_CHECK));
}
}
