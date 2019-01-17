@extends('layouts.master')

@section('title', 'Чат | Люди')
@section('extrastyle')
<link href="{{ URL::asset('assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{ URL::asset('assets/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{ URL::asset('assets/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{ URL::asset('assets/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
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
                    <h2>{{trans('messages.chat_text1')}}</h2>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>{{trans('messages.chat_text2')}}</th>
                          <th>{{trans('messages.chat_text3')}}</th>
                          <th>{{trans('messages.button_action')}}</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($students as $student)
                        <tr>
                          <td>{{$student->id}}</td>
                          <td>{{$student->firstName.' '.$student->lastName.' '.$student->middleName}} <span class="badge">{{$student->unread}}</span></td>
                          <td>{{$student->subjectName}}</td>
                          <td>
                            <a href="{{URL::route('message.show2', ['studentId' => $student->id, 'subjectId' => $student->subjectId])}}" class="btn btn-success">{{trans('messages.chat_text4')}}</a>
                          </td>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
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
  <script>

      $(document).ready(function() {

          //datatables code
          var handleDataTableButtons = function() {
              if ($("#datatable-buttons").length) {
                  $("#datatable-buttons").DataTable({
                      "ordering": false,
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

@endsection
