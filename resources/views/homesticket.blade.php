@extends('layouts.admin')
@section('title','Dashboard S')
@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">@yield('title')</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('search_sticket') }}"> <button type="button" class="btn btn-block btn-primary"><i class="fas fa-filter"></i>  Filtrer les OTs</button></a></li>
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
            <div class="info-box mb-3">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                <div class="info-box-content">
                    <a href="{{url('display/datavalideStandardOCM')}}"><span class="info-box-text">OT Validé TP Standard OCM</span></a>
                    <span class="info-box-number">{{ $datavalidestandardOCM }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-2 col-sm-2 col-md-2">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                <div class="info-box-content">
                    <a href="{{url('display/datatermineStandardANO')}}"><span class="info-box-text">OT Terminé TP Standard ANO</span></a>
                    <span class="info-box-number">{{ $dataterminestandardANO }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col --><div class="col-2 col-sm-2 col-md-2">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                <div class="info-box-content">
                    <a href="{{url('display/dataprepastandardANO')}}"><span class="info-box-text">OT Preparé TP Standard ANO</span></a>
                    <span class="info-box-number">{{ $dataprepastandardANO }}</span>
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
                    <a href="{{url('display/dataencoursnormalOCM')}}"><span class="info-box-text">OT En cours TP Normal OCM</span></a>
                    <span class="info-box-number">{{ $dataencoursnormalOCM }}</span>
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
                    <a href="{{url('display/dataprisnormalOCM')}}"><span class="info-box-text">OT Pris en charge TP Normal OCM</span></a>
                    <span class="info-box-number">{{ $dataprisnormalOCM }}</span>
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
                    <a href="{{url('display/dataprisstandardOCM')}}"><span class="info-box-text">OT Pris en charge TP Normal OCM</span></a>
                    <span class="info-box-number">{{ $dataprisstandardOCM }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
    
</div>
<div class="row">
<div class="col-2 col-sm-2 col-md-2">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                <div class="info-box-content">
                    <a href="{{url('display/datavalideStandardANO')}}"><span class="info-box-text">OT Validé TP Standard ANO</span></a>
                    <span class="info-box-number">{{ $datavalidestandardANO }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-2 col-sm-2 col-md-2">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                <div class="info-box-content">
                    <a href="{{url('display/datatermineStandardOCM')}}"><span class="info-box-text">OT Terminé TP Standard OCM</span></a>
                    <span class="info-box-number">{{ $dataterminestandardOCM }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div><div class="col-2 col-sm-2 col-md-2">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                <div class="info-box-content">
                    <a href="{{url('display/dataprepastandardOCM')}}"><span class="info-box-text">OT Preparé TP Standard OCM</span></a>
                    <span class="info-box-number">{{ $dataprepastandardOCM }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div><div class="col-2 col-sm-2 col-md-2">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                <div class="info-box-content">
                    <a href="{{url('display/dataencoursstandardOCM')}}"><span class="info-box-text">OT En cours TP Standard OCM</span></a>
                    <span class="info-box-number">{{ $dataencoursstandardOCM }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
</div>
</div>
<div class="row">
            <div class="col-12 col-sm-6 col-lg-8">
            {!! $bar->container() !!}
            </div> 
            <div class="col-6 col-lg-4">
            {!! $bar_operation->container() !!}
            </div>   
           
</div>  

</br>
</br>
<div class="row">
<div class="col-md-12">
                {!! $bar_eds_pilote->container() !!}
            </div>
</div>  



{!! $bar->script() !!}
{!! $bar_operation->script() !!}
{!! $bar_eds_pilote->script() !!}


@endsection