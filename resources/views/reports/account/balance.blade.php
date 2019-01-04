@extends('layouts.master')
@section("title", "Account-[$fromDate-$toDate]")
@section('extrastyle')
<link href="{{ URL::asset('assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{ URL::asset('assets/css/responsive.dataTables.min.css')}}" rel="stylesheet">
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
                    <h2>Account<small> Account Balance</small></h2>
                    <label class="total_bal">
                               Balance : {{$balance}}
                          </label>
                          <div class="clearfix"></div>

                  </div>
                </div>
                <h2 class="text-info text-center">Expence Accounts</h2>
                <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                <table id="datatable-buttons" class="smartTable table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Sector</th>
                      <th>Type</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Description</th>


                    </tr>
                  </thead>
                  <tbody>
                          @foreach($expences as $expence)
                                <tr>
                                  <td>{{$expence->sector->name}}</td>
                                  <td>{{$expence->sector->type}}</td>
                                <td>{{$expence->amount}}</td>
                                <td>{{$expence->date->format('F j,Y')}}</td>
                                <td>{{$expence->description}}</td>
                                </tr>
                              @endforeach

                  </tbody>

                </table>
              </div>
              </div>
              <h2 class="text-info text-center">Accounts Balance</h2>
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Total Income</th>
                  <th>Total Expence</th>
                  <th>Balance</th>
                </tr>
                </thead>
                <tbody>
                 <td>{{$incomeTotal}}</td>
                 <td>{{$expenceTotal}}</td>
                 <td>{{$balance}}</td>

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
<script src="{{ URL::asset('assets/js/moment.min.js')}}"></script>
<script src="{{ URL::asset('assets/js/daterangepicker.js')}}"></script>


 <script>
   $(document).ready(function() {

     $('#reservation').daterangepicker({ format:'D/M/YYYY'});
     //datatables code
     var handleDataTableButtons = function() {
       if ($(".smartTable").length) {
         $(".smartTable").DataTable({
           responsive: true,
           iDisplayLength:100,
           dom: "Bfrtip",
           buttons: [
             {
               extend: "copy",
               className: "btn-sm",
               exportOptions: {
                 columns: [0,1,2,3]
               }
             },
             {
               extend: "csv",
               className: "btn-sm",
               exportOptions: {
                 columns: [0,1,2,3]
               }
             },
             {
               extend: "excel",
               className: "btn-sm",
               exportOptions: {
                 columns: [0,1,2,3]
               }
             },
             {
               extend: "pdfHtml5",
               className: "btn-sm",
               exportOptions: {
                 columns: [0,1,2,3]
               }
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
