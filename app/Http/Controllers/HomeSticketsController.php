<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
//use ConsoleTVs\Charts\Facades\Charts;
use App\Sticket;
use Illuminate\Http\Request;
use App\Charts\SticketsChart;


class HomeSticketsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        
        $data = Carbon::now();
        $stickets = Sticket::all();

        $datavalidestandardANO = DB::table('stickets')->where('libell_state', '=', 'Validé')->where('libell_operation_type','=','TP standard ANO')->count();
        $datavalidestandardOCM = DB::table('stickets')->where('libell_state', '=', 'Validé')->where('libell_operation_type','=','TP standard OCM')->count();
        $dataterminestandardOCM = DB::table('stickets')->where('libell_state', '=', 'Terminé')->where('libell_operation_type','=','TP standard OCM')->count();
        $dataterminestandardANO = DB::table('stickets')->where('libell_state', '=', 'Terminé')->where('libell_operation_type','=','TP standard ANO')->count();
        $dataprepastandardANO = DB::table('stickets')->where('libell_state', '=', 'Préparé')->where('libell_operation_type','=','TP standard ANO')->count();
        $dataprepastandardOCM = DB::table('stickets')->where('libell_state', '=', 'Préparé')->where('libell_operation_type','=','TP standard OCM')->count();
        $dataini = DB::table('stickets')->where('libell_state', '=', 'Initialisé')->count();
        $databilan = DB::table('stickets')->where('libell_state', '=', 'Bilan réalisé')->count();
        $dataencoursnormalOCM = DB::table('stickets')->where('libell_state', '=', 'En cours')->where('libell_operation_type','=','TP normal OCM')->count();
        $dataencoursstandardOCM = DB::table('stickets')->where('libell_state', '=', 'En cours')->where('libell_operation_type','=','TP standard OCM')->count();
        $dataprisnormalOCM = DB::table('stickets')->where('libell_state', '=', 'Pris en charge')->where('libell_operation_type','=','TP normal OCM')->count();
        $dataprisstandardOCM = DB::table('stickets')->where('libell_state', '=', 'Pris en charge')->where('libell_operation_type','=','TP standard OCM')->count();

        

        $edsinit = DB::table('stickets')->select(
            DB::raw("COUNT(IF(libell_state = 'Annulé', 1, NULL)) 'Annulé',
            COUNT(IF(libell_state = 'Bilan réalisé' , 1, NULL)) 'Bilan réalisé',
            COUNT(IF(libell_state = 'Clos' , 1, NULL)) 'Clos',
            COUNT(IF(libell_state = 'Commencé' , 1, NULL)) 'Commencé',
            COUNT(IF(libell_state = 'En cours' , 1, NULL)) 'En cours',
            COUNT(IF(libell_state = 'Initialisé' , 1, NULL)) 'Initialisé',
            COUNT(IF(libell_state = 'Préparé' , 1, NULL)) 'Préparé',
            COUNT(IF(libell_state = 'Pris en charge' , 1, NULL)) 'Pris en charge',
            COUNT(IF(libell_state = 'Reporté' , 1, NULL)) 'Reporté',
            COUNT(IF(libell_state = 'Terminé' , 1, NULL)) 'Terminé',
            COUNT(IF(libell_state = 'Traité en CAB' , 1, NULL)) 'Traité en CAB',
            COUNT(IF(libell_state = 'Validé' , 1, NULL)) 'Validé',
            CASE
            WHEN eds_pilote_name LIKE '%_ERI_%' THEN 'ERICSSON'
            WHEN eds_pilote_name LIKE '%GNOC%' THEN 'GNOC'
            WHEN eds_pilote_name LIKE '%OCM %' THEN 'OCM'
            WHEN eds_pilote_name LIKE '%NOKIA%' THEN 'NOKIA'
            WHEN eds_pilote_name LIKE '%GOS%' THEN 'GOS'
            WHEN eds_pilote_name LIKE '%SSPO%' THEN 'SSPO'
            WHEN eds_pilote_name LIKE '%SMC%' THEN 'OCM'
            WHEN eds_pilote_name LIKE '%ALCATEL%' THEN 'ALCATEL'
            ELSE 'Aucun Group EDS Pilote'
            END AS Entreprise")
        )
            ->groupBy(DB::raw("
            CASE
            WHEN eds_pilote_name LIKE '%_ERI_%' THEN 'ERICSSON'
            WHEN eds_pilote_name LIKE '%GNOC%' THEN 'GNOC'
            WHEN eds_pilote_name LIKE '%OCM %' THEN 'OCM'
            WHEN eds_pilote_name LIKE '%NOKIA%' THEN 'NOKIA'
            WHEN eds_pilote_name LIKE '%GOS%' THEN 'GOS'
            WHEN eds_pilote_name LIKE '%SSPO%' THEN 'SSPO'
            WHEN eds_pilote_name LIKE '%SMC%' THEN 'OCM'
            WHEN eds_pilote_name LIKE '%ALCATEL%' THEN 'ALCATEL'
            END"))->get();
        $rededs = json_decode(json_encode($edsinit), true);
        //dd($rededs);

       
        $count = 0;
        $initArrayEds = [];
        foreach ($rededs as $key => $valueArray) {
            foreach ($valueArray as $valueKey => $value) {
                $initArrayEds[$count] = $value;

            }
            ++$count;
        }
        //dd($initArrayEds);

        //LIBELLE_STATUS -----------------------------------------------
        $libel_status = DB::table('stickets')->select(
            DB::raw("libell_state"))
            ->whereNotNull('libell_state')
            ->groupBy('libell_state')
            ->get();
        $deco_status = json_decode(json_encode($libel_status), true);
        //dd($deco_status);
        $count = 0;
        $initStatus = [];
        foreach ($deco_status as $key => $valueArray) {
            foreach ($valueArray as $valueKey => $value) {
                $initStatus[$count] = $value;
            }
            ++$count;
        }
        //dd($initStatus);
        //-----------------------------------------------------------------
           

        $values = DB::table('stickets')->select(
            DB::raw("COUNT(IF(libell_state = 'Annulé', 1, NULL)) 'Annulé',
            COUNT(IF(libell_state = 'Bilan réalisé' , 1, NULL)) 'Bilan réalisé',
            COUNT(IF(libell_state = 'Clos' , 1, NULL)) 'Clos',
            COUNT(IF(libell_state = 'Commencé' , 1, NULL)) 'Commencé',
            COUNT(IF(libell_state = 'En cours' , 1, NULL)) 'En cours',
            COUNT(IF(libell_state = 'Initialisé' , 1, NULL)) 'Initialisé',
            COUNT(IF(libell_state = 'Préparé' , 1, NULL)) 'Préparé',
            COUNT(IF(libell_state = 'Pris en charge' , 1, NULL)) 'Pris en charge',
            COUNT(IF(libell_state = 'Reporté' , 1, NULL)) 'Reporté',
            COUNT(IF(libell_state = 'Terminé' , 1, NULL)) 'Terminé',
            COUNT(IF(libell_state = 'Traité en CAB' , 1, NULL)) 'Traité en CAB',
            COUNT(IF(libell_state = 'Validé' , 1, NULL)) 'Validé'
            "))
            ->groupBy(DB::raw("
            CASE
            WHEN eds_pilote_name LIKE '%_ERI_%' THEN 'ERICSSON'
            WHEN eds_pilote_name LIKE '%GNOC%' THEN 'GNOC'
            WHEN eds_pilote_name LIKE '%OCM %' THEN 'OCM'
            WHEN eds_pilote_name LIKE '%NOKIA%' THEN 'NOKIA'
            WHEN eds_pilote_name LIKE '%GOS%' THEN 'GOS'
            WHEN eds_pilote_name LIKE '%SSPO%' THEN 'SSPO'
            WHEN eds_pilote_name LIKE '%SMC%' THEN 'OCM'
            WHEN eds_pilote_name LIKE '%ALCATEL%' THEN 'ALCATEL'
            end"))->get();
        $deco = json_decode(json_encode($values), true);
        //dd($deco);
        $count = 0;
        $initValues = [];
        foreach ($deco as $key => $valueArray) {
            foreach ($valueArray as $valueKey => $value) {
                $initValues[$valueKey] = $value;
            }
            ++$count;
        }
        //dd($initValues);




        //---------------------- count Annulé ------------------------------
        $count_annule = DB::table('stickets')->select(
            DB::raw("COUNT(IF(libell_state = 'Annulé', 1, NULL)) 'Annulé'"))
            ->whereNotNull('libell_state')
            ->groupBy(DB::raw("week(creation_date, 1)"))->get();
        $deco_annule = json_decode(json_encode($count_annule), true);
        //dd($deco_bilan);
        $count = 0;
        $initannule = [];
        foreach ($deco_annule as $key => $valueArray) {
            foreach ($valueArray as $valueKey => $value) {
                $initannule[$count] = $value;
            }
            ++$count;
        }
        //dd($initannule);
        $annule = DB::table('stickets')->select(
            DB::raw("COUNT(IF(libell_state = 'Annulé', 1, NULL)) 'Annulé'"))
            ->whereNotNull('libell_state')
            ->groupBy(DB::raw("CASE
            WHEN eds_pilote_name LIKE '%_ERI_%' THEN 'ERICSSON'
                       WHEN eds_pilote_name LIKE '%GNOC%' THEN 'GNOC'
                       WHEN eds_pilote_name LIKE '%OCM %' THEN 'OCM'
                       WHEN eds_pilote_name LIKE '%NOKIA%' THEN 'NOKIA'
                       WHEN eds_pilote_name LIKE '%GOS%' THEN 'GOS'
                       WHEN eds_pilote_name LIKE '%SSPO%' THEN 'SSPO'
                       WHEN eds_pilote_name LIKE '%SMC%' THEN 'OCM'
                       WHEN eds_pilote_name LIKE '%ALCATEL%' THEN 'ALCATEL'
            end"))->get();
        $de_annule = json_decode(json_encode($annule), true);
        //dd($deco_bilan);
        $count = 0;
        $Arrayannule = [];
        foreach ($de_annule as $key => $valueArray) {
            foreach ($valueArray as $valueKey => $value) {
                $Arrayannule[$count] = $value;
            }
            ++$count;
        }
        //dd($Arrayannule);

        //---------------------- count Bilan réalisé ------------------------------
        $count_bilan = DB::table('stickets')->select(
            DB::raw("COUNT(IF(libell_state = 'Bilan réalisé', 1, NULL)) 'Bilan réalisé'"))
            ->whereNotNull('libell_state')
            ->groupBy(DB::raw("week(creation_date, 1)"))->get();
        $deco_bilan = json_decode(json_encode($count_bilan), true);
        //dd($deco_bilan);
        $count = 0;
        $initbilan = [];
        foreach ($deco_bilan as $key => $valueArray) {
            foreach ($valueArray as $valueKey => $value) {
                $initbilan[$count] = $value;
            }
            ++$count;
        }

        $count_bilan_ope = DB::table('stickets')->select(
            DB::raw("COUNT(IF(libell_state = 'Bilan réalisé', 1, NULL)) 'Bilan réalisé'"))
            ->whereNotNull('libell_state')
            ->groupBy('libell_operation_type')->get();
        $deco_bilan_ope = json_decode(json_encode($count_bilan_ope), true);
        //dd($deco_bilan);
        $count = 0;
        $initbilanOp = [];
        foreach ($deco_bilan_ope as $key => $valueArray) {
            foreach ($valueArray as $valueKey => $value) {
                $initbilanOp[$count] = $value;
            }
            ++$count;
        }
        //dd($initbilanOp);
        $bilan = DB::table('stickets')->select(
            DB::raw("COUNT(IF(libell_state = 'Bilan réalisé', 1, NULL)) 'Bilan réalisé'"))
            ->whereNotNull('libell_state')
            ->groupBy(DB::raw("CASE
            WHEN eds_pilote_name LIKE '%_ERI_%' THEN 'ERICSSON'
                       WHEN eds_pilote_name LIKE '%GNOC%' THEN 'GNOC'
                       WHEN eds_pilote_name LIKE '%OCM %' THEN 'OCM'
                       WHEN eds_pilote_name LIKE '%NOKIA%' THEN 'NOKIA'
                       WHEN eds_pilote_name LIKE '%GOS%' THEN 'GOS'
                       WHEN eds_pilote_name LIKE '%SSPO%' THEN 'SSPO'
                       WHEN eds_pilote_name LIKE '%SMC%' THEN 'OCM'
                       WHEN eds_pilote_name LIKE '%ALCATEL%' THEN 'ALCATEL'
            end"))->get();
        $de_bila = json_decode(json_encode($bilan), true);
        //dd($deco_bilan);
        $count = 0;
        $Arraybilan = [];
        foreach ($de_bila as $key => $valueArray) {
            foreach ($valueArray as $valueKey => $value) {
                $Arraybilan[$count] = $value;
            }
            ++$count;
        }


        $count_clos = DB::table('stickets')->select(
            DB::raw("COUNT(IF(libell_state = 'Clos', 1, NULL)) 'Clos'"))
            ->whereNotNull('libell_state')
            ->groupBy(DB::raw("week(creation_date, 1)"))->get();
        $deco_c = json_decode(json_encode($count_clos), true);
        //dd($deco_bilan);
        $count = 0;
        $initclos = [];
        foreach ($deco_c as $key => $valueArray) {
            foreach ($valueArray as $valueKey => $value) {
                $initclos[$count] = $value;
            }
            ++$count;
        }

        $count_clos_ope = DB::table('stickets')->select(
            DB::raw("COUNT(IF(libell_state = 'Clos', 1, NULL)) 'Clos'"))
            ->whereNotNull('libell_state')
            ->groupBy('libell_operation_type')->get();
            // dd($count_clos_ope);
        $deco_c_ope = json_decode(json_encode($count_clos_ope), true);
        //dd($deco_bilan);
        $count = 0;
        $initclosOpe = [];
        foreach ($deco_c_ope as $key => $valueArray) {
            foreach ($valueArray as $valueKey => $value) {
                $initclosOpe[$count] = $value;
            }
            ++$count;
        }
        //dd($initclosOpe);
        
        $clos = DB::table('stickets')->select(
            DB::raw("COUNT(IF(libell_state = 'Clos', 1, NULL)) 'Clos'"))
            ->whereNotNull('libell_state')
            ->groupBy(DB::raw("CASE
            WHEN eds_pilote_name LIKE '%_ERI_%' THEN 'ERICSSON'
                       WHEN eds_pilote_name LIKE '%GNOC%' THEN 'GNOC'
                       WHEN eds_pilote_name LIKE '%OCM %' THEN 'OCM'
                       WHEN eds_pilote_name LIKE '%NOKIA%' THEN 'NOKIA'
                       WHEN eds_pilote_name LIKE '%GOS%' THEN 'GOS'
                       WHEN eds_pilote_name LIKE '%SSPO%' THEN 'SSPO'
                       WHEN eds_pilote_name LIKE '%SMC%' THEN 'OCM'
                       WHEN eds_pilote_name LIKE '%ALCATEL%' THEN 'ALCATEL'
            end"))->get();
        $de_clos = json_decode(json_encode($clos), true);
        //dd($deco_bilan);
        $count = 0;
        $Arrayclos = [];
        foreach ($de_clos as $key => $valueArray) {
            foreach ($valueArray as $valueKey => $value) {
                $Arrayclos[$count] = $value;
            }
            ++$count;
        }


        //---------------------- count En cours ------------------------------
        $count_encours = DB::table('stickets')->select(
            DB::raw("COUNT(IF(libell_state = 'En cours', 1, NULL)) 'En cours'"))
            ->whereNotNull('libell_state')
            ->groupBy(DB::raw("week(creation_date, 1)"))->get();
        $deco_encours = json_decode(json_encode($count_encours), true);
        //dd($deco_bilan);
        $count = 0;
        $initencours = [];
        foreach ($deco_encours as $key => $valueArray) {
            foreach ($valueArray as $valueKey => $value) {
                $initencours[$count] = $value;
            }
            ++$count;
        }
        //dd($initbilan);



        $count_encours_ope = DB::table('stickets')->select(
            DB::raw("COUNT(IF(libell_state = 'En cours', 1, NULL)) 'En cours'"))
            ->whereNotNull('libell_state')
            ->groupBy('libell_operation_type')->get();
        $deco_encours_ope = json_decode(json_encode($count_encours_ope), true);
        //dd($deco_bilan);
        $count = 0;
        $initencoursOp = [];
        foreach ($deco_encours_ope as $key => $valueArray) {
            foreach ($valueArray as $valueKey => $value) {
                $initencoursOp[$count] = $value;
            }
            ++$count;
        }

        $encours = DB::table('stickets')->select(
            DB::raw("COUNT(IF(libell_state = 'En cours', 1, NULL)) 'En cours'"))
            ->whereNotNull('libell_state')
            ->groupBy(DB::raw("CASE
            WHEN eds_pilote_name LIKE '%_ERI_%' THEN 'ERICSSON'
                       WHEN eds_pilote_name LIKE '%GNOC%' THEN 'GNOC'
                       WHEN eds_pilote_name LIKE '%OCM %' THEN 'OCM'
                       WHEN eds_pilote_name LIKE '%NOKIA%' THEN 'NOKIA'
                       WHEN eds_pilote_name LIKE '%GOS%' THEN 'GOS'
                       WHEN eds_pilote_name LIKE '%SSPO%' THEN 'SSPO'
                       WHEN eds_pilote_name LIKE '%SMC%' THEN 'OCM'
                       WHEN eds_pilote_name LIKE '%ALCATEL%' THEN 'ALCATEL'
            end"))->get();
        $de_encours = json_decode(json_encode($encours), true);
        //dd($deco_bilan);
        $count = 0;
        $Arrayencours = [];
        foreach ($de_encours as $key => $valueArray) {
            foreach ($valueArray as $valueKey => $value) {
                $Arrayencours[$count] = $value;
            }
            ++$count;
        }


        //---------------------- count Initialise ------------------------------
        $count_initia = DB::table('stickets')->select(
            DB::raw("COUNT(IF(libell_state = 'Initialisé', 1, NULL)) 'Initialisé'"))
            ->whereNotNull('libell_state')
            ->groupBy(DB::raw("week(creation_date, 1)"))->get();
        $deco_initia = json_decode(json_encode($count_initia), true);
        //dd($deco_bilan);
        $count = 0;
        $initInitia = [];
        foreach ($deco_initia as $key => $valueArray) {
            foreach ($valueArray as $valueKey => $value) {
                $initInitia[$count] = $value;
            }
            ++$count;
        }

        $initia = DB::table('stickets')->select(
            DB::raw("COUNT(IF(libell_state = 'Initialisé', 1, NULL)) 'Initialisé'"))
            ->whereNotNull('libell_state')
            ->groupBy(DB::raw("CASE
            WHEN eds_pilote_name LIKE '%_ERI_%' THEN 'ERICSSON'
                       WHEN eds_pilote_name LIKE '%GNOC%' THEN 'GNOC'
                       WHEN eds_pilote_name LIKE '%OCM %' THEN 'OCM'
                       WHEN eds_pilote_name LIKE '%NOKIA%' THEN 'NOKIA'
                       WHEN eds_pilote_name LIKE '%GOS%' THEN 'GOS'
                       WHEN eds_pilote_name LIKE '%SSPO%' THEN 'SSPO'
                       WHEN eds_pilote_name LIKE '%SMC%' THEN 'OCM'
                       WHEN eds_pilote_name LIKE '%ALCATEL%' THEN 'ALCATEL'
            end"))->get();
        $de_initia = json_decode(json_encode($initia), true);
        //dd($deco_bilan);
        $count = 0;
        $ArrayInitia = [];
        foreach ($de_initia as $key => $valueArray) {
            foreach ($valueArray as $valueKey => $value) {
                $ArrayInitia[$count] = $value;
            }
            ++$count;
        }
        

         //---------------------- count Préparé ------------------------------
         $prepare = DB::table('stickets')->select(
            DB::raw("COUNT(IF(libell_state = 'Préparé', 1, NULL)) 'Préparé'"))
            ->whereNotNull('libell_state')
            ->groupBy(DB::raw("week(creation_date, 1)"))->get();
        $deco_prepare = json_decode(json_encode($prepare), true);
        //dd($deco_bilan);
        $count = 0;
        $initprepa = [];
        foreach ($deco_prepare as $key => $valueArray) {
            foreach ($valueArray as $valueKey => $value) {
                $initprepa[$count] = $value;
            }
            ++$count;
        }


        $prepare_ope = DB::table('stickets')->select(
            DB::raw("COUNT(IF(libell_state = 'Préparé', 1, NULL)) 'Préparé'"))
            ->whereNotNull('libell_state')
            ->groupBy('libell_operation_type')->get();
        $deco_prepare_op = json_decode(json_encode($prepare_ope), true);
        //dd($deco_bilan);
        $count = 0;
        $initprepaOP = [];
        foreach ($deco_prepare_op as $key => $valueArray) {
            foreach ($valueArray as $valueKey => $value) {
                $initprepaOP[$count] = $value;
            }
            ++$count;
        }

        $prepa = DB::table('stickets')->select(
            DB::raw("COUNT(IF(libell_state = 'Préparé', 1, NULL)) 'Préparé'"))
            ->whereNotNull('libell_state')
            ->groupBy(DB::raw("CASE
            WHEN eds_pilote_name LIKE '%_ERI_%' THEN 'ERICSSON'
                       WHEN eds_pilote_name LIKE '%GNOC%' THEN 'GNOC'
                       WHEN eds_pilote_name LIKE '%OCM %' THEN 'OCM'
                       WHEN eds_pilote_name LIKE '%NOKIA%' THEN 'NOKIA'
                       WHEN eds_pilote_name LIKE '%GOS%' THEN 'GOS'
                       WHEN eds_pilote_name LIKE '%SSPO%' THEN 'SSPO'
                       WHEN eds_pilote_name LIKE '%SMC%' THEN 'OCM'
                       WHEN eds_pilote_name LIKE '%ALCATEL%' THEN 'ALCATEL'
            end"))->get();
        $de_prepare = json_decode(json_encode($prepa), true);
        //dd($deco_bilan);
        $count = 0;
        $Arrayprepa = [];
        foreach ($de_prepare as $key => $valueArray) {
            foreach ($valueArray as $valueKey => $value) {
                $Arrayprepa[$count] = $value;
            }
            ++$count;
        }
        

        //---------------------- count Pris en charge ------------------------------
        $count_pris = DB::table('stickets')->select(
            DB::raw("COUNT(IF(libell_state = 'Pris en charge', 1, NULL)) 'Pris en charge'"))
            ->whereNotNull('libell_state')
            ->groupBy(DB::raw("week(creation_date, 1)"))->get();
        $deco_pris = json_decode(json_encode($count_pris), true);
        //dd($deco_bilan);
        $count = 0;
        $initpris = [];
        foreach ($deco_pris as $key => $valueArray) {
            foreach ($valueArray as $valueKey => $value) {
                $initpris[$count] = $value;
            }
            ++$count;
        }

        $pris = DB::table('stickets')->select(
            DB::raw("COUNT(IF(libell_state = 'Pris en charge', 1, NULL)) 'Pris en charge'"))
            ->whereNotNull('libell_state')
            ->groupBy(DB::raw("CASE
            WHEN eds_pilote_name LIKE '%_ERI_%' THEN 'ERICSSON'
                       WHEN eds_pilote_name LIKE '%GNOC%' THEN 'GNOC'
                       WHEN eds_pilote_name LIKE '%OCM %' THEN 'OCM'
                       WHEN eds_pilote_name LIKE '%NOKIA%' THEN 'NOKIA'
                       WHEN eds_pilote_name LIKE '%GOS%' THEN 'GOS'
                       WHEN eds_pilote_name LIKE '%SSPO%' THEN 'SSPO'
                       WHEN eds_pilote_name LIKE '%SMC%' THEN 'OCM'
                       WHEN eds_pilote_name LIKE '%ALCATEL%' THEN 'ALCATEL'
            end"))->get();
        $de_pris = json_decode(json_encode($pris), true);
        //dd($pris);
        $count = 0;
        $Arraypris = [];
        foreach ($de_pris as $key => $valueArray) {
            foreach ($valueArray as $valueKey => $value) {
                $Arraypris[$count] = $value;
            }
            ++$count;
        }

        //---------------------- count Validé ------------------------------
        $count_valide = DB::table('stickets')->select(
            DB::raw("COUNT(IF(libell_state = 'Validé', 1, NULL)) 'Validé'"))
            ->whereNotNull('libell_state')
            ->groupBy(DB::raw("week(creation_date, 1)"))->get();
        $deco_valide = json_decode(json_encode($count_valide), true);
        //dd($deco_bilan);
        $count = 0;
        $initvalide = [];
        foreach ($deco_valide as $key => $valueArray) {
            foreach ($valueArray as $valueKey => $value) {
                $initvalide[$count] = $value;
            }
            ++$count;
        }

        $valide = DB::table('stickets')->select(
            DB::raw("COUNT(IF(libell_state = 'Validé', 1, NULL)) 'Validé'"))
            ->whereNotNull('libell_state')
            ->groupBy(DB::raw("CASE
            WHEN eds_pilote_name LIKE '%_ERI_%' THEN 'ERICSSON'
                       WHEN eds_pilote_name LIKE '%GNOC%' THEN 'GNOC'
                       WHEN eds_pilote_name LIKE '%OCM %' THEN 'OCM'
                       WHEN eds_pilote_name LIKE '%NOKIA%' THEN 'NOKIA'
                       WHEN eds_pilote_name LIKE '%GOS%' THEN 'GOS'
                       WHEN eds_pilote_name LIKE '%SSPO%' THEN 'SSPO'
                       WHEN eds_pilote_name LIKE '%SMC%' THEN 'OCM'
                       WHEN eds_pilote_name LIKE '%ALCATEL%' THEN 'ALCATEL'
            end"))->get();
        $de_valide = json_decode(json_encode($valide), true);
        //dd($deco_bilan);
        $count = 0;
        $Arrayvalide = [];
        foreach ($de_valide as $key => $valueArray) {
            foreach ($valueArray as $valueKey => $value) {
                $Arrayvalide[$count] = $value;
            }
            ++$count;
        }

         //---------------------- count termine ------------------------------
         $count_termine = DB::table('stickets')->select(
            DB::raw("COUNT(IF(libell_state = 'Terminé', 1, NULL)) 'Terminé'"))
            ->whereNotNull('libell_state')
            ->groupBy(DB::raw("week(creation_date, 1)"))->get();
        $deco_termine = json_decode(json_encode($count_termine), true);
        //dd($deco_anulle);
        $count = 0;
        $initermine = [];
        foreach ($deco_termine as $key => $valueArray) {
            foreach ($valueArray as $valueKey => $value) {
                $initermine[$count] = $value;
            }
            ++$count;
        }
        //dd($initermine);

        $termine = DB::table('stickets')->select(
            DB::raw("COUNT(IF(libell_state = 'Terminé', 1, NULL)) 'Terminé'"))
            ->whereNotNull('libell_state')
            ->groupBy(DB::raw("CASE
            WHEN eds_pilote_name LIKE '%_ERI_%' THEN 'ERICSSON'
                       WHEN eds_pilote_name LIKE '%GNOC%' THEN 'GNOC'
                       WHEN eds_pilote_name LIKE '%OCM %' THEN 'OCM'
                       WHEN eds_pilote_name LIKE '%NOKIA%' THEN 'NOKIA'
                       WHEN eds_pilote_name LIKE '%GOS%' THEN 'GOS'
                       WHEN eds_pilote_name LIKE '%SSPO%' THEN 'SSPO'
                       WHEN eds_pilote_name LIKE '%SMC%' THEN 'OCM'
                       WHEN eds_pilote_name LIKE '%ALCATEL%' THEN 'ALCATEL'
            end"))->get();
        $de_termine = json_decode(json_encode($termine), true);
        //dd($deco_anulle);
        $count = 0;
        $Arraytermine = [];
        foreach ($de_termine as $key => $valueArray) {
            foreach ($valueArray as $valueKey => $value) {
                $Arraytermine[$count] = $value;
            }
            ++$count;
        }


        $count_traite = DB::table('stickets')->select(
            DB::raw("COUNT(IF(libell_state = 'Traité en CAB', 1, NULL)) 'Traité en CAB'"))
            ->whereNotNull('libell_state')
            ->groupBy(DB::raw("week(creation_date, 1)"))->get();
        $deco_traite = json_decode(json_encode($count_traite), true);
        //dd($deco_bilan);
        $count = 0;
        $inittraite = [];
        foreach ($deco_traite as $key => $valueArray) {
            foreach ($valueArray as $valueKey => $value) {
                $inittraite[$count] = $value;
            }
            ++$count;
        }

        $traite = DB::table('stickets')->select(
            DB::raw("COUNT(IF(libell_state = 'Traité en CAB', 1, NULL)) 'Traité en CAB'"))
            ->whereNotNull('libell_state')
            ->groupBy(DB::raw("CASE
            WHEN eds_pilote_name LIKE '%_ERI_%' THEN 'ERICSSON'
                       WHEN eds_pilote_name LIKE '%GNOC%' THEN 'GNOC'
                       WHEN eds_pilote_name LIKE '%OCM %' THEN 'OCM'
                       WHEN eds_pilote_name LIKE '%NOKIA%' THEN 'NOKIA'
                       WHEN eds_pilote_name LIKE '%GOS%' THEN 'GOS'
                       WHEN eds_pilote_name LIKE '%SSPO%' THEN 'SSPO'
                       WHEN eds_pilote_name LIKE '%SMC%' THEN 'OCM'
                       WHEN eds_pilote_name LIKE '%ALCATEL%' THEN 'ALCATEL'
            end"))->get();
        $de_traite = json_decode(json_encode($traite), true);
        //dd($deco_anulle);
        $count = 0;
        $Arraytraite = [];
        foreach ($de_traite as $key => $valueArray) {
            foreach ($valueArray as $valueKey => $value) {
                $Arraytraite[$count] = $value;
            }
            ++$count;
        }


        $operation = DB::table('stickets')->select('libell_operation_type')->groupBy('libell_operation_type')->pluck('libell_operation_type');
        $de_op = json_decode(json_encode($operation), true);
        //dd($de_op);



        // Week Array -----------------------------------------------------------------------
        $week = DB::table('stickets')->select(
            DB::raw("WEEK(creation_date, 1) as weekNum")
        )
            ->whereNotNull('libell_state')
            ->groupBy(DB::raw("WEEK(creation_date, 1)"))->get();

        $count = 0;
        $initArrayWeek = [];
        foreach ($week as $key => $valueArray) {
            foreach ($valueArray as $valueKey => $value) {
                $initArrayWeek[$count] = "S " . $value;
            }
            ++$count;
        }
        //dd($initArrayWeek);

        
        $api = url('/chart-line-ajax');
   

        // Charts plotting ---------------------------------------------------------------------



        $bar_operation = new SticketsChart;
        $bar_operation->title('Evolution des Etats des OTs par Operation');
        $bar_operation->labels($de_op);
        $bar_operation->dataset('Etat Bilan realisé','line',$initbilanOp);
        $bar_operation->dataset('Etat Clos','line',$initclosOpe);
        $bar_operation->dataset('Etat En cours','line',$initencoursOp);
        $bar_operation->dataset('Etat Prepare','line',$initprepaOP);
        $bar_operation->height(350);
        $bar_operation->width(650);
        $bar_operation->options([
            'plotOptions' => [
                'line' => [
                    'dataLabels' => [
                        'enabled' => true,
                    ],
                ],
            ],
        ]);
        //dd($bar_operation);

      

        $bar =  new SticketsChart;
        $bar->title('Evolution des Etats des OTs à Date');
        $bar->labels($initArrayWeek);
        $bar->dataset('Etat Bilan realisé','bar',$initbilan);
        $bar->dataset('Etat Annulé','bar',$initannule);
        $bar->dataset('Etat Clos','bar',$initclos);
        $bar->dataset('Etat En cours','bar',$initencours);
        $bar->dataset('Etat Initialisé','bar',$initInitia);
        $bar->dataset('Etat Préparé','bar',$initprepa);
        $bar->dataset('Etat Pris en charge','bar',$initpris);
        $bar->dataset('Etat Validé','bar',$initvalide);
        $bar->dataset('Etat Terminé','bar',$initermine);
        $bar->dataset('Etat Traité en CAB','bar',$inittraite);
        //$bar->loaderColor(['#ff0000', 'green', 'black','orange','blue', 'grey', 'brown','yellow','#55135c']);
        $bar->height(350);
        $bar->width(1050);
        $bar->options([
            'plotOptions' => [
                'bar' => [
                    'dataLabels' => [
                        'enabled' => true,
                    ],
                ],
            ],
        ]);

       
        /*$bar = Charts::multi('bar', 'c3')
        ->title('Evolution des Etats des OTs à Date')
        ->dataset('Etat Bilan realisé',$initbilan)
        ->dataset('Etat Annulé',$initannule)
        ->dataset('Etat Clos',$initclos)
        ->dataset('Etat En cours',$initencours)
        ->dataset('Etat Initialisé',$initInitia)
        ->dataset('Etat Préparé',$initprepa)
        ->dataset('Etat Pris en charge',$initpris)
        ->dataset('Etat Validé',$initvalide)
        ->dataset('Etat Terminé',$initermine)
        ->dataset('Etat Traité en CAB',$inittraite)
        //->colors(['#ff0000', 'green', 'black','orange','blue', 'grey', 'brown','yellow','#55135c'])
        ->dimensions(1050, 350)
        ->responsive(false);*/

        
        $bar_eds_pilote = new SticketsChart;
        $bar_eds_pilote->title('Evolution des Etats des OTs Par EDS Pilote');
        $bar_eds_pilote->labels($initArrayEds);
        $bar_eds_pilote->dataset('Etat Annulé','bar',$Arrayannule);
        $bar_eds_pilote->dataset('Etat Bilan realisé','bar',$Arraybilan);
        $bar_eds_pilote->dataset('Etat En cours','bar',$Arrayencours);
        $bar_eds_pilote->dataset('Etat Clos','bar',$Arrayclos);
        $bar_eds_pilote->dataset('Etat Initialisé','bar',$ArrayInitia);
        $bar_eds_pilote->dataset('Etat Préparé','bar',$Arrayprepa);
        $bar_eds_pilote->dataset('Etat Pris en charge','bar',$Arraypris);
        $bar_eds_pilote->dataset('Etat Validé','bar',$Arrayvalide);
        $bar_eds_pilote->dataset('Etat Terminé','bar',$Arraytermine);
        $bar_eds_pilote->dataset('Etat Tra ité en CAB','bar',$Arraytraite);
        //$bar_eds_pilote->loaderColor(['#8feb34', '#2e275c', '#5c3327','#758dc4','blue', 'grey', 'brown','yellow','#55135c']);
        $bar_eds_pilote->options([
            'plotOptions' => [
                'bar' => [
                    'dataLabels' => [
                        'enabled' => true,
                    ],
                ],
            ],
        ]);

        /*$bar_eds_pilote = Charts::multi('bar', 'c3')
        ->title('Evolution des Etats des OTs Par EDS Pilote')
        ->labels($initArrayEds)
        ->dataset('Etat Annulé',$Arrayannule)
        ->dataset('Etat Bilan realisé',$Arraybilan)
        ->dataset('Etat En cours',$Arrayencours)
        ->dataset('Etat Clos',$Arrayclos)
        ->dataset('Etat Initialisé',$ArrayInitia)
        ->dataset('Etat Préparé',$Arrayprepa)
        ->dataset('Etat Pris en charge',$Arraypris)
        ->dataset('Etat Validé',$Arrayvalide)
        ->dataset('Etat Terminé',$Arraytermine)
        ->dataset('Etat Traité en CAB',$Arraytraite)
        //->colors(['#8feb34', '#2e275c', '#5c3327','#758dc4','blue', 'grey', 'brown','yellow','#55135c'])
        ->dimensions(1500, 350)
        ->responsive(false);*/




        //$piejs = new SticketsChart;
        // $piejs->title('Operation par EDS Pilote OCM')
        // $piejs = Charts::create('line', 'highcharts')
        // ->labels($initStatus)
        // ->values($initValues)
        // ->title('Operation par EDS Pilote OCM')
        // ->labels($initStatus)
        // ->values($initValues)
    //    //->colors(['#ff0000', 'green', '#0000ff','orange','blue', 'cyan', 'brown'])
    //     //->dimensions(500, 300)
    //     ->responsive(false);

        return view('homesticket', compact('bar_eds_pilote','bar_operation','dataini','databilan','bar','dataprisnormalOCM','dataprisstandardOCM','datavalidestandardANO','datavalidestandardOCM','dataterminestandardOCM','dataterminestandardANO','dataprepastandardANO','dataprepastandardOCM','dataencoursnormalOCM','dataencoursstandardOCM'));
         
    }

    public function chartAjax(Request $request)
    {
        $week = $request->has('week') ? $request->week : date('W');
        $stickets = Sticket::select(\DB::raw("COUNT(*) as count"))
                    ->whereYear('created_at', $week)
                    ->groupBy(\DB::raw("Week(created_at)"))
                    ->pluck('count');
  
        $chart = new SticketsChart;
  
        $chart->dataset('New User Register Chart', 'line', $week)->options([
                    'fill' => 'true',
                    'borderColor' => '#51C1C0'
                ]);
  
        return $chart->api();
    }



    

   
}
