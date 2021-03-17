<?php

namespace App\Http\Controllers;

use App\Oticket;
use Illuminate\Support\Facades\DB;

class DisplayTicketsController extends Controller
{
    public function index()
    {
        $no = 1;
        $otickets = Oticket::all();
        $datap1encoursPlainte = DB::table('otickets')->where('priority', '=', 'P1')->where('status', '=', 'En cours')->where('ticket_type', '=', 'Plainte client')->get();
        $datap1encoursInci = DB::table('otickets')->where('priority', '=', 'P1')->where('status', '=', 'En cours')->where('ticket_type', '=', 'Incident')->get();
        $datap2encoursPlainte = DB::table('otickets')->where('priority', '=', 'P2')->where('status', '=', 'En cours')->where('ticket_type', '=', 'Plainte client')->get();
        $datap2encoursInci = DB::table('otickets')->where('priority', '=', 'P2')->where('status', '=', 'En cours')->where('ticket_type', '=', 'Incident')->get();
        $datap3encoursPlainte = DB::table('otickets')->where('priority', '=', 'P3')->where('status', '=', 'En cours')->where('ticket_type', '=', 'Plainte client')->get();
        $datap3encoursInci = DB::table('otickets')->where('priority', '=', 'P3')->where('status', '=', 'En cours')->where('ticket_type', '=', 'Incident')->get();
        $datap4encoursPlainte = DB::table('otickets')->where('priority', '=', 'P4')->where('status', '=', 'En cours')->where('ticket_type', '=', 'Plainte client')->get();
        $datap4encoursInci = DB::table('otickets')->where('priority', '=', 'P4')->where('status', '=', 'En cours')->where('ticket_type', '=', 'Incident')->get();
        $dataavispro = DB::table('otickets')->where('ticket_type', '=', 'Avis de problème')->get();


        return view('display', compact('datap1encours', 'datap1clos', 'datap2encours', 'datap2clos', 'datap3', 'datap4'))->with(['no' => $no]);
    }

    public function getdatap1encoursPlainte()
    {
        $no = 1;
        $datap1encoursPlainte = DB::table('otickets')->where('priority', '=', 'P1')->where('status', '=', 'En cours')->where('ticket_type', '=', 'Plainte client')->get();

        return view('display.getdatap1encoursPlainte', compact('datap1encoursPlainte'))->with(['no' => $no]);
    }
    public function getdatap1encoursInci()
    {
        $no = 1;
        $datap1encoursInci = DB::table('otickets')->where('priority', '=', 'P1')->where('status', '=', 'En cours')->where('ticket_type', '=', 'Incident')->get();

        return view('display.getdatap1encoursInci', compact('datap1encoursInci'))->with(['no' => $no]);
    }

    public function getdatap2encoursPlainte()
    {
        $no = 1;
        $datap2encoursPlainte = DB::table('otickets')->where('priority', '=', 'P2')->where('status', '=', 'En cours')->where('ticket_type', '=', 'Plainte client')->get();

        return view('display.getdatap2encoursPlainte', compact('datap2encoursPlainte'))->with(['no' => $no]);
    }
    public function getdatap2encoursInci()
    {
        $no = 1;
        $datap2encoursInci = DB::table('otickets')->where('priority', '=', 'P2')->where('status', '=', 'En cours')->where('ticket_type', '=', 'Incident')->get();


        return view('display.getdatap2encoursInci', compact('datap2encoursInci'))->with(['no' => $no]);
    }

    public function getdatap3encoursPlainte()
    {
        $no = 1;
        $datap3encoursPlainte = DB::table('otickets')->where('priority', '=', 'P3')->where('status', '=', 'En cours')->where('ticket_type', '=', 'Plainte client')->get();


        return view('display.getdatap3encoursPlainte', compact('datap3encoursPlainte'))->with(['no' => $no]);
    }
    public function getdatap3encoursInci()
    {
        $no = 1;
        $datap3encoursInci = DB::table('otickets')->where('priority', '=', 'P3')->where('status', '=', 'En cours')->where('ticket_type', '=', 'Incident')->get();


        return view('display.getdatap3encoursInci', compact('datap3encoursInci'))->with(['no' => $no]);
    }

    public function getdatap4encoursPlainte()
    {
        $no = 1;
        $datap4encoursPlainte = DB::table('otickets')->where('priority', '=', 'P4')->where('status', '=', 'En cours')->where('ticket_type', '=', 'Plainte client')->get();


        return view('display.getdatap4encoursPlainte', compact('datap4encoursPlainte'))->with(['no' => $no]);
    }
    public function getdatap4encoursInci()
    {
        $no = 1;
        $datap4encoursInci = DB::table('otickets')->where('priority', '=', 'P4')->where('status', '=', 'En cours')->where('ticket_type', '=', 'Incident')->get();


        return view('display.getdatap4encoursInci', compact('datap4encoursInci'))->with(['no' => $no]);
    }

    

    public function getdataclosprtableau()
    {
        $no = 1;
        $dataclosprtableau = DB::table('otickets')->where('status', '=', 'Clos pour tableaux de bord')->get();

        return view('display.getdataclosprtableau', compact('dataclosprtableau'))->with(['no' => $no]);
    }
    public function getdatapAvisdeProb()
    {
        $no = 1;
        $dataavispro = DB::table('otickets')->where('ticket_type', '=', 'Avis de problème')->where('status', '=', 'En cours')->get();

        return view('display.getdatapAvisdeProb', compact('dataavispro'))->with(['no' => $no]);
    }
}
