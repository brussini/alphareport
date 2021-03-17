<?php

namespace App\Http\Controllers;

use App\Oticket;
use App\Imports\OticketsImport;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Excel;
//use Alert;





class ImportExcelController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $no = 1;
        $data = \App\Oticket::all();

        return view('import_excel', compact('data'))->with(['no' => $no]);
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
        if ($request->file('select_file')) {
            $this->validate($request, [
                'select_file'   => 'required|mimes:xls,xlsx'
            ]);

            $path = $request->file('select_file')->getRealPath();
            $import = new OticketsImport();
            $import->onlySheets('Liste de tickets');
            Excel::import($import, $path);
            //$data = Excel::selectSheetsByIndex(1)->load($path, function ($reader) { })->get();
            //dd($data);
            return back()->with('success', 'Données Excel O Importé avec succès.');

            // $path = $request->file('select_file')->getRealPath();
            // $data = Excel::selectSheetsByIndex(4)->load($path, function ($reader) { })->get();
            //dd($data);
            // if (!empty($data) && $data->count()) {
            //     foreach ($data->all() as $row) {
            //         if (!empty($row)) {
            //             $dataArray[] =
            //                 [
            //                     'ticket_num'     => $row['n0_ticket'],
            //                     'status'      => $row['etat'],
            //                     'priority' => $row['priorite_traitement'],
            //                     'initiator_eds_name' => $row['nom_court_eds_initiateur'],
            //                     'description' => $row['description'],
            //                     'problem_detail' => $row['detail_probleme'],
            //                     'libelle_succ' => $row['libelle_succinct'],
            //                     'creation_date' => $row['date_creation_ticket'],
            //                     'starting_date' => $row['date_debut_ticket'],
            //                     'recovery_date' => $row['date_retablissement_ticket'],
            //                     'last_repair_date' => $row['derniere_date_reparation'],
            //                     'closure_date' => $row['date_cloture_ticket'],
            //                     'initiator_eds_names' => $row['nom_court_eds_initiateur'],
            //                     'active_eds_name' => $row['nom_court_eds_active'],
            //                     'ticket_type' => $row['type_ticket'],
            //                     'ressource_identifier' => $row['123_identifiant_ressource'],
            //                     'product_identifier_1' => $row['identifiant_1_produit'],
            //                     'product_identifier_2' => $row['identifiant_2_produit'],
            //                     'recent_comment'     => $row['commentaire_le_plus_recent'],
            //                     'technician_incharge'      => $row['technicien_responsable'],
            //                     'initiator_name' => $row['initiateur_nom_utilisateur'],
            //                     'activation' => $row['activations.nom_utilisateur_prise_en_charge'],
            //                     'product_type' => $row['type_produit'],
            //                     'product_identifier_3' => $row['identifiant_3_produit'],
            //                     'product_identifier_4' => $row['identifiant_4_produit'],
            //                     'criticity' => $row['criticite'],
            //                     'ressource_type' => $row['type_ressource'],
            //                     'ressource_domain' => $row['domaine_ressource'],
            //                     'ressource_category' => $row['categorie_ressource'],
            //                     'product_class' => $row['classe_produit'],
            //                     'last_actor' => $row['dernier_acteur']
            //                 ];
            //         }
                    

                    
            //     }
            //     //dd($dataArray);
            //     foreach($dataArray as $value){ 
            //     $dataArray = Oticket::updateOrcreate([
            //         'ticket_num' => $value['ticket_num']  //if it exists update
            //     ], [
            //         'status'      => $value['status'],
            //         'priority' => $value['priority'],
            //         'initiator_eds_name' => $value['initiator_eds_name'],
            //         'description' => $value['description'],
            //         'problem_detail' => $value['problem_detail'],
            //         'libelle_succ' => $value['libelle_succ'],
            //         'creation_date' => $value['creation_date'],
            //         'starting_date' => $value['starting_date'],
            //         'recovery_date' => $value['recovery_date'],
            //         'last_repair_date' => $value['last_repair_date'],
            //         'closure_date' => $value['closure_date'],
            //         'initiator_eds_names' => $value['initiator_eds_names'],
            //         'active_eds_name' => $value['active_eds_name'],
            //         'ticket_type' => $value['ticket_type'],
            //         'ressource_identifier' => $value['ressource_identifier'],
            //         'product_identifier_1' => $value['product_identifier_1'],
            //         'product_identifier_2' => $value['product_identifier_2'],
            //         'recent_comment'     => $value['recent_comment'],
            //         'technician_incharge'      => $value['technician_incharge'],
            //         'initiator_name' => $value['initiator_name'],
            //         'activation' => $value['activation'],
            //         'product_type' => $value['product_type'],
            //         'product_identifier_3' => $value['product_identifier_3'],
            //         'product_identifier_4' => $value['product_identifier_4'],
            //         'criticity' => $value['criticity'],
            //         'ressource_type' => $value['ressource_type'],
            //         'ressource_domain' => $value['ressource_domain'],
            //         'ressource_category' => $value['ressource_category'],
            //         'product_class' => $value['product_class'],
            //         'last_actor' => $value['last_actor']
            //     ]);
            // }
            // }
            
            return back()->with('success', 'Données Excel Importé avec succès.');
        }
        else {
            return back()->with('Error', 'Donnees Excel non importe');
        }
    }
    public function count($data){
        $data = DB::table('otickets')->count();

    }

}

    /*public function oticketsList(){
        $otickets = DB::table('otickets')->select('*');
        return datatables()->of($otickets)
            ->make(true);

    }*/
