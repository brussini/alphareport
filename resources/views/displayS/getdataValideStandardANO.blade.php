@extends('layouts.admin')
@section('title','Donnees OT Validés TP Standard ANO')
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
                    @if(count($datavalidestandardANO) > 0)
                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
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
                <th>Prepare Status Date</th>
                <th>Reali_Status_date</th>
                <th>Libelle_OP_type</th>
                <th>Libelle Service</th>
                <th>Libelle Product</th>
                <th>EDS Demand</th>
                <th>Libelle Status</th>
                <th>EDS Pilote</th>
                <th>Description</th>
                <th>Start date</th>
                <th>End Date</th>
                <th>Valid Status Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($datavalidestandardANO as $row)
                            <tr>
                                
                                <td>{{ $row->operation_num }}</td>
                                <td>{{ $row->tech_demandeur_name }}</td>
                                <td>{{ $row->tech_interv_name }}</td>
                                <td>{{ $row->tech_pilote_name }}</td>
                                <td>{{ $row->tech_respo_name }}</td>
                                <td>{{ $row->tech_valid_name }}</td>
                                <td>{{ $row->tech_cab_name}}</td>
                                <td>{{ $row->creation_date }}</td>
                                <td>{{ $row->prepa_state_date }}</td>
                                <td>{{ $row->reali_state_date }}</td>
                                <td>{{ $row->libell_operation_type }}</td>
                                <td>{{ $row->libell_service_imp }}</td>
                                <td>{{ $row->libell_product_imp }}</td>
                                <td>{{ $row->eds_demand_name}}</td>
                                <td>{{ $row->libell_state }}</td>
                                <td>{{ $row->eds_pilote_name }}</td>
                                <td>{{ $row->description }}</td>
                                <td>{{ $row->start_date }}</td>
                                <td>{{ $row->end_date }}</td>
                                <td>{{ $row->valid_status_date }}</td>
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