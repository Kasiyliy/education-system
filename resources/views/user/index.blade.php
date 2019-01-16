@extends('layouts.master')

@section('title', 'Пользователи')
@section('extrastyle')
    <link href="{{ URL::asset('assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
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

                            <h2>Пользователь
                                <small> Информация обо всех пользователях.</small>
                            </h2>
                            <a href="{{URL::Route('user.create')}}" class="btn btn-success pull-right"><i
                                        class="fa fa-plus"></i> Новый пользователь </a>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <table id="datatable-buttons" class="table table-striped table-bordered">
                                <thead>
                                <tr>

                                    <th>ФИО</th>
                                    <th>Логин</th>
                                    <th>Группа</th>
                                    <th>Email</th>
                                    <th>Информация</th>
                                    <th>Добавлен</th>
                                    <th>Действия</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->firstname}} {{$user->lastName}}</td>
                                        <td>{{$user->login}}</td>
                                        <td>{{$user->group}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->description}}</td>
                                        <td>{{$user->created_at->format('F j, Y h:m A')}}</td>
                                        <td>
                                            <a title='Update' class='btn btn-info btn-xs btnUpdate'
                                               id='{{$user->id}}'
                                               href='{{URL::route('user.settings',['id' => $user->id])}}'> <i
                                                        class="glyphicon glyphicon-check icon-white"></i></a>
                                            <form class="deleteForm" method="POST"
                                                  action="{{URL::route('user.destroy',$user->id)}}">
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
                <script src="{{ URL::asset('assets/js/sweetalert.min.js')}}"></script>


                <script>

                    $(document).ready(function () {

                        //datatables code
                        var handleDataTableButtons = function () {
                            if ($("#datatable-buttons").length) {
                                $("#datatable-buttons").DataTable({
                                    responsive: true,
                                    iDisplayLength: 100,
                                    dom: "Bfrtip",
                                    buttons: [
                                        {
                                            extend: "copy",
                                            className: "btn-sm",
                                            exportOptions: {
                                                columns: [0, 1, 2, 3, 4]
                                            }
                                        },
                                        {
                                            extend: "csv",
                                            className: "btn-sm",
                                            exportOptions: {
                                                columns: [0, 1, 2, 3, 4, 5, 6]
                                            }
                                        },
                                        {
                                            extend: "excel",
                                            className: "btn-sm",
                                            exportOptions: {
                                                columns: [0, 1, 2, 3, 4, 5, 6]
                                            }
                                        },
                                        {
                                            extend: "pdfHtml5",
                                            className: "btn-sm",
                                            exportOptions: {
                                                columns: [0, 1, 2, 3, 4, 5, 6]
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
                    //delete warning
                    $('.deleteForm').submit(function (e) {
                        e.preventDefault();
                        form = this;
                        swal({
                            title: "Удаление пользователя!",
                            text: 'Вы уверены что хотите удалить пользователя?',
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#cc3f44",
                            confirmButtonText: "Да",
                            closeOnConfirm: true,
                            html: false
                        }, function (isConfirm) {
                            if (isConfirm)
                                form.submit();
                        });
                    });
                </script>

@endsection
