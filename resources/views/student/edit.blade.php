@extends('layouts.master')


@section('title', 'Студент-изменение')
@section('extrastyle')
    <link href="{{ URL::asset('assets/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/green.css')}}" rel="stylesheet">

@endsection

@section('content')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">


            <div class="row">

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>{{trans('messages.student_text111')}}
                                <small class="text-danger"> * {{trans('messages.student_text112')}}.</small>
                            </h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <form id="myForm" class="form-horizontal form-label-left" novalidate method="post"
                                  action="{{URL::route('student.update',$student->id)}}" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input name="_method" type="hidden" value="PATCH">
                                <h3 class="text-info">{{trans('messages.student_text2')}}</h3>

                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <label for="firstName">{{trans('messages.student_text3')}}: <span
                                                    class="text-danger">*</span></label>
                                        <input type="text" id="firstName" class="form-control has-feedback-left"
                                               name="firstName" value="{{$student->firstName}}" required/>
                                        <i class="fa fa-user form-control-feedback left" aria-hidden="true"></i>
                                        <span id="msg_firstName"
                                              class="text-danger">{{ $errors->first('firstName') }}</span>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <label for="middleName">{{trans('messages.student_text5')}} :</label>
                                        <input type="text" id="middleName" class="form-control has-feedback-left"
                                               name="middleName" value="{{$student->middleName}}" required/>
                                        <i class="fa fa-user form-control-feedback left" aria-hidden="true"></i>
                                        <span id="msg_middleName" class="text-danger"></span>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <label for="lastName">{{trans('messages.student_text4')}}: <span
                                                    class="text-danger">*</span></label>
                                        <input type="text" id="lastName" class="form-control has-feedback-left"
                                               name="lastName" value="{{$student->lastName}}" required/>
                                        <i class="fa fa-user form-control-feedback left" aria-hidden="true"></i>
                                        <span id="msg_lastName"
                                              class="text-danger">{{ $errors->first('lastName') }}</span>

                                    </div>

                                    <div class="col-md-2 col-sm-6 col-xs-12">
                                        <label for="gender">{{trans('messages.student_text6')}}: <span
                                                    class="text-danger">*</span></label>
                                        <p>
                                            {{trans('messages.student_text61')}}.:
                                            @if($student->gender=="Male")
                                                <input type="radio" class="flat" name="gender" id="genderM" value="Male"
                                                       checked=""/> {{trans('messages.student_text62')}}.:
                                                <input type="radio" class="flat" name="gender" id="genderF"
                                                       value="Female"/>
                                            @else
                                                <input type="radio" class="flat" name="gender" id="genderM"
                                                       value="Male"/> {{trans('messages.student_text62')}}.:
                                                <input type="radio" class="flat" name="gender" id="genderF"
                                                       value="Female" checked=""/>
                                            @endif
                                        </p>
                                    </div>

                                </div>
                                <div class="row">

                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <label for="dob">{{trans('messages.student_text7')}}: <span class="text-danger">*</span></label>
                                        <input type="text" name="dob" id="dob" class="form-control has-feedback-left"
                                               value="{{$student->dob->format('d/m/Y')}}"
                                               data-inputmask="'mask': '99/99/9999'" required>
                                        <i class="fa fa-calendar form-control-feedback left" aria-hidden="true"></i>
                                        <span id="msg_dob" class="text-danger">{{ $errors->first('dob') }}</span>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <label for="mobileNo">{{trans('messages.student_text8')}}: <span
                                                    class="text-danger">*</span></label>
                                        <input type="text" id="mobileNo" class="form-control has-feedback-left"
                                               data-inputmask="'mask': '+7 9999999999'" value="{{$student->mobileNo}}"
                                               name="mobileNo" required/>
                                        <i class="fa fa-phone form-control-feedback left" aria-hidden="true"></i>
                                        <span id="msg_mobileNo"
                                              class="text-danger">{{ $errors->first('mobileNo') }}</span>

                                    </div>
                                </div>

                                <br><br>
                                <button type="submit" name=""
                                        class="btn btn-success">{{trans('messages.button_change')}}</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- /page content -->
@endsection
@section('extrascript')
    <script src="{{ URL::asset('assets/js/select2.full.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/icheck.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/jquery.inputmask.bundle.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/validator.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            $(".select2_single").select2({
                placeholder: "Select a Option",
                allowClear: true
            });
            $(":input").inputmask();

        });
    </script>

@endsection
