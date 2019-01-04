@extends('layouts.master')

@section('title', 'Студенты')
@section('extrastyle')
<link href="{{ URL::asset('assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{ URL::asset('assets/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{ URL::asset('assets/css/buttons.bootstrap.min.css')}}" rel="stylesheet">

<link href="{{ URL::asset('assets/css/select2.min.css')}}" rel="stylesheet">

@endsection
@section('content')

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">

            <div class="clearfix"></div>
            <!-- row start -->
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Студенты<small> Информация о всех студентах</small></h2>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="row">

                        <form class="" method="POST" action="{{URL::route('student.department')}}">
                          <input type="hidden" name="_token" value="null">
                        </form>
                      </div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>ФИО</th>
                          <th>ID</th>
                          <th>Действия</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($students as $student)
                        <tr>
                          <td>{{$student->firstName}} {{$student->middleName}} {{$student->lastName}}</td>
                          <td>{{$student->id}}</td>
                          <td>
                         <a title='Update' class='btn btn-info btn-xs btnUpdate' id='{{$student->id}}' href='{{URL::route('student.edit',$student->id)}}'> <i class="glyphicon glyphicon-check icon-white"></i></a>
                         <form class="deleteForm" method="POST" action="{{URL::route('student.destroy',$student->id)}}">
                           <input name="_method" type="hidden" value="DELETE">
                         <input type="hidden" name="_token" value="{{ csrf_token() }}">
                         <button type="submit" class='btn btn-danger btn-xs btnDelete' href=''> <i class="glyphicon glyphicon-trash icon-white"></i></a>
                       </form>
                      </td>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
                  </div>
                </div>
              <!-- row end -->
              <div class="clearfix"></div>

          </div>
        </div>
        <!-- /page content -->
@endsection
@section('extrascript')
<!-- dataTables -->
<script src="{{ URL::asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ URL::asset('assets/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{ URL::asset('assets/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ URL::asset('assets/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ URL::asset('assets/js/buttons.bootstrap.min.js')}}"></script>
<script src="{{ URL::asset('assets/js/buttons.flash.min.js')}}"></script>
<script src="{{ URL::asset('assets/js/buttons.html5.min.js')}}"></script>
<script src="{{ URL::asset('assets/js/buttons.print.min.js')}}"></script>
<script src="{{ URL::asset('assets/js/jszip.min.js')}}"></script>
<script src="{{ URL::asset('assets/js/pdfmake.min.js')}}"></script>
<script src="{{ URL::asset('assets/js/vfs_fonts.js')}}"></script>
<script src="{{ URL::asset('assets/js/select2.full.min.js')}}"></script>

   <script>

     $(document).ready(function() {
       $(".select2_single").select2({
           placeholder: "Select Department",
            allowClear: true
       });
     //datatables code
     var handleDataTableButtons = function() {
       if ($("#datatable-buttons").length) {
         $("#datatable-buttons").DataTable({
           responsive: true,
           dom: "Bfrtip",
           buttons: [
             {
               extend: "copy",
               className: "btn-sm"
             },
             {
               extend: "csv",
               className: "btn-sm"
             },
             {
               extend: "excel",
               className: "btn-sm"
             },
             {
               extend: "pdfHtml5",
               className: "btn-sm"
             },
             {
               extend: "print",
               className: "btn-sm"
             },
           ],
           responsive: true
         });
       }
     };

     TableManageButtons = function() {
       "use strict";
       return {
         init: function() {
           handleDataTableButtons();
         }
       };
     }();

    TableManageButtons.init();

   });
   </script>
   <!-- /validator -->
@endsection
