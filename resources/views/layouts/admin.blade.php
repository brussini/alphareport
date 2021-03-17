@include('partials.header')

<body class="hold-transition sidebar-mini layout-fixed layout-footer-fixed sidebar-collapse">
  @include('partials.sidenav')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @yield('content')
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <!-- /.control-sidebar -->

  <footer class="main-footer">
    @include('partials.footer')
  </footer>
</body>
<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.6/highcharts.js" charset="utf-8"></script>
<!-- <script src="https://code.highcharts.com/highcharts.src.js"></script> --> 
<!-- DataTables -->
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.flash.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>



<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.js')}}"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="{{ asset('dist/js/demo.js')}}"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{ asset('plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
<script src="{{ asset('plugins/raphael/raphael.min.js')}}"></script>
<script src="{{ asset('plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>

<!-- PAGE SCRIPTS -->
<!--<script src="{{ asset('dist/js/pages/dashboard2.js') }}"></script>-->
<!-- page script -->
<script>
  $(document).ready(function() {
    $('.input-daterange').datepicker({
  todayBtn:'linked',
  format:'yyyy-mm-dd',
  autoclose:true
 });
 

    fill_datatable();


    function fill_datatable(from_date = '', to_date = '', filter_tickettype = '', filter_status = '',filter_pro_identifier = '', filter_technicienEnCharge = '') {
      var dataTable = $('#ticket_data').DataTable({
        dom: 'Bfrtip',
        'info': true,
        /*buttons: [
          'copy', 'csv', 'excel', 'pdf', 'print'
        ],*/
        buttons: [{
          extend: 'excel',
          text: '<span class="fa fa-file-excel-o"></span> Excel Export',
          exportOptions: {
            modifier: {
              search: 'applied',
              order: 'applied',
              page : 'all'
            }
          }
        }],
        processing: true,
        serverSide: false,
        pageLength: 10,
        //destroy: true,
        ajax: {
          url: "{{ route('customsearch.index') }}",
          data: {
            from_date: from_date,
            to_date: to_date,
            filter_tickettype: filter_tickettype,
            filter_status: filter_status,
            filter_pro_identifier: filter_pro_identifier,
            filter_technicienEnCharge: filter_technicienEnCharge

           
          }
        },
        columns: [{
            data: 'ticket_num',
            name: 'ticket_num'
          },
          {
            data: 'status',
            name: 'status'
          },
          {
            data: 'priority',
            name: 'priority'
          },
          {
            data: 'initiator_eds_name',
            name: 'initiator_eds_name'
          },
          {
            data: 'description',
            name: 'description'
          },
          {
            data: 'problem_detail',
            name: 'problem_detail'
          },
          {
            data: 'libelle_succ',
            name: 'libelle_succ'
          },
          {
            data: 'creation_date',
            name: 'creation_date'
          },
          {
            data: 'starting_date',
            name: 'starting_date'
          },
          {
            data: 'recovery_date',
            name: 'recovery_date'
          },

          {
            data: 'last_repair_date',
            name: 'last_repair_date'
          },
          {
            data: 'closure_date',
            name: 'closure_date'
          },
          {
            data: 'initiator_eds_names',
            name: 'initiator_eds_names'
          },
          {
            data: 'active_eds_name',
            name: 'active_eds_name'
          },
          {
            data: 'ticket_type',
            name: 'ticket_type'
          },
          {
            data: 'ressource_identifier',
            name: 'ressource_identifier'
          },
          {
            data: 'product_identifier_1',
            name: 'product_identifier_1'
          },
          {
            data: 'technician_incharge',
            name: 'technician_incharge'
          },
          {
            data: 'initiator_name',
            name: 'initiator_name'
          },
          {
            data: 'last_actor',
            name: 'last_actor'
          }

        ]
      });
    }
    // Filter button action
    $('#filter').click(function() {
      var from_date = $('#from_date').val();
      var to_date = $('#to_date').val();
      var filter_tickettype = $('#filter_tickettype').val();
      var filter_status = $('#filter_status').val();
      var filter_pro_identifier = $('#filter_pro_identifier').val();
      var filter_technicienEnCharge = $('#filter_technicienEnCharge').val();
      //console.log(from_date + to_date + filter_tickettype + filter_status + filter_pro_identifier + filter_technicienEnCharge  );

      if (from_date != '' && to_date != '' &&  filter_tickettype != '' &&  filter_status != '' || filter_pro_identifier !='' || filter_technicienEnCharge != '') {
        $('#ticket_data').DataTable().destroy();
        fill_datatable(from_date, to_date, filter_tickettype, filter_status, filter_pro_identifier, filter_technicienEnCharge);

      } else {
        alert('Selectionner les champs Date,Type de tickets,status, Identifiant Produit 1 et/ou Technicien en charge');
      }
    });

    $('#reset').click(function() {
      $('#from_date').val('');
      $('#to_date').val('');
      $('#filter_tickettype').val('');
      $('#filter_status').val('');
      $('#filter_pro_identifier').val('');
      $('#filter_technicienEnCharge').val('');
      $('#ticket_data').DataTable().destroy();
      fill_datatable();
    });

  });
