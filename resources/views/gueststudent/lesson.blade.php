@extends('layouts.guest_student_master')

@section('title', 'ASTCGlobal')
@section('styles')
  <style>
    video {
      width: 100%;
      height: auto;
    }

  </style>
@endsection
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
            <div class="card-body" id="lessonPart">
              <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" id="viewer"
                        src="/assets/ViewerJS/#/{{$lessonPart->presentation}}" allowfullscreen
                        webkitallowfullscreen></iframe>
              </div>
                  @if($lessonPart->video)
                  <div class="card my-1">
                    <div class="card-body">
                      <video  controls>
                        <source src="/{{$lessonPart->video}}" >
                        Your browser does not support the video tag.
                      </video>
                    </div>
                  </div>
                  @endif
                  @if($lessonPart->audio)
                  <div class="card my-1">
                    <div class="card-body">
                      <audio  controls>
                        <source src="/{{$lessonPart->audio}}" >
                        Your browser does not support the audio tag.
                      </audio>
                    </div>
                  </div>
                  @endif

            </div>
            <div class="card-footer">
              <span class="text-muted small">описание</span>
              <p class="text-dark m-0 text-center">{{$lesson->description}}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('scripts')
  <script src="{{ URL::asset('assets/js/validator.min.js')}}"></script>
  <script>
    $(document).ready(function () {
        var currentQuestionId = {{$currentLessonPart->id}};
        var url ="/lesson_part/next_question/";
        if(false){
            $.ajax({
                method: "GET",
                url: url + currentQuestionId,
                dataType: "json",
            }).done(function( msg ) {
                if(msg.error == 0){
                    currentQuestionId = msg.message.id;
                    $('#lessonPart').html('');

                }else{
                    toastr.error("Возникла ошибка!");
                }
            });
        }
    });
  </script>
@endsection