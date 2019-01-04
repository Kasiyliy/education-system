@extends('layouts.master')

@section("title", "Quiz")
@section('extrastyle')
    <link href="{{ URL::asset('assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/sweetalert.css')}}" rel="stylesheet">
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
                            <h2>Тесты</h2>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="row">

                                <form id="examForm" class="form-horizontal form-label-left custom-error" novalidate
                                      method="get" action="{{URL::route('quiz.index2')}}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="item form-group">
                                                <label class="control-label " for="department">Глобальный курс <span
                                                            class="required">*</span>
                                                </label>

                                                {!!Form::select('department_id', $departments, null, ['placeholder' => 'Pick a department','class'=>'select2_single department form-control has-feedback-left','required'=>'required','id'=>'department_id'])!!}
                                                <i class="fa fa-home form-control-feedback left" aria-hidden="true"></i>
                                                <span class="text-danger">{{ $errors->first('department_id') }}</span>

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="item form-group">
                                                <label class="control-label" for="subject_id">Под курс <span
                                                            class="required">*</span>
                                                </label>

                                                {!!Form::select('subject_id',$subjects, null, ['placeholder' => 'Pick a Subject','class'=>'select2_single subject form-control has-feedback-left','required'=>'required' ,'id'=>'subject_id'])!!}
                                                <i class="fa fa-book form-control-feedback left" aria-hidden="true"></i>
                                                <span class="text-danger">{{ $errors->first('subject_id') }}</span>

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="item form-group">
                                                <input type="submit" value="Поиск" class="btn btn-lg btn-info center-margin">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <table id="datatable-buttons" class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Наименование</th>
                                            <th>Урок</th>
                                            <th>Действие</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($quizes as $quiz)
                                            <tr>
                                                <td>{{$quiz->id}}</td>
                                                <td>{{$quiz->name}}</td>
                                                <td>{{$quiz->subjectName}}</td>
                                                <td>
                                                    <a  href="{{URL::route('quiz.questions', ['id' => $quiz->id])}}" class='btn btn-xs btn-success'
                                                       data-id='{{$quiz->id}}'> Добавить вопрос</a>
                                                    <a href="{{URL::route('quiz.questions.index', ['id' => $quiz->id])}}" class='btn btn-xs btn-success'
                                                       >Вопросы</a>
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
    <script src="{{ URL::asset('assets/js/validator.min.js')}}"></script>

    <script>
        $(document).ready(function () {

            $(".department").select2({
                placeholder: "Select Department",
                allowClear: true
            });
            $(".subject").select2({
                placeholder: "Select Subject",
                allowClear: true
            });
            // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
            $('form')
                .on('blur', 'input[required], input.optional, select.required', validator.checkField)
                .on('change', 'select.required', validator.checkField)
                .on('keypress', 'input[required][pattern]', validator.keypress);

            $('form').submit(function (e) {
                e.preventDefault();
                var submit = true;

                // evaluate the form using generic validaing
                if (!validator.checkAll($(this))) {
                    submit = false;
                }

                if (submit)
                    this.submit();

                return false;
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

            $('#department_id').on('change', function () {
                var dept = $('#department_id').val();
                $.ajax({
                    url: '/subject/' + dept + '/1',
                    type: 'get',
                    dataType: 'json',
                    success: function (data) {
                        //console.log(data);
                        $('#subject_id').empty();
                        $('#subject_id').append('<option  value="">Pick a Subject</option>');
                        $.each(data.subjects.data, function (key, value) {
                            $('#subject_id').append('<option  value="' + value.id + '">' + value.name + '[' + value.code + ']</option>');

                        });
                        $(".subject").select2({
                            placeholder: "Выберите урок",
                            allowClear: true
                        });

                    },
                    error: function (data) {
                        var respone = JSON.parse(data.responseText);
                        $.each(respone.message, function (key, value) {
                            new PNotify({
                                title: 'Error!',
                                text: value,
                                type: 'error',
                                styling: 'bootstrap3'
                            });
                        });
                    }
                });
            });

        });

    </script>

@endsection
