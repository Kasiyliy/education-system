@extends('layouts.master')


@section('title', 'Глобальный курс | изменение')

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
                            <h2>{{trans('messages.sertificate_text6')}}
                                <small>{{trans('messages.sertificate_text7')}}</small>
                            </h2>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="row">
                                    <div class="col-md-12">
                                        <img src="/assets/images/example.jpg" style = "width:100%;">
                                    </div>
                            </div><br/><br/><br/>

                        <form class="form-horizontal form-label-left" novalidate method="post"
                                  action="{{URL::route('certificate.change',['certificate_id' => $certificate->id  , 'subject_id' => $subject_id])}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">


                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                           for="text1">{{trans('messages.sertificate_text3')}} 1<span
                                                class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="text1" type="text" class="form-control col-md-7 col-xs-12"
                                               name="text1"
                                               value="{{$certificate->text1}}" maxlength="22" placeholder="text1">
                                        <span class="text-danger">{{ $errors->first('text1') }}</span>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                           for="text2">{{trans('messages.sertificate_text3')}} 2<span
                                                class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="text2" type="text" class="form-control col-md-7 col-xs-12"
                                               name="text2"
                                               value="{{$certificate->text2}}" maxlength="22" placeholder="text2">
                                        <span class="text-danger">{{ $errors->first('text2') }}</span>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" style="font-style: italic"
                                           for="text3">{{trans('messages.sertificate_text4')}} 1<span
                                                class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="text3" type="text" class="form-control col-md-7 col-xs-12"
                                               name="text3"
                                               value="{{$certificate->text3}}" maxlength="22" placeholder="text3">
                                        <span class="text-danger">{{ $errors->first('text3') }}</span>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" style="font-style: italic"
                                           for="text4">{{trans('messages.sertificate_text4')}} 2<span
                                                class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="text4" type="text" class="form-control col-md-7 col-xs-12"
                                               name="text4"
                                               value="{{$certificate->text4}}" maxlength="22" placeholder="text4">
                                        <span class="text-danger">{{ $errors->first('text4') }}</span>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" style="font-style: italic"
                                           for="text5">{{trans('messages.sertificate_text4')}} 3<span
                                                class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="text5" type="text" class="form-control col-md-7 col-xs-12"
                                               name="text5"
                                               value="{{$certificate->text5}}" maxlength="22" placeholder="text5">
                                        <span class="text-danger">{{ $errors->first('text5') }}</span>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" style="font-style: italic"
                                           for="text6">{{trans('messages.sertificate_text4')}} 4<span
                                                class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="text6" type="text" class="form-control col-md-7 col-xs-12"
                                               name="text6"
                                               value="{{$certificate->text6}}" maxlength="22" placeholder="text6">
                                        <span class="text-danger">{{ $errors->first('text6') }}</span>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                           for="text7">{{trans('messages.sertificate_text3')}} 3<span
                                                class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="text7" type="text" class="form-control col-md-7 col-xs-12"
                                               name="text7"
                                               value="{{$certificate->text7}}" maxlength="22" placeholder="text7">
                                        <span class="text-danger">{{ $errors->first('text7') }}</span>
                                    </div>
                                </div>


                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                           for="name">{{trans('messages.sertificate_text5')}}<span
                                                class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="goden" type="text" class="form-control col-md-7 col-xs-12"
                                               name="goden"
                                               value="{{$certificate->goden_do}}" placeholder="Sertifiact goden do"
                                               required="required">
                                        <span class="text-danger">{{ $errors->first('goden_do') }}</span>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                           for="inspired_by">{{trans('messages.sertificate_text8')}}<span
                                                class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="inspired_by" class="form-control col-md-7 col-xs-12"
                                               name="inspired_by"
                                               value="{{$certificate->inspired_by}}"
                                               placeholder="состоит максимум из 20 символов" required="required">
                                        <span class="text-danger">{{ $errors->first('inspired_by') }}</span>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                           for="description">{{trans('messages.sertificate_text9')}}
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="on_behalf_and_for"
                                               class="form-control col-md-7 col-xs-12" name="on_behalf_and_for"
                                               value="{{$certificate->on_behalf_and_for}}"
                                               placeholder="состоит максимум из 20 символов" required="required">
                                        <span class="text-danger">{{ $errors->first('on_behalf_and_for') }}</span>
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <button id="send" type="submit" class="btn btn-success"><i class="fa fa-check">
                                                {{trans('messages.button_change')}}</i></button>
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
            <!-- /page content -->
        </div>
    </div>
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
