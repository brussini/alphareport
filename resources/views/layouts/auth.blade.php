<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
@include('partials.header')

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <div>
                <h1><i class="fa fa-plus-circle"></i> {{config('app.name')}}</h1>
            </div>
        </div>

        @yield('content')

    </div>
    <!-- /.login-box -->
    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('dist/js/adminlte.min.js')}}">
        < /script
        </body>
        </html>