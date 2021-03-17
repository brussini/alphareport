@extends('layouts.admin')
@section('title','Donnees Tickets P2 en cours')
@section('content')

<!-- Main content -->
<div class="container-fluid">
    <!-- Info boxes -->
    <div class="row">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">@yield('title')</h3><span style="text-align:right"></span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @if(count($datap2encours) > 0)
                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Num Ticket</th>
                                <th>Status</th>
                                <th>priority</th>
                                <th>EDS Initiateur</th>
                                <th>Technicien en charge</th>
                                <th>Ticket type</th>
                                <th>EDS Actif</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($datap2encours as $row)
                            <tr>
                                <td>{{ $no++}}</td>
                                <td>{{ $row->ticket_num }}</td>
                                <td>{{ $row->status }}</td>
                                <td>{{ $row->priority }}</td>
                                <td>{{ $row->initiator_eds_name }}</td>
                                <td>{{ $row->technician_incharge }}</td>
                                <td>{{ $row->ticket_type }}</td>
                                <td>{{ $row->active_eds_name}}</td>
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