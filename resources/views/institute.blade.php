@extends('layouts.master')

@section('title', 'Учереждение')

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
                            <h2>{{trans('messages.company')}}
                                <small>{{trans('messages.company_text1')}}</small>
                            </h2>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <form class="form-horizontal form-label-left" novalidate method="post"
                                  action="{{URL::route('institute')}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                           for="name">{{trans('messages.company_text2')}}<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="name" class="form-control col-md-7 col-xs-12"
                                               data-validate-length-range="6" name="name" value="{{$institute->name}}"
                                               placeholder="{{trans('messages.company_text2')}}" required="required"
                                               type="text">
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                           for="establish">{{trans('messages.company_text3')}}<span
                                                class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="establish" class="form-control col-md-7 col-xs-12"
                                               data-validate-length-range="4" name="establish"
                                               value="{{$institute->establish}}" placeholder="2016" required="required"
                                               type="text">
                                        <span class="text-danger">{{ $errors->first('establish') }}</span>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                           for="email">{{trans('messages.company_text4')}}<span
                                                class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="url" id="web" name="web" required="required"
                                               placeholder="http://astcglobal.org" value="{{$institute->web}}"
                                               class="form-control col-md-7 col-xs-12">
                                        <span class="text-danger">{{ $errors->first('web') }}</span>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                           for="email">{{trans('messages.company_text5')}}<span
                                                class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="email" id="email" name="email" required="required"
                                               value="{{$institute->email}}" class="form-control col-md-7 col-xs-12">
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                           for="telephone">{{trans('messages.company_text6')}}<span
                                                class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="tel" id="telephone" name="phoneNo" required="required"
                                               value="{{$institute->phoneNo}}" placeholder="+7xxxxxxxxxx"
                                               data-validate-length-range="11,20"
                                               class="form-control col-md-7 col-xs-12">
                                        <span class="text-danger">{{ $errors->first('phoneNo') }}</span>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                           for="textarea">{{trans('messages.company_text7')}}<span
                                                class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea id="textarea" required="required" name="address"
                                                  class="form-control col-md-7 col-xs-12">{{$institute->address}}</textarea>
                                        <span class="text-danger">{{ $errors->first('address') }}</span>
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <button id="send" type="submit" class="btn btn-success"><i
                                                    class="fa fa-check">{{trans('messages.button_change')}}</i></button>
                                    </div>
                                </div>
                                <div class="form-group">

                                </div>
                            </form>
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
    <script src="{{ URL::asset('assets/js/validator.min.js')}}"></script>
    <!-- validator -->
    <script>
        // initialize the validator function
        validator.message.date = 'not a real date';

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
    </script>
    <!-- /validator -->
@endsection
