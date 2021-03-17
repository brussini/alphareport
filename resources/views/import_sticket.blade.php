@extends('layouts.admin')
@section('title','Import S')
@section('content')
    <h3 align="center">Importer un Fichier Excel S</h3>
    <br />
    @if(count($errors) > 0)
    <div class="alert alert-danger">
        Upload Validation Error<br><br>
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
    @endif
    <form method="post" enctype="multipart/form-data" action="{{ url('/import_sticket/import') }}">
        {{ csrf_field() }}
        <div class="form-group">
            <table class="table">
                <tr>
                    <td width="40%" align="right"><label>Selectionner un fichier à Importer</label></td>
                    <td width="30">
                        <input type="file" name="selected_file" class="btn btn-secondary" />
                    </td>
                    <td width="30%" align="left">
                        <input type="submit" name="upload" class="btn btn-primary" value="Upload" required>
                    </td>
                </tr>
                <tr>
                    <td width="40%" align="right"></td>
                    <td width="30"><span class="text-muted">.xls, .xslx</span></td>
                    <td width="30%" align="left"></td>
                </tr>
            </table>
        </div>
    </form>

    <br />
    @foreach ($data as $row)
    <div class="modal fade" id="exampleModalCenter{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle" style="color:black">Infos sur le ticket: Operation N°:{{$row->operation_num}} </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">Date de création:{{$row->creation_date}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">Tech Demandeur:{{$row->initiator_eds_name}}</div>
                            <div class="col-md-6">Type de Ticket:{{$row->libell_operation_type}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">EDS Responsable: {{$row->eds_respo_name}}</div>
                            <div class="col-md-6">Statut: {{$row->libell_state}}</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Données des tickets</h3></br>
            <span style="text-align:right">Nombre Total de Ticket :{{ count($data)}}</span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if (count($data) > 0)
                <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Operation Num</th>
                            <th>Tech Dem</th>
                            <th>Tech Interv</th>
                            <th>Creation Date</th>
                            <th>Init State Date</th>
                            <th>Libelle Op Type</th>
                            <th>Libelle Etat</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Description</th>
                            <th>EDS Respo</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $row)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{ $row->operation_num }}</td>
                            <td>{{ $row->tech_demandeur_name }}</td>
                            <td>{{ $row->tech_interv_name }}</td>
                            <td>{{ $row->creation_date }}</td>
                            <td>{{ $row->init_state_date }}</td>
                            <td>{{ $row->libell_operation_type }}</td>
                            <td>{{ $row->libell_state }}</td>
                            <td>{{ $row->start_date}}</td>
                            <td>{{ $row->end_date }}</td>
                            <td>{{ $row->description }}</td>
                            <td>{{ $row->eds_respo_name }}</td>
                            <td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter{{$row->id}}">View</button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div>


@endsection
