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
                        <li class="list-group-item text-muted"><span class="fa fa-user"></span> {{Auth::user()->login}}
                            <i class="fa fa-dashboard fa-1x"></i></li>
                        <li class="list-group-item"><span class="fa fa-envelope"></span> {{Auth::user()->email}}</li>
                        <li class="list-group-item"><span
                                    class="fa fa-address-book"></span> {{Auth::user()->student->firstName.' '.Auth::user()->student->lastName }}
                        </li>
                        <li class="list-group-item"><span
                                    class="fa fa-calendar-alt"></span> {{substr(Auth::user()->student->dob,0,10)}}</li>
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

                        </div>
                        <button id="nextButton">Next</button>
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
            var currentLessonPartId = {{$currentLessonPart->id}};

            constructFrame("{{$lessonPart->presentation}}" ,
                "{{$lessonPart->video!= null ? $lessonPart->video : ""}}",
                "{{$lessonPart->audio!= null ? $lessonPart->audio : ""}}");

            var url = "/student/lesson_part/next_question/";

            $('#nextButton').on('click', function(){
                $.ajax({
                    method: "GET",
                    url: url + currentLessonPartId,
                    dataType: "json",
                }).done(function (msg) {
                    if (msg.error === false) {
                        currentLessonPartId = msg.message.id;
                        constructFrame(msg.message.lesson_part.presentation, msg.message.lesson_part.video , msg.message.lesson_part.audio);
                    } else {
                        toastr.error("Возникла ошибка!");
                    }
                });
            });


            function constructFrame(presentation, video, audio) {
                var form = "<div class=\"embed-responsive embed-responsive-16by9\">\n" +
                    "                                <iframe class=\"embed-responsive-item\" id=\"viewer\"\n" +
                    "                                        src=\"/assets/ViewerJS/#/" +presentation+ "\" allowfullscreen\n" +
                    "                                        webkitallowfullscreen></iframe>\n" +
                    "                            </div>\n";

                if(video != null){
                if(video.length > 0){
                        form+= "                            <div class=\"card my-1\">\n" +
                        "                                <div class=\"card-body\">\n" +
                        "                                    <video controls>\n" +
                        "                                        <source src=\"/"+video+"\">\n" +
                        "                                        Your browser does not support the video tag.\n" +
                        "                                    </video>\n" +
                        "                                </div>\n" +
                        "                            </div>\n" ;
                    }
                    }
                    if(audio != null){
                    if(audio.length > 0){
                        form+= "                            <div class=\"card my-1\">\n" +
                    "                                <div class=\"card-body\">\n" +
                    "                                    <audio controls>\n" +
                    "                                        <source src=\"/"+audio+"\">\n" +
                    "                                        Your browser does not support the audio tag.\n" +
                    "                                    </audio>\n" +
                    "                                </div>\n" +
                    "                            </div>";
                    }
                    }
                $('#lessonPart').html(form);
            }
        });
    </script>
@endsection