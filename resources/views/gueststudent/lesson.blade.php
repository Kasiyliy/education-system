@extends('layouts.guest_student_master')

@section('title', 'ASTCGlobal')

@section('content')

  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-3">
        <div class="card m-2 my-4">
          <div class="card-header text-center">
            Профиль
          </div>
          <ul class="list-group">
            <li class="list-group-item text-muted"><span class="fa fa-user"></span> {{Auth::user()->login}} <i class="fa fa-dashboard fa-1x"></i></li>
            <li class="list-group-item"><span class="fa fa-envelope"></span> {{Auth::user()->email}}</li>
            <li class="list-group-item"><span class="fa fa-address-book"></span> {{Auth::user()->student->firstName.' '.Auth::user()->student->lastName }}</li>
            <li class="list-group-item"><span class="fa fa-calendar-alt"></span> {{substr(Auth::user()->student->dob,0,10)}}</li>
          </ul>
        </div>
      </div>
      <div class="col-sm-9">
        <div class="container-fluid">
          <div class="card my-4">
            <div class="card-header">
              <span class="text-muted small">урок</span>
              <p class="text-dark m-0 text-center">{{$lesson->name}}</p>
            </div>
            <div class="card-body">
              <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" id="viewer"
                        src="/assets/ViewerJS/#/{{$lesson->presentation}}" allowfullscreen
                        webkitallowfullscreen></iframe>
                {{--<embed class="embed-responsive-item"--}}
                {{--src="{{URL::to('/').'/'.$lesson->presentation }}"--}}
                {{--frameborder="0"></embed>--}}
                <iframe src='https://view.officeapps.live.com/op/embed.aspx?src={{URL::to('/') .'/'.$lesson->presentation}}'
                        width='100%' height='600px' frameborder='0'/>

              </div>
            </div>
            <div class="card-footer">
              <span class="text-muted small">описание</span>
              <p class="text-dark m-0 text-center">{{$lesson->description}}</p>
            </div>
          </div>
        </div>
        <div class="content">



        </div>
      </div>
    </div>
  </div>

@endsection

@section('scripts')
  <script src="{{ URL::asset('assets/js/validator.min.js')}}"></script>

  <script>
      $('#iframe').ready(function() {
          setTimeout(function() {
              $('#iframe').contents().find('#download').remove();
          }, 100);
      });
  </script>
@endsection