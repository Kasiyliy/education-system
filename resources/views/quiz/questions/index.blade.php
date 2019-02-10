@extends('layouts.master')

@section("title", "Quiz")
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
                        <div class="x_title ">
                            <span class="text-uppercase">{{$quiz->name}}</span> - {{$quiz->description}}
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content mx-auto">

                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <strong>Ошибка!</strong> Ваши введенные данные не прошли валидацию!<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                        </div>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>{{trans('messages.test_text11')}}</th>
                                    <th>{{trans('messages.button_action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                        $i = 0;
                                ?>
                                @if($quiz->questions->count() > 0)
                                    @foreach($quiz->questions as $question)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{$question->value}}</td>
                                            <td>
                                                <a href="{{URL::route('question.edit',['id' =>$question->id])}}" class="btn btn-success btn-xs">{{trans('messages.button_change')}}</a>
                                                <form style="display: inline;" class="form-inline" method="post" action="{{URL::route('question.destroy',['id' =>$question->id])}}">
                                                    {!! Form::token() !!}
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" class="btn btn-danger btn-xs">{{trans('messages.button_delete')}}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr cols="3">Нет вопросов</tr>
                                @endif
                            </tbody>
                        </table>
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
        $(document).ready(function() {

        });
    </script>

@endsection
