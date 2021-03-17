@extends('layouts.admin')
@section('title','Donnees Tickets Plainte client P1 En cours')
@section('content')

<!-- Main content -->
<div class="container-fluid">
    <!-- Info boxes -->
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@yield('title')</h3><span style="text-align:right"></span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @if(count($datap1encoursPlainte) > 0)
                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                <th>Num Ticket</th>
                <th>Status</th>
                <th>Priority</th>
                <th>Ticket_type</th>
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
                <th>Technicien Responsable</th>
                <th>Last_actor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($datap1encoursPlainte as $row)
                            <tr>
                                
                                <td>{{ $row->ticket_num }}</td>
                                <td>{{ $row->status }}</td>
                                <td>{{ $row->priority }}</td>
                                <td>{{ $row->ticket_type }}</td>
                                <td>{{ $row->initiator_eds_name }}</td>
                                <td>{{ $row->description }}</td>
                                <td>{{ $row->problem_detail }}</td>
                                <td>{{ $row->libelle_succ}}</td>
                                <td>{{ $row->creation_date }}</td>
                                <td>{{ $row->starting_date }}</td>
                                <td>{{ $row->recovery_date }}</td>
                                <td>{{ $row->last_repair_date }}</td>
                                <td>{{ $row->closure_date }}</td>
                                <td>{{ $row->initiator_eds_names }}</td>
                                <td>{{ $row->active_eds_name}}</td>
                                <td>{{ $row->technician_incharge }}</td>
                                <td>{{ $row->last_actor }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif

                </div>
                <!-- /.row -->
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>

<!--/. container-fluid -->
@endsection