</script>
<script>
  $(function() {
    $("#datatable").DataTable({
      dom: 'Bfrtip',
      'info': true,
      buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
      ],
      processing: true,

    });

  });
</script>
<script>
  $(document).ready(function() {
    $('.input-daterange').datepicker({
  todayBtn:'linked',
  format:'yyyy-mm-dd',
  autoclose:true
 });
 

    fill_datatable();


    function fill_datatable(from_date = '', to_date = '', filter_libell_operation_type = '', filter_libell_state = '') {
      var dataTable = $('#operation_data').DataTable({
        dom: 'Bfrtip',
        'info': true,
        /*buttons: [
          'copy', 'csv', 'excel', 'pdf', 'print'
        ],*/
        buttons: [{
          extend: 'excel',
          text: '<span class="fa fa-file-excel-o"></span> Excel Export',
          exportOptions: {
            modifier: {
              search: 'applied',
              order: 'applied',
              page : 'all'
            }
          }
        }],
        processing: true,
        serverSide: false,
        pageLength: 10,
        //destroy: true,
        ajax: {
          url: "{{ route('search_sticket.index') }}",
          data: {
            from_date: from_date,
            to_date: to_date,
            filter_libell_operation_type: filter_libell_operation_type,
            filter_libell_state: filter_libell_state,

           
          }
        },
        columns: [{
            data: 'operation_num',
            name: 'operation_num'
          },
          {
            data: 'tech_demandeur_name',
            name: 'tech_demandeur_name'
          },
          {
            data: 'tech_interv_name',
            name: 'tech_interv_name'
          },
          {
            data: 'tech_pilote_name',
            name: 'tech_pilote_name'
          },
          {
            data: 'tech_respo_name',
            name: 'tech_respo_name'
          },
          {
            data: 'tech_valid_name',
            name: 'tech_valid_name'
          },
          {
            data: 'tech_cab_name',
            name: 'tech_cab_name'
          },
          {
            data: 'creation_date',
            name: 'creation_date'
          },
          {
            data: 'init_state_date',
            name: 'init_state_date'
          },
          {
            data: 'prepa_state_date',
            name: 'prepa_state_date'
          },

          {
            data: 'reali_state_date',
            name: 'reali_state_date'
          },
          {
            data: 'libell_operation_type',
            name: 'libell_operation_type'
          },
          {
            data: 'libell_service_imp',
            name: 'libell_service_imp'
          },
          {
            data: 'eds_demand_name',
            name: 'eds_demand_name'
          },
          {
            data: 'eds_pilote_name',
            name: 'eds_pilote_name'
          },
          {
            data: 'eds_interv_name',
            name: 'eds_interv_name'
          },
          {
            data: 'libell_state',
            name: 'libell_state'
          },
          {
            data: 'description',
            name: 'description'
          },
          {
            data: 'eds_controller_name',
            name: 'eds_controller_name'
          },
          {
            data: 'eds_respo_name',
            name: 'eds_respo_name'
          }

        ]
      });
    }
    // Filter button action
    $('#filter').click(function() {
      var from_date = $('#from_date').val();
      var to_date = $('#to_date').val();
      var filter_libell_operation_type = $('#filter_libell_operation_type').val();
      var filter_libell_state = $('#filter_libell_state').val();
      //console.log(from_date + to_date + filter_tickettype + filter_status + filter_pro_identifier + filter_technicienEnCharge  );

      if (from_date != '' && to_date != '' &&  filter_libell_operation_type != '' &&  filter_libell_state != '' ) {
        $('#operation_data').DataTable().destroy();
        fill_datatable(from_date, to_date, filter_libell_operation_type, filter_libell_state );
              } else {
        alert('Select Fields Date,Operation Types ,status');
      }
    });

    $('#reset').click(function() {
      $('#from_date').val('');
      $('#to_date').val('');
      $('#filter_libell_operation_type').val('');
      $('#filter_libell_state').val('');
      $('#operation_data').DataTable().destroy();
      fill_datatable();
    });

  });
</script>




</body>

</html>