@extends('layouts.master')


@section('title', 'Под курс | изменение')

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
                            <h2>{{trans('messages.course_text1')}}
                                <small> {{trans('messages.course_text2')}}</small>
                            </h2>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <form class="form-horizontal form-label-left" novalidate method="post"
                                  action="{{URL::route('subject.update',$subject->id)}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input name="_method" type="hidden" value="PATCH">
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                           for="department">{{trans('messages.course_text3')}}<span
                                                class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        {!!Form::select('department_id', $departments, $subject->department_id, ['placeholder' => '','class'=>'form-control col-md-7 col-xs-12','required'=>'required'])!!}
                                        <span class="text-danger">{{ $errors->first('department') }}</span>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                           for="name">{{trans('messages.course_text4')}}<span
                                                class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="name" type="text" class="form-control col-md-7 col-xs-12" name="name"
                                               value="{{$subject->name}}"
                                               placeholder="{{trans('messages.course_text4')}}"
                                               required="required" type="text">
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                           for="code">{{trans('messages.course_text5')}}<span
                                                class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="code" class="form-control col-md-7 col-xs-12" name="code"
                                               value="{{$subject->code}}" placeholder="DD103" required="required">
                                        <span class="text-danger">{{ $errors->first('code') }}</span>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                           for="credit">{{trans('messages.course_text6')}}
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="price" name="price" required="required"
                                               placeholder="" value="{{$subject->price}}"
                                               class="form-control col-md-7 col-xs-12">
                                        <span class="text-danger">{{ $errors->first('price') }}</span>
                                    </div>
                                </div>


                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                           for="description">{{trans('messages.course_text7')}}
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea id="description" required="required" name="description"
                                                  class="form-control col-md-7 col-xs-12">{{$subject->description}}</textarea>
                                        <span class="text-danger">{{ $errors->first('description') }}</span>
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                           for="points">{{trans('messages.course_text8')}}
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea id="points" required="required" name="points"
                                                  class="form-control col-md-7 col-xs-12">{{$subject->points}}</textarea>
                                        <span class="text-danger">{{ $errors->first('points') }}</span>
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                           for="plans">{{trans('messages.course_text9')}}
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea id="plans" required="required" name="plans"
                                                  class="form-control col-md-7 col-xs-12">{{$subject->plans}}</textarea>
                                        <span class="text-danger">{{ $errors->first('plans') }}</span>
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <button id="send" type="submit" class="btn btn-success"><i class="fa fa-check">
                                                {{trans('messages.button_save')}}</i></button>
                                    </div>
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
