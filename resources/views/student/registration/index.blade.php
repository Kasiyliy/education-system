@extends('layouts.master')


@section('title', 'Слушатели')
@section('extrastyle')
<link href="{{ URL::asset('assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{ URL::asset('assets/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{ URL::asset('assets/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{ URL::asset('assets/css/select2.min.css')}}" rel="stylesheet">
<link href="{{ URL::asset('assets/css/sweetalert.css')}}" rel="stylesheet">

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
                        <h2>{{trans('messages.student')}}</h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">

                            <form class="" method="POST" action="{{URL::route('student.registration.list')}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="col-md-4 col-sm-12 col-xs-12">
                                    <label for="subject_id">{{trans('messages.courses')}}: <span class="required">*</span></label>
                                    {!!Form::select('subject_id', $subjects, $selectSub, ['placeholder' => '','class'=>'select2_single subject form-control has-feedback-left','tabindex'=>'-1','id'=>'subject_id']) !!}
                                    <i class="fa fa-home form-control-feedback left" aria-hidden="true"></i>

                                </div>

                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <br>
                                    <button type="submit" class="btn btn-lg btn-success"><i class="fa fa-check"></i>{{trans('messages.find')}}</button>
                                </div>
                            </form>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <table id="datatable-buttons" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>{{trans('messages.registration_text4')}}</th>
                                            <th>{{trans('messages.registration_text8')}}</th>
                                            <th>{{trans('messages.button_action')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($students as $student)
                                        <tr>
                                            <td>{{$student->student->firstName}} {{$student->student->middleName}} {{$student->student->lastName}}</td>
                                            <td>{{$student->student->id}}</td>
                                            <td>
                                                <form class="deleteForm" method="get" action="{{URL::route('student.registration.destroy',$student->id)}}">
                                                    <input name="_method" type="hidden" value="DELETE" />
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                                    <button type="submit" class='btn btn-danger btn-xs btnDelete'> <i class="glyphicon glyphicon-trash icon-white"></i> </button>
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
<script src="{{ URL::asset('assets/js/sweetalert.min.js')}}"></script>
<script>
$(document).ready(function() {

    $(".subject").select2({
        placeholder: "",
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
    @if($selectSub!="" && count($students)==0)
    new PNotify({
        title: `{{trans('messages.error')}}`,
        text: `{{trans('messages.info_error')}}`,
        styling: 'bootstrap3'
    });
    @endif

});

</script>

@endsection
