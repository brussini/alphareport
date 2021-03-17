<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sticket;
use DB;

class ShowSticketController extends Controller
{
    
    public function getdataValideStandardOCM()
    {
        $no = 1;
        $datavalidestandardOCM = DB::table('stickets')->where('libell_state', '=', 'Validé')->where('libell_operation_type','=','TP standard OCM')->get();


        return view('displayS.getdataValideStandardOCM', compact('datavalidestandardOCM'))->with(['no' => $no]);
    }
    public function getdataValideStandardANO()
    {
        $no = 1;
        $datavalidestandardANO = DB::table('stickets')->where('libell_state', '=', 'Validé')->where('libell_operation_type','=','TP standard ANO')->get();


        return view('displayS.getdataValideStandardANO', compact('datavalidestandardANO'))->with(['no' => $no]);
    }
    public function getdataTermineStandardOCM()
    {
        $no = 1;
        $dataterminestandardOCM = DB::table('stickets')->where('libell_state', '=', 'Terminé')->where('libell_operation_type','=','TP standard OCM')->get();


        return view('displayS.getdataTermineStandardOCM', compact('dataterminestandardOCM'))->with(['no' => $no]);
    }

    public function getdataTermineStandardANO()
    {
        $no = 1;
        $dataterminestandardANO = DB::table('stickets')->where('libell_state', '=', 'Terminé')->where('libell_operation_type','=','TP standard ANO')->get();


        return view('displayS.getdataTermineStandardANO', compact('dataterminestandardANO'))->with(['no' => $no]);
    }

    public function getdatabilan()
    {
        $no = 1;
        $databilan = DB::table('stickets')->where('libell_state', '=', 'Bilan réalisé')->get();


        return view('displayS.getdatabilan', compact('databilan'))->with(['no' => $no]);
    }

    public function getdataInitialise()
    {
        $no = 1;
        $datainitialise = DB::table('stickets')->where('libell_state', '=', 'Initialisé')->get();


        return view('displayS.getdataInitialise', compact('datainitialise'))->with(['no' => $no]);
    }

    public function getdataPrepareStandardANO()
    {
        $no = 1;
        $dataprepastandardANO = DB::table('stickets')->where('libell_state', '=', 'Préparé')->where('libell_operation_type','=','TP standard ANO')->get();


        return view('displayS.getdataPrepareStandardANO', compact('dataprepastandardANO'))->with(['no' => $no]);
    }

    public function getdataPrepareStandardOCM()
    {
        $no = 1;
        $dataprepastandardOCM = DB::table('stickets')->where('libell_state', '=', 'Préparé')->where('libell_operation_type','=','TP standard OCM')->get();


        return view('displayS.getdataPrepareStandardOCM', compact('dataprepastandardOCM'))->with(['no' => $no]);
    }

    public function getdataEncoursNormalOCM()
    {
        $no = 1;
        $dataencoursnormalOCM = DB::table('stickets')->where('libell_state', '=', 'En cours')->where('libell_operation_type','=','TP normal OCM')->get();


        return view('displayS.getdataEncoursNormalOCM', compact('dataencoursnormalOCM'))->with(['no' => $no]);
    }

    public function getdataPrisNormalOCM()
    {
        $no = 1;
        $dataprisnormalOCM = DB::table('stickets')->where('libell_state', '=', 'Pris en charge')->where('libell_operation_type','=','TP normal OCM')->get();


        return view('displayS.getdataPrisNormalOCM', compact('dataprisnormalOCM'))->with(['no' => $no]);
    }

    public function getdataPrisStandardOCM()
    {
        $no = 1;
        $dataprisstandardOCM = DB::table('stickets')->where('libell_state', '=', 'Pris en charge')->where('libell_operation_type','=','TP standard OCM')->get();


        return view('displayS.getdataPrisStandardOCM', compact('dataprisstandardOCM'))->with(['no' => $no]);
    }

    public function getdataEncoursStandardOCM()
    {
        $no = 1;
        $dataencoursstandardOCM = DB::table('stickets')->where('libell_state', '=', 'En cours')->where('libell_operation_type','=','TP standard OCM')->get();


        return view('displayS.getdataEncoursStandardOCM', compact('dataencoursstandardOCM'))->with(['no' => $no]);
    }






    // public function getdataEncours()
    // {
    //     $no = 1;
    //     $dataencours = DB::table('stickets')->where('libell_state', '=', 'En cours')->get();


    //     return view('displayS.getdataEncours', compact('dataencours'))->with(['no' => $no]);
    // }



}
