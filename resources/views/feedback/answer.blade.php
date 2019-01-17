@extends('layouts.master')


@section('title', 'Message | Answer')

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
                            </h2>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <form class="form-horizontal form-label-left" novalidate method="post"
                                  action="{{URL::route('feedback.send_answer')}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                           for="answer">E-mail<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input readonly type = "email" id="email" value = "{{$feedbacks->email}}" required="required" name="email"
                                                  class="form-control col-md-7 col-xs-12"/>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                           for="answer">{{trans('messages.feedback_text7')}}<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea readonly rows="5" id="message" required="required" name="message"
                                                  class="form-control col-md-7 col-xs-12">{{$feedbacks->message}}</textarea>
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                           for="answer">{{trans('messages.feedback_text10')}}<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea id="answer" required="required" name="answer"
                                                  class="form-control col-md-7 col-xs-12"></textarea>
                                        <span class="text-danger">{{ $errors->first('answer') }}</span>
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <button id="send" type="submit" class="btn btn-success"><i class="fa fa-check">
                                                {{trans('messages.chat_text8')}}</i></button>
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
