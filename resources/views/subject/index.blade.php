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
                            <h2>{{trans('messages.course_text1')}}
                                <small> {{trans('messages.course_text2')}}.</small>
                            </h2>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <table id="datatable-buttons" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>{{trans('messages.course_text3')}}</th>
                                    <th>{{trans('messages.course_text10')}}</th>
                                    <th>{{trans('messages.course_text5')}}</th>
                                    <th>{{trans('messages.course_text6')}}</th>
                                    <th>{{trans('messages.disciplina')}}</th>
                                    <th>{{trans('messages.course_text7')}}</th>
                                    <th>{{trans('messages.button_action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($subjects as $subject)
                                    <tr>
                                        <td>{{$subject->name}}</td>
                                        <td>{{$subject->user ? $subject->user->firstname.' '.$subject->user->lastname.' '.$subject->user->middlename : ''}}</td>
                                        <td>{{$subject->code}}</td>
                                        <td>{{$subject->price}}</td>
                                        <td>{{$subject->department ? $subject->department->name: ''}}</td>
                                        <td>{{$subject->description}}</td>
                                        <td>
                                            <a title='Update' class='btn btn-info btn-xs btnUpdate'
                                               id='{{$subject->id}}' href='{{URL::route('subject.edit',$subject->id)}}'>
                                                <i class="glyphicon glyphicon-check icon-white"></i></a>
                                            <form class="deleteForm" method="POST"
                                                  action="{{URL::route('subject.destroy',$subject->id)}}">
                                                <input name="_method" type="hidden" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <button type="submit" class='btn btn-danger btn-xs btnDelete' href=''><i
                                                            class="glyphicon glyphicon-trash icon-white"></i></button>
                                            </form>
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
@endsection
