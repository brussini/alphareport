<?php

namespace App\Http\Controllers;

use App\Sticket;
use App\Imports\SticketsImport;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Excel;





class ImportSticketController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $no = 1;
        $data = \App\Sticket::all();

        return view('import_sticket', compact('data'))->with(['no' => $no]);
        /*$technician = Oticket::where('id' ,'>' ,0)
        ->selectRaw('technician_incharge,  COUNT(*) as count')
        ->groupBy('technician_incharge')
        ->whereNotNull('technician_incharge')
        ->pluck('count', 'technician_incharge');
        dd($technician);*/
        /*$no = 1;
        $data = DB::table('otickets')->orderBy('ticket_num')
            ->get();
        return view('import_excel', compact('data'))->with(['no' => $no]);*/

        /* $otickets = DB::table('otickets')->select('*');
        return DataTables::of($otickets)
            ->make(true); */
    }

    public function store(Request $request)
    {
        if ($request->file('selected_file')) {
            $this->validate($request, [
                'selected_file'   => 'required|mimes:xls,xlsx'
            ]);

            $path = $request->file('selected_file')->getRealPath();
            $imp = new SticketsImport();
            $imp->onlySheets('liste de tickets');
            Excel::import($imp, $path);
            
            // if (!empty($data) && $data->count()) {
            //     foreach ($data->all() as $row) {
            //         if (!empty($row)) {
            //             $dataArray[] =
            //                 [
            //                     'operation_num'     => $row['n0_operation'],
            //                     'tech_demandeur_name'      => $row['nom_tech._dem.'],
            //                     'tech_interv_name' => $row['nom_tech._interv.'],
            //                     'tech_pilote_name' => $row['nom_tech._pilote'],
            //                     'tech_respo_name' => $row['nom_tech._resp.'],
            //                     'tech_valid_name' => $row['nom_tech._valid.'],
            //                     'tech_cab_name' => $row['nom_tech._cab'],
            //                     'creation_date' => $row['date_creation_utc'],
            //                     'init_state_date' => $row['date_etat_initialise_utc'],
            //                     'prepa_state_date' => $row['date_etat_prepare_utc'],
            //                     'reali_state_date' => $row['date_realisation_utc'],
            //                     'libell_operation_type' => $row['libelle_type_operations'],
            //                     'libell_service_imp' => $row['libelle_impact_service'],
            //                     'libell_product_imp' => $row['libelle_impact_produit'],
            //                     'eds_demand_name' => $row['nom_court_eds_demandeur'],
            //                     'libell_state' => $row['libelle_etat'],
            //                     'eds_pilote_name' => $row['nom_court_eds_pilote'],
            //                     'eds_interv_name' => $row['nom_court_eds_intervenant'],
            //                     'description'     => $row['description_operation'],
            //                     'start_date'      => $row['date_debut'],
            //                     'end_date'      => $row['date_fin'],
            //                     'comment' => $row['commentaire_le_plus_recent'],
            //                     'eds_controller_name' => $row['nom_court_eds_controleur'],
            //                     'eds_respo_name' => $row['nom_court_eds_responsable'],
            //                     'eds_validate_name' => $row['nom_court_eds_valideur'],
            //                     'incharge_status_date' => $row['date_etat_pris_en_charge_utc'],
            //                     'valid_status_date' => $row['date_etat_valide_utc'],
            //                     'end_status_date' => $row['date_etat_termine_utc'],
            //                     'bilan_real_date' => $row['date_etat_bilan_realise_utc'],
            //                     'close_status_date' => $row['date_etat_clos_utc'],
            //                     'on_going_status_date' => $row['date_etat_en_cours_utc'],
            //                     'cancel_status_date' => $row['date_etat_annule_utc']

            //                 ];
            //         }
                    

                    
            //     }
            //     //dd($dataArray);
            // //     foreach($dataArray as $value){ 
            // //     $dataArray = Sticket::updateOrcreate([
            // //         'operation_num' => $value['operation_num']  //if it exists update
            // //     ], [
            // //         'tech_demandeur_name'      => $value['tech_demandeur_name'],
            // //         'tech_interv_name' => $value['tech_interv_name'],
            // //         'tech_pilote_name' => $value['tech_pilote_name'],
            // //         'tech_respo_name' => $value['tech_respo_name'],
            // //         'tech_valid_name' => $value['tech_valid_name'],
            // //         'tech_cab_name' => $value['tech_cab_name'],
            // //         'creation_date' => $value['creation_date'],
            // //         'init_state_date' => $value['init_state_date'],
            // //         'prepa_state_date' => $value['prepa_state_date'],
            // //         'reali_state_date' => $value['reali_state_date'],
            // //         'libell_operation_type' => $value['libell_operation_type'],
            // //         'libell_service_imp' => $value['libell_service_imp'],
            // //         'libell_product_imp' => $value['libell_product_imp'],
            // //         'eds_demand_name' => $value['eds_demand_name'],
            // //         'libell_state' => $value['libell_state'],
            // //         'eds_pilote_name' => $value['eds_pilote_name'],
            // //         'eds_interv_name' => $value['eds_interv_name'],
            // //         'description'     => $value['description'],
            // //         'start_date'      => $value['start_date'],
            // //         'end_date'      => $value['end_date'],
            // //         'comment' => $value['comment'],
            // //         'eds_controller_name' => $value['eds_controller_name'],
            // //         'eds_respo_name' => $value['eds_respo_name'],
            // //         'eds_validate_name' => $value['eds_validate_name'],
            // //         'incharge_status_date' => $value['incharge_status_date'],
            // //         'valid_status_date' => $value['valid_status_date'],
            // //         'end_status_date' => $value['end_status_date'],
            // //         'bilan_real_date' => $value['bilan_real_date'],
            // //         'close_status_date' => $value['close_status_date'],
            // //         'on_going_status_date' => $value['on_going_status_date'],
            // //         'cancel_status_date' => $value['cancel_status_date']
            // //     ]);
            // // }
            // }
            
        }
        else {
            return back()->with('Error', 'Donnees Excel S non importe');
        }
    }
        
}




    /*public function oticketsList(){
        $otickets = DB::table('otickets')->select('*');
        return datatables()->of($otickets)
            ->make(true);

    }*/
