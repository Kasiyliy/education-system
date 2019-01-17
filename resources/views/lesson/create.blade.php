@extends('layouts.master')

@section('title', 'Subject')

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
                    <h2>{{trans('messages.presentation_text1')}}<small> {{trans('messages.presentation_text2')}}</small></h2>

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
                    {!! Form::open(['route' => 'lesson.store', 'method' => 'POST',
                    'enctype' => 'multipart/form-data', 'class' => 'form-horizontal']) !!}
                    {{csrf_field()}}
                    <div class="form-group">
                      <label for="name">{{trans('messages.presentation_text3')}}</label>
                      <input type="text" class="form-control" name="name" id="name" required>
                    </div>
                    <div class="form-group">
                      <label for="description">{{trans('messages.presentation_text4')}}</label>
                      <textarea rows="5" class="form-control" name="description" id="description" required></textarea>
                    </div>
                    <div class="form-group">
                      <label for="description">{{trans('messages.presentation_text5')}}</label>
                      <select name="subject_id" class="form-control">
                        @foreach($subjects as $subject)
                          <option value="{{$subject->id}}">{{$subject->name}}</option>
                        @endforeach
                      </select>
                    </div>
                      <button type = "submit" class = 'btn btn-success'>{{trans('messages.button_create')}}</button>

                  </div>
                </div>
              <!-- row end -->
              <div class="clearfix"></div>

          </div>
        </div>
        <!-- /page content -->
@endsection
@section('extrascript')
<script src="{{ URL::asset('assets/js/validator.min.js')}}"></script>


@endsection
