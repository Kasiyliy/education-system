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
                            <h2>{{trans('messages.presentation_text12')}}</h2>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <table id="datatable-buttons" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>{{trans('messages.presentation_text13')}}</th>
                                    <th>{{trans('messages.presentation_text14')}}</th>
                                    <th>{{trans('messages.button_action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($lessons)
                                    @foreach($lessons as $lesson)
                                        @if($lesson->subject)
                                            <tr>
                                                <td>{{$lesson->name}}</td>
                                                <td>{{$lesson->subject()->first()->name }}</td>
                                                <td>
                                                    <a class="btn btn-success btn-xs"
                                                       href="{{URL::route('lesson.edit' ,['id'=>$lesson->id])}}">{{trans('messages.button_change')}}</a>
                                                    <form style="display: inline;"
                                                          action="{{URL::route('lesson.destroy', ['id' => $lesson->id])}}"
                                                          method="POST">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        {{csrf_field()}}
                                                        <button type="submit"
                                                                class="btn btn-danger btn-xs">{{trans('messages.button_delete')}}</button>
                                                    </form>
                                                    <a href="{{URL::route('lesson.show', ['id' => $lesson->id])}}"
                                                       class="btn btn-info btn-xs">{{trans('messages.button_see')}}</a>
                                                </td>
                                                </form>
                                                </td>
                                            </tr>
                                        @endif
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
