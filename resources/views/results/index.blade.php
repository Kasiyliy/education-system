@extends('layouts.master')

@section("title", "Quiz")
@section('extrastyle')
    <link href="{{ URL::asset('assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/buttons.bootstrap.min.css')}}" rel="stylesheet">

    <link href="{{ URL::asset('assets/css/select2.min.css')}}" rel="stylesheet">
    <style>
        @media print {
            table td:last-child {
                display: none
            }

            table th:last-child {
                display: none
            }
        }
    </style>
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
                            <h2>{{trans('messages.result_text1')}}
                                <small>{{trans('messages.result_text2')}}</small>
                            </h2>

                            <div class="clearfix"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table id="datatable-buttons" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>{{trans('messages.result_text3')}}</th>
                                        <th>{{trans('messages.result_text4')}}</th>
                                        <th>{{trans('messages.result_text5')}}</th>
                                        <th>{{trans('messages.result_text6')}}</th>
                                        <th>{{trans('messages.button_action')}}</th>
                                    </tr>
                                    </thead>
                                    {{--<tbody>--}}
                                    {{--@foreach($quizResults as $quizResult)--}}
                                        {{--<tr>--}}
                                            {{--@if($quizResult->quiz && $quizResult->student && $quizResult->student->user && $quizResult->quiz->subject)--}}
                                                {{--<td>{{$quizResult->student->user->firstname.' '.$quizResult->student->user->lastname}}</td>--}}
                                                {{--<td>{{$quizResult->percentage}}</td>--}}
                                                {{--<td>{{$quizResult->quiz->subject->department->name.' - '.$quizResult->quiz->subject->name}}</td>--}}
                                                {{--<td>{{$quizResult->created_at}}</td>--}}
                                                {{--<td>--}}
                                                    {{--<form action="{{URL::route("result.quiz.delete", ['id' => $quizResult->id])}}" method="post">--}}
                                                        {{--{{csrf_field()}}--}}
                                                        {{--<button type="submit" class="btn btn-danger">--}}
                                                            {{--<span class="fa fa-trash"></span>--}}
                                                        {{--</button>--}}
                                                    {{--</form>--}}

                                                {{--</td>--}}
                                            {{--@endif--}}
                                        {{--</tr>--}}
                                    {{--@endforeach--}}
                                    {{--</tbody>--}}
                                </table>
                            </div>
                        </div>
                        <!-- row end -->
                        <div class="clearfix"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->

    <!-- Modal For Attendance Update -->
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

        $(document).ready(function () {
            $(".select2_single").select2({
                placeholder: "Select Department",
                allowClear: true
            });
            //datatables code
            var handleDataTableButtons = function () {
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

            TableManageButtons = function () {
                "use strict";
                return {
                    init: function () {
                        handleDataTableButtons();
                    }
                };
            }();

            TableManageButtons.init();

        });
    </script>

@endsection