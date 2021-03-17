@extends('layouts.admin')
@section('title','Dashboard O')
@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">@yield('title')</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('customsearch') }}"> <button type="button" class="btn btn-block btn-primary"><i class="fas fa-filter"></i>  Filtrer </button></a></li>
                    <li class="breadcrumb-item active"></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="container-fluid">
    <!-- Info boxes -->
    <div class="row">
        <div class="col-2 col-sm-2 col-md-2">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Tickets</span>
                    <span class="info-box-number">
                        {{ $data }}
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-2 col-sm-2 col-md-2">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                <div class="info-box-content">
                    <a href="{{url('display/datap1encoursPlainte')}}"><span class="info-box-text">Tickets Plainte </br> client P1 En cours</span></a>
                    <span class="info-box-number">{{ $datap1encoursPlainte }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>

        <div class="col-2 col-sm-2 col-md-2">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-cog"></i></span>

                <div class="info-box-content">
                    <a href="{{url('display/datap2encoursPlainte')}}" <span class="info-box-text">Tickets Plainte </br> client P2 En cours</span></a>
                    <span class="info-box-number">{{ $datap2encoursPlainte }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-2 col-sm-2 col-md-2">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-cog"></i></span>

                <div class="info-box-content">
                    <a href="{{url('display/datap3encoursPlainte')}}"> <span class="info-box-text">Tickets Plainte </br> client P3 En cours</span></a>
                    <span class="info-box-number">{{ $datap3encoursPlainte }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-2 col-sm-2 col-md-2">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-cog"></i></span>

                <div class="info-box-content">
                    <a href="{{url('display/datap4encoursPlainte')}}"> <span class="info-box-text">Tickets Plainte </br> client P4 En cours</span></a>
                    <span class="info-box-number">{{ $datap4encoursPlainte }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-2 col-sm-2 col-md-2">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-cog"></i></span>

                <div class="info-box-content">
                    <a href="{{url('display/dataclosprtableau')}}"><span class="info-box-text">Tickets Clos </br> pour Tableau de Bord </span></a>
                    <span class="info-box-number">{{ $dataclosprtableau }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-2 col-sm-2 col-md-2">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-cog"></i></span>

                <div class="info-box-content">
                    <a href="{{url('display/datap1encoursInci')}}"><span class="info-box-text">Tickets Incident </br>P1 En cours</span></a>
                    <span class="info-box-number">{{ $datap1encoursInci }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-2 col-sm-2 col-md-2">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                <div class="info-box-content">
                    <a href="{{url('display/datap2encoursInci')}}"><span class="info-box-text">Tickets Incident </br>P2 En cours</span></a>
                    <span class="info-box-number">{{ $datap2encoursInci }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-2 col-sm-2 col-md-2">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-cog"></i></span>

                <div class="info-box-content">
                    <a href="{{url('display/datap3encoursInci')}}"><span class="info-box-text">Tickets Incident </br>P3 En cours </span></a>
                    <span class="info-box-number">{{ $datap3encoursInci }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-2 col-sm-2 col-md-2">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                <div class="info-box-content">
                    <a href="{{url('display/datap4encoursInci')}}"><span class="info-box-text">Tickets Incident </br> P4 En cours </span></a>
                    <span class="info-box-number">{{ $datap4encoursInci }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-2 col-sm-2 col-md-2">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-cog"></i></span>

                <div class="info-box-content">
                    <a href="{{url('display/dataAvisdeprob')}}"><span class="info-box-text">Tickets de type:</br> Avis de problème En cours</span></a>
                    <span class="info-box-number">{{ $dataavispro }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-2 col-sm-2 col-md-2">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-cog"></i></span>

                <div class="info-box-content">
                    <a href="{{url('display/dataAvisdeprob')}}"><span class="info-box-text">Tickets de type:</br> Avis de problème En cours</span></a>
                    <span class="info-box-number">{{ $dataavispro }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
            <div class="col-md-8">
                {!! $chart->container() !!}
            </div>
            <div class="col-md-4">
                {!! $piejs->container() !!}
            </div>
        <div class="col-md-6">
            {!! $barP->container() !!}
        </div>
        <div class="col-md-6">
            {!! $barI->container() !!}
        </div>
    </div>

</div>
<!-- /.row -->
</div>
<!--/. container-fluid -->

{!! $chart->script() !!}
{!! $piejs->script() !!}
{!! $barP->script() !!}
{!! $barI->script() !!}
@endsection