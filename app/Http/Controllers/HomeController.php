<?php

namespace App\Http\Controllers;

use App\Oticket;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use ConsoleTVs\Charts\Facades\Charts;
use App\User;
use App\Charts\OticketsChart;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        $data = Carbon::now();
        $otickets = Oticket::all();

        /*$previous_week = Oticket::whereDate('created_at', today()->subDays(1))->get();
        $next_week = Oticket::whereDate('created_at', today()->subDays(2))->count();*/
        /*$result = DB::table('otickets')->select( 'MONTHNAME(created_at) as Month Name')
        ->where('MONTH(created_at) = MONTH(CURDATE() - INTERVAL 1 MONTH)')
        ->groupBy('DAY(created_at)')
        ->get();
        dd($result);*/
        // $results = Oticket::all()->groupby('initiator_groupname')->sortBy('created_at');
        //dd($results);

        $dataclos = array();
        //statistics
        $data = DB::table('otickets')->count();
        $datap1encoursPlainte = DB::table('otickets')->where('priority', '=', 'P1')->where('status', '=', 'En cours')->where('ticket_type', '=', 'Plainte client')->count();
        $datap1encoursInci = DB::table('otickets')->where('priority', '=', 'P1')->where('status', '=', 'En cours')->where('ticket_type', '=', 'Incident')->count();
        $datap2encoursPlainte = DB::table('otickets')->where('priority', '=', 'P2')->where('status', '=', 'En cours')->where('ticket_type', '=', 'Plainte client')->count();
        $datap2encoursInci = DB::table('otickets')->where('priority', '=', 'P2')->where('status', '=', 'En cours')->where('ticket_type', '=', 'Incident')->count();
        $datap3encoursPlainte = DB::table('otickets')->where('priority', '=', 'P3')->where('status', '=', 'En cours')->where('ticket_type', '=', 'Plainte client')->count();
        $datap3encoursInci = DB::table('otickets')->where('priority', '=', 'P3')->where('status', '=', 'En cours')->where('ticket_type', '=', 'Incident')->count();
        $datap4encoursPlainte = DB::table('otickets')->where('priority', '=', 'P4')->where('status', '=', 'En cours')->where('ticket_type', '=', 'Plainte client')->count();
        $datap4encoursInci = DB::table('otickets')->where('priority', '=', 'P4')->where('status', '=', 'En cours')->where('ticket_type', '=', 'Incident')->count();
        $dataavispro = DB::table('otickets')->where('ticket_type', '=', 'Avis de problème')->where('status', '=', 'En cours')->count();
        $dataencours = DB::table('otickets')->where('status', '=', 'En cours')->count();
        $dataclosprtableau = DB::table('otickets')->where('status', '=', 'Clos pour tableaux de bord')->count();
        $toute_priorite = DB::table('otickets');
        //dd($datap2encours);

        //-----------------------Priorities P1,P2,P3,P4 en cours group by months-----------------------------
        $dp1encours = DB::table('otickets')->select(
            DB::raw("
                COUNT(IF(priority = 'P1' and status = 'En cours', 1, NULL)) 'P1'")
        )
            ->whereNotNull('creation_date')
            ->groupBy(DB::raw("MONTH(creation_date)"))->get();
            //dd($dp1encours);
            $count = 0;
            $inidp1 = [];
            foreach ($dp1encours as $key => $valueArray) {
                foreach ($valueArray as $valueKey => $value) {
                    $inidp1[$count] = $value;
                }
                ++$count;
            }
            //dd($inidp1);
        $dp2encours = DB::table('otickets')->select(
            DB::raw("
                COUNT(IF(priority = 'P2' and status = 'En cours', 1, NULL)) 'P2'")
        )
            ->whereNotNull('creation_date')
            ->groupBy(DB::raw("MONTH(creation_date)"))->get();
            //dd($dp1encours);
            $count = 0;
            $inidp2 = [];
            foreach ($dp2encours as $key => $valueArray) {
                foreach ($valueArray as $valueKey => $value) {
                    $inidp2[$count] = $value;
                }
                ++$count;
            }
           // dd($inidp2);
        $dp3encours = DB::table('otickets')->select(
            DB::raw("
                COUNT(IF(priority = 'P3' and status = 'En cours', 1, NULL)) 'P4'")
        )
            ->whereNotNull('creation_date')
            ->groupBy(DB::raw("MONTH(creation_date)"))->get();
            //dd($dp1encours);
            $count = 0;
            $inidp3 = [];
            foreach ($dp3encours as $key => $valueArray) {
                foreach ($valueArray as $valueKey => $value) {
                    $inidp3[$count] = $value;
                }
                ++$count;
            }
           // dd($inidp3);
        $dp4encours = DB::table('otickets')->select(
            DB::raw("
                COUNT(IF(priority = 'P4' and status = 'En cours', 1, NULL)) 'P4'")
        )
            ->whereNotNull('creation_date')
            ->groupBy(DB::raw("MONTH(creation_date)"))->get();
            //dd($dp1encours);
            $count = 0;
            $inidp4 = [];
            foreach ($dp4encours as $key => $valueArray) {
                foreach ($valueArray as $valueKey => $value) {
                    $inidp4[$count] = $value;
                }
                ++$count;
            }
            //dd($inidp4);

        

        $datetick = Oticket::select(DB::raw("count(*) as ticket, date_format(creation_date, '%M %Y') as month"))
            ->pluck('month');

        //dd($datetick);

        $edsnames = DB::table('otickets')->select('initiator_eds_name')->groupby('initiator_eds_name')->get();
        $array = json_decode(json_encode($edsnames), true);
        //dd($array);

        $implo = $edsnames->implode('initiator_groupname', ',');
        //dd($implo);
        $agent = Oticket::where('id', '>', 0)->groupby('initiator_eds_name')->pluck('initiator_eds_name')->toArray();
        //dd($agent);
        $test = DB::table('otickets')->select(DB::raw('count(priority) as priority,initiator_eds_name'))->get();

        //dd($test);
        $hmm = DB::table('otickets')->select(
            DB::raw("
                COUNT(IF(priority = 'P1' and status = 'En cours', 1, NULL)) 'P1', 
                COUNT(IF(priority = 'P2' and status = 'En cours', 1, NULL)) 'P2', 
                COUNT(IF(priority = 'P3' and status = 'En cours', 1, NULL)) 'P3',
                COUNT(IF(priority = 'P4' and status = 'En cours', 1, NULL)) 'P4'")
        )
            ->groupBy('initiator_eds_name')->get();

        $arr = json_decode(json_encode($hmm), true);
        $collection = collect($arr)->flatten();
        //dd($collection);
        $imp = $collection->implode(',', $collection);
        //dd($imp);
        //dd($arr);
        //$imp = $hmm->implode(',',$arr);

        //dd($imp);
        $sumPlainteClientEncours = DB::table('otickets')->select(
            DB::raw("
            SUM(status = 'En cours' and ticket_type = 'Plainte client') AS SUM")
        )
            ->whereNotNull('technician_incharge')
            ->groupBy('technician_incharge')
            ->havingRaw('SUM <> 0')
            ->get();
            $sump = json_decode(json_encode($sumPlainteClientEncours), true);
            //dd($sump);
        $sumParray = [];
        $count = 0;
        foreach ($sump as $key => $valueArray) {
            foreach ($valueArray as $value) {

                $sumParray[$count] = $value;
            }
            ++$count;
        }
        //dd($sumParray);
        $sumInciEncours = DB::table('otickets')->select(
            DB::raw("
            SUM(status = 'En cours' and ticket_type = 'Incident') AS SUM")
        )
            ->whereNotNull('technician_incharge')
            ->groupBy('technician_incharge')
            ->havingRaw('SUM <> 0')
            ->get();
            $sumI = json_decode(json_encode($sumInciEncours), true);
            //dd($sump);
        $sumIarray = [];
        $count = 0;
        foreach ($sumI as $key => $valueArray) {
            foreach ($valueArray as $value) {

                $sumIarray[$count] = $value;
            }
            ++$count;
        }
        //dd($sumIarray);

        $TechniPlainte = DB::table('otickets')->select('technician_incharge')
            ->whereNotNull('technician_incharge')
            ->groupBy('technician_incharge')
            ->havingRaw("SUM(status = 'En cours' and ticket_type = 'Plainte client') <> 0")
            ->get();
            $techP = json_decode(json_encode($TechniPlainte), true);
            //dd($TechniPlainte);
        $TechParray = [];
        $count = 0;
        foreach ($techP as $key => $valueArray) {
            foreach ($valueArray as $value) {

                $TechParray[$count] = $value;
            }
            ++$count;
        }
        //dd($TechParray);

        $TechniInci = DB::table('otickets')->select('technician_incharge')
        ->whereNotNull('technician_incharge')
        ->groupBy('technician_incharge')
        ->havingRaw("SUM(status = 'En cours' and ticket_type = 'Incident') <> 0")
        ->get();
        $techI = json_decode(json_encode($TechniInci), true);
        //dd($TechniPlainte);
    $TechIarray = [];
    $count = 0;
    foreach ($techI as $key => $valueArray) {
        foreach ($valueArray as $value) {

            $TechIarray[$count] = $value;
        }
        ++$count;
    }
    //dd($TechIarray);

    //-----------------------SUM Tickets Plainte client et incident en cours group by months-----------------------------
    $sumplainte = DB::table('otickets')->select(
        DB::raw("SUM(status = 'En cours' and ticket_type = 'Plainte client') as SUM")
    )
        ->whereNotNull('technician_incharge')
        ->groupBy(DB::raw("YEAR(creation_date), MONTH(creation_date)"))->get();
        $res_sum_plainte = json_decode(json_encode($sumplainte), true);
        //dd($res_sum_plainte);
        $count = 0;
        $iniplainte = [];
        foreach ($res_sum_plainte as $key => $valueArray) {
            foreach ($valueArray as $valueKey => $value) {
                $iniplainte[$count] = $value;
            }
            ++$count;
        }
        //dd($iniplainte);
    $sumincident = DB::table('otickets')->select(
        DB::raw("SUM(status = 'En cours' and ticket_type = 'Incident') as SUM")
    )
        ->whereNotNull('technician_incharge')
        ->groupBy(DB::raw("YEAR(creation_date), MONTH(creation_date)"))->get();
        //dd($dp1encours);
        $count = 0;
        $inincident = [];
        foreach ($sumincident as $key => $valueArray) {
            foreach ($valueArray as $valueKey => $value) {
                $inincident[$count] = $value;
            }
            ++$count;
        }
       // dd($inincident);

//---------------------------------------------------------------------------------------------------
        $sumstatus = DB::table('otickets')->select(
            DB::raw("
            SUM(status = 'En cours') AS SUM", 'initiator_eds_name,
            CASE
                WHEN initiator_eds_name LIKE %OCM_ERI% THEN ERICSSON
                WHEN initiator_eds_name LIKE %GNOC% THEN GNOC
                WHEN initiator_eds_name LIKE %OCM% THEN OCM
                ELSE Group EDS
                END AS Entreprise
                WHERE status IS NOT NULL')
        )
            ->whereNotNull('initiator_eds_name')

            ->groupBy('initiator_eds_name')->get();
        $res = json_decode(json_encode($sumstatus), true);
        //Comma separate the array------------------------------------------------------
        $dataArray = [];
        $count = 0;
        foreach ($res as $key => $valueArray) {
            foreach ($valueArray as $value) {

                $dataArray[$count] = $value;
            }
            ++$count;
        }
        //for sum like %eds -------------------------------------------------------------
        $sum = DB::table('otickets')->select(
            DB::raw("
                SUM(status = 'En cours') AS SUM", 'active_eds_name,
                    WHERE status IS NOT NULL')
        )
            ->whereNotNull('active_eds_name')
            ->groupBy(DB::raw("
            CASE
            WHEN active_eds_name LIKE '%_ERI_%' THEN 'ERICSSON'
            WHEN active_eds_name LIKE '%GNOC%' THEN 'GNOC'
            WHEN active_eds_name LIKE '%OCM %' THEN 'OCM'
            WHEN active_eds_name LIKE '%NOKIA%' THEN 'NOKIA'
            WHEN active_eds_name LIKE '%GOS%' THEN 'GOS'
            WHEN active_eds_name LIKE '%SSPO%' THEN 'SSPO'
            WHEN active_eds_name LIKE '%SMC%' THEN 'OCM'
            WHEN active_eds_name LIKE '%ALCATEL%' THEN 'ALCATEL'
            END"))
            ->get();
        $resum = json_decode(json_encode($sum), true);
        //dd($resum);
        //Comma separate the array------------------------------------------------------

        $dataArraySum = [];
        $count = 0;
        foreach ($resum as $key => $valueArray) {
            foreach ($valueArray as $value) {

                $dataArraySum[$count] = $value;
            }
            ++$count;
        }

        $edsinit = DB::table('otickets')->select(
            DB::raw("
                CASE
                WHEN active_eds_name LIKE '%_ERI_%' THEN 'ERICSSON'
                WHEN active_eds_name LIKE '%GNOC%' THEN 'GNOC'
                WHEN active_eds_name LIKE '%OCM %' THEN 'OCM'
                WHEN active_eds_name LIKE '%NOKIA%' THEN 'NOKIA'
                WHEN active_eds_name LIKE '%GOS%' THEN 'GOS'
                WHEN active_eds_name LIKE '%SSPO%' THEN 'SSPO'
                WHEN active_eds_name LIKE '%SMC%' THEN 'OCM'
                WHEN active_eds_name LIKE '%ALCATEL%' THEN 'ALCATEL'
END
            ")
        )
            ->whereNotNull('active_eds_name')
            ->groupBy(DB::raw("
            CASE
            WHEN active_eds_name LIKE '%_ERI_%' THEN 'ERICSSON'
            WHEN active_eds_name LIKE '%GNOC%' THEN 'GNOC'
            WHEN active_eds_name LIKE '%OCM %' THEN 'OCM'
            WHEN active_eds_name LIKE '%NOKIA%' THEN 'NOKIA'
            WHEN active_eds_name LIKE '%GOS%' THEN 'GOS'
            WHEN active_eds_name LIKE '%SSPO%' THEN 'SSPO'
            WHEN active_eds_name LIKE '%SMC%' THEN 'OCM'
            WHEN active_eds_name LIKE '%ALCATEL%' THEN 'ALCATEL'
            END"))->get();
        $rededs = json_decode(json_encode($edsinit), true);
        //dd($rededs);


        $count = 0;
        $initArrayEds = [];
        foreach ($edsinit as $key => $valueArray) {
            foreach ($valueArray as $valueKey => $value) {
                $initArrayEds[$count] = $value;
            }
            ++$count;
        }
        //dd($initArrayEds);
        // $colle = collect($res)->flatten();
        //dd($res);

        //-----------WEEK array----------------

        $week = DB::table('otickets')->select(
            DB::raw("WEEK(creation_date) as weekNum")
        )
            ->whereNotNull('initiator_eds_name')
            ->groupBy(DB::raw("WEEK(creation_date)"))->get();

        $count = 0;
        $initArrayWeek = [];
        foreach ($week as $key => $valueArray) {
            foreach ($valueArray as $valueKey => $value) {
                $initArrayWeek[$count] = "S " . $value;
            }
            ++$count;
        }

        //--------------Month Array -------------------
        $month = DB::table('otickets')->select(
            DB::raw("date_format(creation_date, '%M%Y') as month")
        )
        ->whereNotNull('technician_incharge')
        ->groupBy(DB::raw("YEAR(creation_date), MONTH(creation_date)"))->get();

        $count = 0;
        $initArrayMonth = [];
        foreach ($month as $key => $valueArray) {
            foreach ($valueArray as $valueKey => $value) {
                $initArrayMonth[$count] =  $value;
            }
            ++$count;
        }

        //dd($initArrayMonth);
        //----------------Tickets en cours Par semaine --------------
        $weektickEncours = DB::table('otickets')->select(
            DB::raw("COUNT(IF(status = 'En cours', 1, NULL)) 'ticket en cours'")
        )
            ->whereNotNull('initiator_eds_name')
            ->groupBy(DB::raw("WEEK(creation_date)"))->get();
        //dd($weektickEncours);
        $count = 0;
        $initArrayWeektickEncours = [];
        foreach ($weektickEncours as $key => $valueArray) {
            foreach ($valueArray as $valueKey => $value) {
                $initArrayWeektickEncours[$count] = $value;
            }
            ++$count;
        }

        //dd($initArrayWeektickEncours);

        //----------------------Tickets en cours Par Mois --------------
        $monthtickEncours = DB::table('otickets')->select(
            DB::raw("COUNT(IF(priority = 'P1' and status = 'En cours', 1, NULL)) 'P1',
            COUNT(IF(priority = 'P2' and status = 'En cours', 1, NULL)) 'P2',
            COUNT(IF(priority = 'P3' and status = 'En cours', 1, NULL)) 'P3',
            COUNT(IF(priority = 'P4' and status = 'En cours', 1, NULL)) 'P4'")
        )
            ->whereNotNull('initiator_eds_name')
            ->groupBy(DB::raw("MONTH(creation_date), YEAR(creation_date)"))->get();
        //dd($monthtickEncours);
        $count = 0;
        $initArrayMonthtickEncours = [];
        foreach ($monthtickEncours as $key => $valueArray) {
            foreach ($valueArray as $valueKey => $value) {
                $initArrayMonthtickEncours[$count] = $value;
            }
            ++$count;
        }
        //dd($initArrayMonthtickEncours);


        //$im = $colle->implode(', ', $colle);
        //dd($dataArray);

        /*foreach($hmm as $value){
          $value->;
        }exit;*/
        //$string = $hmm->implode($hmm, ',');
        //$string = implode(', ', $hmm);
        //dd($hmm);
        $tech1 = DB::table('otickets')
            ->select('otickets.priority')
            ->where('priority', '=', 'P2')
            ->get();
        //$tech = implode(', ', $tech);
        //dd($tech);

        /*foreach($dataclos as $dataclos){
            $dataclos = $dataclos->id;
           }
        $dataclos = implode(',' , $dataclos);
        dd($dataclos);*/
        //---------------------------- Technician Incharge array comma seperate ------------------------------------
        $technician = Oticket::selectRaw('technician_incharge')
            // ->where('status','=', 'En cours')
            ->groupBy('technician_incharge')
            ->whereNotNull('technician_incharge')->get();
        // ->pluck('technician_incharge');
        $imploded = $technician->implode(',', $technician);

        //dd($imploded);
        // dd($technician);
        //---------------------------- InitiatorIncharge array comma seperate ------------------------------------
        $initiat = Oticket::selectRaw('initiator_eds_name')
            ->groupBy('initiator_eds_name')
            ->whereNotNull('initiator_eds_name')->get();
        // ->pluck('initiator_groupname');
        // dd($initiat);
        $ini = json_decode(json_encode($initiat), true);
        // dd($ini);

        $count = 0;
        $initArray = [];
        foreach ($ini as $key => $valueArray) {
            foreach ($valueArray as $valueKey => $value) {
                $initArray[$count] = $value;
            }
            ++$count;
        }


        // dd($initArray);
        $tech = DB::table('otickets')
            ->select(DB::raw('group_concat(otickets.initiator_eds_name)'))
            ->groupBy('initiator_eds_name')
            ->get();

            $range = Carbon::now()->subDays(30);
            $stats = DB::table('otickets')
              ->where('created_at', '>=', $range)
              ->groupBy('date')
              ->orderBy('date', 'ASC')
              ->get([
                DB::raw('Date(created_at) as date'),
                DB::raw('COUNT(*) as value')
              ])
              ->toJSON();
              //dd($stats);

        //  -----------------------------------Charts Plotting-------------------------------------------
        //Pie Chart -------------------------------------
        /*$chartjs = app()->chartjs
            ->name('pieChartTest1')
            ->type('pie')
            ->size(['width' => 500, 'height' => 300])
            ->labels($initArray)
            ->datasets([
                [
                    'backgroundColor' => ['#FF8484', 'skyblue', 'brown', 'black', 'cyan', 'yellow', 'green', 'red', 'blue', 'purple', 'indigo', 'orange'],
                    'hoverBackgroundColor' => ['#FF6384', '#36A2EB'],
                    'data' => $dataArray,
                ],
            ])
            ->options([]);*/

        /*$piejs = app()->chartjs
            ->name('pieChartTest2')
            ->type('pie')
            ->size(['width' => 250, 'height' => 100])
            ->labels($initArrayEds)
            ->datasets([
                [
                    'backgroundColor' => ['cyan', 'purple', 'brown'],
                    'hoverBackgroundColor' => ['#FF6384', '#36A2EB'],
                    'data' => $dataArraySum,
                ],
            ])
            ->options([]);*/
        $piejs = new OticketsChart;
        $piejs->title('Ticket en cours par EDS Active');
        $piejs->labels($initArrayEds);
        $piejs->dataset('data','pie',$dataArraySum)->backgroundColor(['#ff0000', 'green', '#0000ff','orange','blue', 'cyan', 'brown']);
        
        /*$piejs = Charts::create('pie', 'highcharts')
            ->title('Ticket en cours par EDS Active')
            ->labels($initArrayEds)
            ->values($dataArraySum)
            ->colors(['#ff0000', 'green', '#0000ff','orange','blue', 'cyan', 'brown'])
            ->dimensions(500, 300)
            ->responsive(false);*/
        /*$chartjs = app()->chartjs
        ->name('lineChartTest')
        ->type('line')
        ->size(['width' => 400, 'height' => 200])
        ->labels($initArray)
        ->datasets([
            [
                'label' => 'My First dataset',
                'backgroundColor' => 'rgba(38, 185, 154, 0.31)',
                'borderColor' => 'rgba(38, 185, 154, 0.7)',
                'pointBorderColor' => 'rgba(38, 185, 154, 0.7)',
                'pointBackgroundColor' => 'rgba(38, 185, 154, 0.7)',
                'pointHoverBackgroundColor' => '#fff',
                'pointHoverBorderColor' => 'rgba(220,220,220,1)',
                'data' => $dataArray,
            ],
        ])
        ->options([]);*/
        /*$chartjs = app()->chartjs
         ->name('barChartTest')
         ->type('bar')
         ->size(['width' => 400, 'height' => 200])
         ->labels(['Label x', 'Label y'])
         ->datasets([
             [
                 'label' => 'My First dataset',
                 'backgroundColor' => ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)'],
                 'data' => [69, 59],
             ],
             [
                 'label' => 'My First dataset',
                 'backgroundColor' => ['rgba(255, 99, 132, 0.3)', 'rgba(54, 162, 235, 0.3)'],
                 'data' => [65, 12],
             ],
         ])
         ->options([]);*/

        //dd($tech);

        //$report = new MyReport;
        //$report->run();
        //Bar Chart Ticket en cours Vs Technician en charge -------------------------------------

        /*$oti = Charts::database(Oticket::all()->where('ticket_type','=','Incident'), 'bar', 'morris')
            ->title('Tickets en cours par Technicien en charge')
            ->elementLabel('Total')
            ->dimensions(600, 300)
            ->responsive(true)
            ->groupBy('technician_incharge');*/

        //Bar Chart Ticket total -------------------------------------
        /*$bar1 = Charts::database(Oticket::all(), 'bar', 'morris')
            ->title('Tickets total par mois')
            ->responsive(false)
            ->dimensions(300, 200)
            ->colors(['green', 'orange'])
            ->labels(['One', 'Two', 'Three'])
            ->lastByMonth(6, true);*/
        /*$bar2 = app()->chartjs
        ->name('barChartTest')
        ->type('bar')
        ->size(['width' => 400, 'height' => 200])
        ->labels($initArrayWeek)
        ->datasets([
            [
                "label" => "Tickets en cours",
                'backgroundColor' => ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)'],
                'data' => $initArrayWeektickEncours,
            ]
        ])
        ->options([]);*/

        /*$barP = Charts::create('bar', 'morris')
            ->title('Tickets Plainte client Par technicien Responsable En cours')
            ->elementLabel('Tickets PC en cours')
            ->labels($TechParray)
            ->values($sumParray)
            ->dimensions(800, 300)
            ->responsive(false);*/

        $barP = new OticketsChart;
        $barP->title('Tickets Plainte client Par technicien Responsable En cours');
        $barP->labels($TechParray);
        $barP->dataset('Tickets PC en cours','bar',$sumParray);
        $barP->width(800);
        $barP->height(300);
        $barP->options([
            'plugins' => '{datalabels: {color: \'white\'} }',    
            
        ]);

        $barI = new OticketsChart;
        $barI->title('Tickets Incident Par technicien Responsable En cours');
        $barI->labels($TechIarray);
        $barI->dataset('Tickets I en cours','bar',$sumIarray);
        $barI->width(800);
        $barI->height(300);
        $barI->options([
            'plugins' => '{datalabels: {color: \'white\'} }',    
            
        ]);


            /*$barI = Charts::create('bar', 'morris')
            ->title('Tickets Incident Par technicien Responsable En cours')
            ->elementLabel('Tickets I en cours')
            ->labels($TechIarray)
            ->values($sumIarray)
            ->dimensions(800, 300)
            ->responsive(false);*/

        //Bar Chart Ticket par priorite sur les mois -------------------------------------

        $chart = new OticketsChart;
        $chart->title('Tickets Plainte client et Incident EN COURS par Mois');
        $chart->labels($initArrayMonth);
        $chart->dataset('Ticket Plainte client en cours','bar', $iniplainte)->backgroundColor('green');
        $chart->dataset('Ticket Incident en cours','bar', $inincident)->backgroundColor('red');
        $chart->width(1000);
        $chart->height(350);
        $chart->options([
                'plugins' => '{datalabels: {color: \'black\'}}',
                //...
            'responsive' => true,
        //'aspectRatio' => 1,
        'tooltips' => ['enabled'=>true],
        'legend' => ['display' => true],
        'scales' => [
            'yAxes'=> [[
                        'display'=>true,
                        'ticks'=> ['beginAtZero'=> true],
                        'gridLines'=> ['display'=> true],
                      ]],
            'xAxes'=> [[
                        'categoryPercentage'=> 0.55,
                        //'barThickness' => 100,
                        'barPercentage' => 0.5,
                        'ticks' => ['beginAtZero' => true],
                        'gridLines' => ['display' => true],
                      ]],
        ],
        ]);

        /*$chart = Charts::multi('bar', 'chartjs')
        ->title('Tickets Plainte client et Incident EN COURS par Mois')
        ->elementLabel('Tickets en cours')
        ->labels($initArrayMonth)
        ->colors(['#ff0000', 'green', '#0000ff','orange'])
        ->dataset('Ticket Plainte client en cours', $iniplainte)
        ->dataset('Ticket Incident en cours', $inincident)
        ->dimensions(1000, 350);*/

        /* $bar = Charts::multi('bar', 'chartjs')
            ->title("Tickets en cours par mois")
            ->responsive(false)
            ->dimensions(400, 300)
            ->colors(['green', 'orange', 'blue'])
            ->labels(['One', 'Two', 'Three'])
            ->dataset('First Element', [25, 50, 100])
            ->dataset('Second Element', [40, 58, 70])
            ->dataset('Third Element', [15, 79, 95]);

        /*$pie = Charts::create('pie', 'chartjs')
            ->title("Tickets en cours par EDS")
            ->responsive(false)
            ->dimensions(400, 300)
            ->colors(['green', 'orange', 'blue'])
            ->labels(['One', 'Two', 'Three'])
            ->elementLabel("Total")
            ->values([25, 50, 100]);*/

        /* $line = Charts::database($datap1encours, 'line', 'chartjs')
            ->title("Tickets P1 Total du Mois")
            ->elementLabel("Total Tickets")
            ->dimensions(400, 250)
            ->responsive(false);*/

        return view('home', compact('hmm','barP','barI','dataavispro','dataclosprtableau', 'piejs', 'technician','datap1encoursPlainte','datap1encoursInci', 'chart', 'dataclos', 'datap2encoursPlainte', 'datap2encoursInci','datap3encoursPlainte','datap3encoursInci', 'data', 'dataencours', 'datap4encoursPlainte','datap4encoursInci'));
    }

    public function test()
    {
        return view('testhome');
    }

    public function Chartjs()
    {
        $month = array('Jan', 'Feb', 'Mar', 'Apr', 'May');
        $data = array(1, 2, 3, 4, 5);

        return view('home', ['Months' => $month, 'Data' => $data]);
    }
}
