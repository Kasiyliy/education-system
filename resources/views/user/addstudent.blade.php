@extends('layouts.master')

@section('title', 'Аккаунт студент')
@section('extrastyle')
    <link href="{{ URL::asset('assets/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/switchery.min.css')}}" rel="stylesheet">

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
                        <div class="">
                            <h2>{{trans('messages.user_text20')}}</h2>

                        </div>
                        <div class="">
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <strong>Упс!</strong> Произошли проблемы с вашим вводом.<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form class="form-horizontal form-label-left" novalidate method="post"
                                  action="{{URL::route('user.addstudent')}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="item form-group">
                                            <label for="student">{{trans('messages.user_text21')}}<span
                                                        class="required">*</span>
                                            </label>
                                            {!!Form::select('student_id', $studentList, null, ['placeholder' => 'Выберите студента','class'=>'select2_single student form-control has-feedback-left','required'=>'required','id'=>'student_id'])!!}
                                            <i class="fa fa-home form-control-feedback left" aria-hidden="true"></i>
                                            <span class="text-danger">{{ $errors->first('id') }}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="item form-group">
                                            <label for="user">{{trans('messages.user_text22')}}<span
                                                        class="required">*</span>
                                            </label>
                                            {!!Form::select('user_id', $users, null, ['placeholder' => 'Выберите аккаунт','class'=>'select2_single user form-control has-feedback-left','required'=>'required','id'=>'user_id'])!!}
                                            <i class="fa fa-home form-control-feedback left" aria-hidden="true"></i>
                                            <span class="text-danger">{{ $errors->first('id') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="ln_solid"></div>
                                <div class="row">
                                    <button id="btnsave" type="submit" class="btn btn-lg btn-success pull-right"><i
                                                class="fa fa-check"> {{trans('messages.user_text23')}}</i></button>
                                </div>

                            </form>

                            <div class="row">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <td>{{trans('messages.user_text24')}}</td>
                                        <td>{{trans('messages.user_text25')}}</td>
                                        <td>{{trans('messages.button_action')}}</td>
                                    </tr>
                                    </thead>
                                     @foreach ($studentWithAccounts as $item)
                                        <tr>
                                            <td>{{$item->firstName}} {{$item->lastName}}</td>
                                            <td>{{$item->login}}</td>
                                            <td>
                                                <form class="deleteForm" method="POST"
                                                      action="{{URL::route('user.deleteAccount',$item->user_id)}}">

                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <button type="submit" class='btn btn-danger btn-xs btnDelete'
                                                            href=''><i
                                                                class="glyphicon glyphicon-trash icon-white"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tbody>

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
        </div>
    </div>
@endsection
@section('extrascript')
    <script src="{{ URL::asset('assets/js/select2.full.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/switchery.min.js')}}"></script>
    <!-- validator -->
    <script>
        $(document).ready(function () {
            $('#btnsave').hide();
            $(".student").select2({
                placeholder: "Выберите Студента",
                allowClear: true
            });
            $(".user").select2({
                placeholder: "Выберите Студента",
                allowClear: true
            });


            //get students lists
            $('#student_id').on('change', function () {
                var sub = $('#student_id').val();
                if (!sub) {
                    new PNotify({
                        title: 'Ошибка валидации!',
                        text: 'Пожалуйста выберите студента!',
                        type: 'error',
                        styling: 'bootstrap3'
                    });
                } else {
                    $('#btnsave').show();
                }
            });
        });

        //make all checkbox checked
        $('.allCheck').on('change', function () {
            $('.tb-switch').trigger('click');
        });
    </script>
@endsection
