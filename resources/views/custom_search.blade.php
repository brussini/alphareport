@extends('layouts.admin')
@section('title','Filter')
@section('content')

<div class="container">

    <h3 align="center"> Recherche des tickets</h3>
 
    <div class="row">
        <div class="col-md-12">
        <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item"><a href="{{route('home')}}"> <button type="button" class="btn btn-block btn-primary"><i class="nav-icon fas fa-chart-pie"></i>Return To Dashboard O</button></a></li>
                    <li class="breadcrumb-item active"></li>
                </ol>
            </div><!-- /.col -->
        <div class="row input-daterange">
                <div class="col-md-4">
                <label>De</label> <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" readonly />
                </div>
                <div class="col-md-4">
                <label>A</label> <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" readonly />
                </div>
                </div>
            <div class="row">
                <div class="form-group">
                    <label for="ticket type">Select Ticket type</label>
                    <select name="filter_tickettype" id="filter_tickettype" class="form-control" required>
                        <option value="">Select Ticket type</option>
                        @foreach($tickettype as $tick)
                        <option value="{{ $tick->ticket_type }}">{{ $tick->ticket_type }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="Techni">Select Status</label>
                        <select name="filter_status" id="filter_status" class="form-control" required>
                            <option value="">Select Status</option>
                            @foreach($status as $stat)
                            <option value="{{ $stat->status }}">{{ $stat->status }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="Identifiant">Select Identifiant</label>
                        <select name="filter_pro_identifier" id="filter_pro_identifier" class="form-control" required>
                            <option value="">Select Identifiant</option>
                            @foreach($pro_identi as $identi)
                            <option value="{{ $identi->product_identifier_1 }}">{{ $identi->product_identifier_1 }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
               
               
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="Techni">Select Technician En Charge</label>
                        <select name="filter_technicienEnCharge" id="filter_technicienEnCharge" class="form-control" required>
                            <option value="">Select Technician En Charge</option>
                            @foreach($tech as $t)
                            <option value="{{ $t->technician_incharge }}">{{ $t->technician_incharge }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
            </div>
            <div class="form-group" align="center">
                <button type="button" name="filter" id="filter" class="btn btn-info">Filter</button>

                <button type="button" name="reset" id="reset" class="btn btn-default">Reset</button>
            </div>
        </div>
    </div>
    <div class="col-md-4"></div>
</div>
<br />
<div class="card">
            <div class="card-header">
              <h3 class="card-title">Donnees des Tickets</h3>
            </div>
            <div class="card-body">
<div class="table-responsive">
    <table id="ticket_data" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Num Ticket</th>
                <th>Status</th>
                <th>Priority</th>
                <th>Initiator EDS</th>
                <th>Description</th>
                <th>Problem detail</th>
                <th>Libelle Succ</th>
                <th>CreationDate</th>
                <th>Starting Date</th>
                <th>Recovery_date</th>
                <th>Last_repair_date</th>
                <th>Closure_date</th>
                <th>Initiator EDS</th>
                <th>Active_eds_name</th>
                <th>Ticket_type</th>
                <th>Ressource_identifier</th>
                <th>Identifient Produit</th>
                <th>Technicien Responsable</th>
                <th>Initiateur</th>
                <th>Last_actor</th>


            </tr>
        </thead>
    </table>
</div>
</div>
</div>
<br />
<br />
</div>


@endsection