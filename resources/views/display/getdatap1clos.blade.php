@extends('layouts.admin')
@section('title','Donnees Tickets P1 Clos')
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
                    @if(count($datap1clos) > 0)
                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Num Ticket</th>
                                <th>Priorite</th>
                                <th>Description</th>
                                <th>CreationDate</th>
                                <th>InitiatorGroupname</th>
                                <th>TicketType</th>
                                <th>Ressource Iden</th>
                                <th>Initiateur</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($datap1clos as $row)
                            <tr>
                                <td>{{ $no++}}</td>
                                <td>{{ $row->ticket_num }}</td>
                                <td>{{ $row->priority }}</td>
                                <td>{{ $row->description }}</td>
                                <td>{{ $row->creation_date }}</td>
                                <td>{{ $row->initiator_groupname }}</td>
                                <td>{{ $row->ticket_type }}</td>
                                <td>{{ $row->ressource_identifier }}</td>
                                <td>{{ $row->initiator_name}}</td>
                                <td>{{ $row->status }}</td>
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

