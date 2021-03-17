@extends('layouts.admin')

@section('content')
<div class="container-fluid" >

    <div class="row">
            <a href="#" class="btn blue col s2 offset-s1">Create</a>
        </div>
        
<div class="row" style="margin-bottom:0%">
<form  role="form" method="GET" action="{{url('registration/downloadPDF')}}">
              
        <div class="input-field col m2 s12 offset-m1">
                <select name="section" id="section">
<option >----select----</option>

                        @if (count($initiator_groupname) > 0)
                        @foreach ($initiator_groupname as $ini)
                            <option value="{{$initiator_groupname->id}}">{{$ini->initiator_groupname}}</option>
                        @endforeach
                        @else
                        <option>No initiator Available</option>

                        @endif
                </select>
                <label>Initiator</label>
                
        </div>           
        <div class="input-field col m2 s12 ">
                <select name="classeLevel" id="classeLevel">
                        <option>Select classe level</option>

                </select>
                <label>Classe Level</label>
                
        </div>           
        <div class="input-field col m2 s12">
                <select name="classe"  id="classe" > 
                        <option>---Select classe---</option>

                </select>
                <label>Classe</label>
                
        </div>
        <div class="input-field col m2 s12 ">
                <select name="academic_year_id" id="academic_year_id" >
                        <option >--select---</option>
                        @if (count($tickettype) > 0)
                        @foreach ($tickettype as $ti)
                            <option value="{{$tickettype->id}}" >{{$ti->ticket_type}}</option>
                        @endforeach
                        @else

                        @endif
                </select>
                <label>Type Ticket</label>
                
        </div>
        <div class="col m3 s12" style="margin-top:1.5%">
                <button type="button" class="btn blue col m4 s12" id="load">load</button>
                <button type="submit" class="btn grey col m4 s12" ><i class="material-icons center">print</i></button>
                {{-- {{Form::Submit('print',['class'=>'btn grey col m4 s12'])}} --}}
                {{-- <a href="{{url('teacher')}}" class="btn blue col m4 s12">Load</a> --}}
                {{-- <a href="{{ url('registration/downloadPDF') }}" class="btn grey col m2 s12 center" style="margin-left:1%"><i class="material-icons center">print</i></a> --}}
                {{-- <a id="print" class="btn grey col m2 s12 center" style="margin-left:1%"><i class="material-icons center">print</i></a> --}}
            </div>
        </form>
  
     
      
</div>
        <div class="row" style="margin-top:0%; ">
                <div id="admin" class="col s10 offset-s1">
                  <div class="card material-table">
                    <div class="table-header blue white-text center">
                    <span class="table-title center white-text">List of Students </span>
                      <div class="actions container row" style="padding:3%">
                         
                      <h6 class="col s4" style="margin-right:3%" style="margin-top:2%">Total: </h6>
                            <a href="#" class="search-toggle waves-effect btn-flat  col s1 " style="margin-top:2%"><i class="material-icons white-text large">search</i></a>
                        {{-- <a href="#add_users" class="modal-trigger waves-effect btn-flat nopadding"><i class="material-icons">person_add</i></a> --}}
                      </div>
                    </div>
                    <table id="datatable" class="responsive-table bordered">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th>Matricule</th>
                                <th>FirstName</th>
                                <th>Last Name</th>
                                <th>Sexe</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody id="table">

                            </tbody>
                            
                            {{-- <tfoot>
                                Hello
                            </tfoot> --}}
                          </table>
                        
                    {{-- <p>No students found please create before Continuing...</p> --}}
                        
                  </div>
                </div>
              </div>
  
     

        

   

</div>
@endsection
