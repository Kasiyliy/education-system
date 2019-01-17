@extends('layouts.master')

@section('title', 'Тесты | изменить')

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
                            <h2>
                                {{trans('messages.test_text1')}} "{{$quiz->name}}"
                                <small>
                                    {{trans('messages.test_text6')}}</small>
                            </h2>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <strong>Упс!</strong> Возникли ошибки!<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            {!! Form::open(['route' => ['quiz.update',$quiz->id], 'method' => 'PUT']) !!}

                            <div class="form-group">

                                {{trans('messages.test_text2')}}
                                <span class="required">*</span>
                                {!! Form::text('name', $quiz->name, ['class' => 'form-control' , 'required' => true ]) !!}
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            </div>

                            <div class="form-group">

                                {{trans('messages.test_text5')}}
                                <span class="required">*</span>
                                {!! Form::textarea('description', $quiz->description, ['class' => 'form-control', 'required' => true ]) !!}
                                <span class="text-danger">{{ $errors->first('description') }}</span>
                            </div>
                            <div class="form-group">

                                <div class="item form-group">
                                    <label class="control-label" for="subject_id">
                                        {{trans('messages.test_text4')}} <span
                                                class="required">*</span>
                                    </label>

                                    {!!Form::select('subject_id',$subjects, $quiz->subject_id, ['placeholder' => 'Pick a Subject','class'=>'select2_single subject form-control has-feedback-left','required'=>'required' ,'id'=>'subject_id'])!!}
                                    <span class="text-danger">{{ $errors->first('subject_id') }}</span>

                                </div>

                            </div>

                            <button type='submit' placeholder=''
                                    class='btn btn-success'>{{trans('messages.test_text6')}}</button>

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
@endsection
