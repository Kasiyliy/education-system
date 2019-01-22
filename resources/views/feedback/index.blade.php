@extends('layouts.master')

@section('title', 'Под курсы')
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
                            <h2>{{trans('messages.feedback_text7')}}
                                <small> {{trans('messages.feedback_text8')}}.</small>
                            </h2>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <table id="datatable-buttons" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>{{trans('messages.feedback_text9')}}</th>
                                    <th>E-mail</th>
                                    <th>{{trans('messages.feedback_text4')}}</th>
                                    <th>{{trans('messages.feedback_text5')}}</th>
                                    <th>{{trans('messages.feedback_text6')}}</th>
                                    <th>{{trans('messages.button_action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($feedbacks)
                                    @foreach($feedbacks as $feedback)
                                        <tr>
                                            <td>{{$feedback->name. " ".$feedback->surname}}</td>
                                            <td>{{$feedback->email}}</td>
                                            <td>{{$feedback->message}}</td>
                                            <td>@if($feedback->feedback == 0)
                                                    {{trans('messages.chat_text12')}}

                                                @else
                                                    {{trans('messages.chat_text11')}}

                                                @endif</td>
                                            <td>{{$feedback->created_at }}</td>
                                            <td>
                                                <a title='Update' class='btn btn-info btn-xs btnUpdate'
                                                   id='{{$feedback->id}}'
                                                   href='{{URL::route('feedback.answer',$feedback->id)}}'> <i
                                                            class="glyphicon glyphicon-envelope icon-white"></i></a>
                                                <form class="deleteForm" method="POST"
                                                      action="{{URL::route('feedback.destroy',$feedback->id)}}">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <button type="submit" class='btn btn-danger btn-xs btnDelete'><i
                                                                class="glyphicon glyphicon-trash icon-white"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- row end -->
                    <div class="clearfix"></div>

                </div>
            </div>
            <!-- /page content -->
        </div>
    </div>
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

        $(document).ready(function () {

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
    <!-- /validator -->
@endsection
