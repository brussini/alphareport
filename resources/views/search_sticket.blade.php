@extends('layouts.admin')
@section('title','Filter OT')
@section('content')

<div class="container">

    <h3 align="center"> Filtrer les OTs</h3>
 
    <div class="row">
        <div class="col-md-12">
        <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item"><a href="{{route('homesticket')}}"> <button type="button" class="btn btn-block btn-primary"><i class="nav-icon fas fa-chart-pie"></i>Return To Dashboard</button></a></li>
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
                    <label for="ticket type">Select Operation type</label>
                    <select name="filter_libell_operation_type" id="filter_libell_operation_type" class="form-control" required>
                        <option value="">Select Operation Type</option>
                        @foreach($operation_type as $operation)
                        <option value="{{ $operation->libell_operation_type }}">{{ $operation->libell_operation_type }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="Techni">Select Status</label>
                        <select name="filter_libell_state" id="filter_libell_state" class="form-control" required>
                            <option value="">Select Status</option>
                            @foreach($libell_state as $stat)
                            <option value="{{ $stat->libell_state }}">{{ $stat->libell_state }}</option>
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
              <h3 class="card-title">Donnees des OT</h3>
            </div>
            <div class="card-body">
<div class="table-responsive">
    <table id="operation_data" class="table table-bordered table-striped">
        <thead>
            <tr>
            <th>Operation Num</th>
                <th>Tech Demandeur</th>
                <th>Tech Interv</th>
                <th>Tech Pilote</th>
                <th>Tech Respo</th>
                <th>Tech Valid</th>
                <th>Tech CAB</th>
                <th>Creation Date</th>
                <th>Initialise Status Date</th>
                <th>Prepared Status Date</th>
                <th>Reali_Status_date</th>
                <th>Libelle_OP_type</th>
                <th>Libelle Service</th>
                <th>EDS Demand</th>
                <th>EDS Pilote</th>
                <th>EDS Interv</th>
                <th>Libelle Status</th>
                <th>Description</th>
                <th>EDS Control</th>
                <th>EDS Incharge</th>


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