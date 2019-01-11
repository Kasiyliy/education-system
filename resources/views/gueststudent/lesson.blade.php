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
                        <div class="container-fluid">
                            <div class="text-center">
                                <a class="btn btn-success btn-sm my-2 float-left" id="btnLeft"><span class="fa fa-arrow-left text-white"></span></a>
                                <span id='countdowntimer' class='text-muted text-center'></span>
                                <a class="btn btn-success btn-sm my-2 float-right" id="btnRight"><span class="fa fa-arrow-right text-white"></span></a>
                            </div>
                            <div class="col-sm-12">
                                <div class="card-body" id="lessonPart">

                                </div>
                            </div>

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

            $('#btnRight').click(function () {
                alert('Right');
            });
            $('#btnLeft').click(function () {
                alert('Left');
            });
            var currentLessonPartId = {{$currentLessonPart->id}};

            constructFrame("{{$lessonPart->presentation}}",
                "{{$lessonPart->video!= null ? $lessonPart->video : ""}}",
                "{{$lessonPart->audio!= null ? $lessonPart->audio : ""}}",
                {{$lessonPart->seconds}}
            );

            var url = "/student/lesson_part/next_question/";


            function constructFrame(presentation, video, audio, timeleft) {
                if(isNaN(timeleft)){
                    timeleft =  parseInt(timeleft);
                }

                var form = "";

                if (audio != null) {
                    if (audio.length > 0) {
                        form += "                            <div class=\"card my-1\">\n" +
                            "                                <div class=\"card-body\">\n" +
                            "                                    <audio controls autoplay='autoplay'>\n" +
                            "                                        <source src=\"/" + audio + "\">\n" +
                            "                                        Your browser does not support the audio tag.\n" +
                            "                                    </audio>\n" +
                            "                                </div>\n" +
                            "                            </div>";
                    }
                }

                form += "<div class=\"embed-responsive embed-responsive-16by9\">\n" +
                    "                                <iframe class=\"embed-responsive-item\" id=\"viewer\"\n" +
                    "                                        src=\"/assets/ViewerJS/#/" + presentation + "\" allowfullscreen\n" +
                    "                                        webkitallowfullscreen></iframe>\n" +
                    "                            </div>\n";

                if (video != null) {
                    if (video.length > 0) {
                        form += "                            <div class=\"card my-1\">\n" +
                            "                                <div class=\"card-body\">\n" +
                            "                                    <video controls>\n" +
                            "                                        <source src=\"/" + video + "\">\n" +
                            "                                        Your browser does not support the video tag.\n" +
                            "                                    </video>\n" +
                            "                                </div>\n" +
                            "                            </div>\n";
                    }
                }

                var downloadTimer = setInterval(function(){
                    timeleft--;
                    document.getElementById("countdowntimer").textContent = timeleft;
                    if(timeleft <= 30){
                        document.getElementById("countdowntimer").className = 'text-danger text-center'
                    }
                    if(timeleft==30){
                        toastr.warning("Осталось меньше 30 секунд!");
                    }
                    if(timeleft==15){
                        toastr.warning("Осталось меньше 15 секунд!");
                    }
                    if(timeleft <= 0)
                    {
                        clearInterval(downloadTimer);
                        $.ajax({
                            method: "GET",
                            url: url + currentLessonPartId,
                            dataType: "json",
                        }).done(function (msg) {
                            if (msg.error === false) {
                                if(msg.message.length != 0){
                                    currentLessonPartId = msg.message.id;
                                    constructFrame(msg.message.lesson_part.presentation, msg.message.lesson_part.video, msg.message.lesson_part.audio,msg.message.lesson_part.seconds);
                                }else{
                                    constructEnd();
                                }
                            } else {
                                toastr.error("Возникла ошибка!");

                            }
                        });
                    }
                },1000);
                $('#lessonPart').html(form);
            }

            function constructEnd(){
                var lastFrame  = "<div class='jumbotron'> " +
                    "<p class='text-center'>Ваш урок окончен! Просим вас перейти по ссылке <a class='btn btn-success' href='{{URL::route('student.my.subjects.specific', ['id' =>$lesson->subject->id])}}' >к курсу</a></p>" +
                    "</div>";
                $('#lessonPart').html(lastFrame);
            }
        });
    </script>
@endsection