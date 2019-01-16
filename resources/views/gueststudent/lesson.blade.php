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
            <div class="col-sm-12">
                <div class="container-fluid">
                    <div class="card my-4">
                        <div class="card-header">
                            <span class="text-muted small">урок</span>
                            <p class="text-dark m-0 text-center">{{$lesson->name}}</p>
                            <a class='btn btn-success' href='{{URL::route('student.my.subjects.specific', ['id' =>$lesson->subject->id])}}' >к курсу</a>
                        </div>
                        <div class="container-fluid">
                            <div class="text-center my-2">
                                <a class="btn btn-success btn-sm my-2 float-left" id="btnLeft"><span class="fa fa-arrow-left text-white">Previous</span></a>
                                <span id='countdowntimer' class='text-muted text-center'></span>
                                <a class="btn btn-success btn-sm my-2 float-right" id="btnRight"><span class = "text-white">Next</span><span class="fa fa-arrow-right text-white"></span></a>
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
            var form = "";
            var arrayIds = [];

            var currentLessonPartCheckerId = {{$currentLessonPart->id}};
            var currentLessonPartId = {{$lessonPart->id}};
            var sliderLessonPartId = currentLessonPartId;
            @foreach($otherLessonParts as $oLp)
                constructFrame(
                    "{{$oLp->id}}",
                    "{{$oLp->information}}",
                    "{{$oLp->presentation}}",
                    "{{$oLp->video!= null ? $oLp->video : ""}}",
                    "{{$oLp->audio!= null ? $oLp->audio : ""}}",
                        {{$oLp->seconds}}
                );
            @endforeach

            constructFrame(
                "{{$lessonPart->id}}",
                "{{$lessonPart->information}}",
                "{{$lessonPart->presentation}}",
                "{{$lessonPart->video!= null ? $lessonPart->video : ""}}",
                "{{$lessonPart->audio!= null ? $lessonPart->audio : ""}}",
                {{$lessonPart->seconds}}
            );
            arrayIds.forEach(function(id){
                if(id != currentLessonPartId){
                    var lessonPartFrame = 'lessonPart';
                    var div = document.getElementById(lessonPartFrame + id);
                    div.style.display = 'none';
                }
            });
            $('#btnRight').click(function () {
                var lessonPartFrame = 'lessonPart';
                var index = arrayIds.indexOf(sliderLessonPartId);
                if(index!=arrayIds.length-1){
                    var div = document.getElementById(lessonPartFrame + sliderLessonPartId);
                    div.style.display = 'none';
                    div = document.getElementById(lessonPartFrame + arrayIds[index+1]);
                    div.style.display = 'block';
                    sliderLessonPartId = arrayIds[index+1];
                }
            });

            function checkIfInLimit(){
                return;
                if(arrayIds.indexOf(sliderLessonPartId) == 0){
                    $('#btnLeft').classList.remove('btn-success');
                    $('#btnLeft').classList.add('btn-danger');
                }else{
                    $('#btnLeft').classList.add('btn-success');
                    $('#btnLeft').classList.remove('btn-danger');
                }

                if(arrayIds.indexOf(sliderLessonPartId) == arrayIds.length-1){
                    $('#btnRight').classList.remove('btn-success');
                    $('#btnRight').classList.add('btn-danger');
                }else{
                    $('#btnRight').classList.add('btn-success');
                    $('#btnRight').classList.remove('btn-danger');
                }
            }

            $('#btnLeft').click(function () {
                var lessonPartFrame = 'lessonPart';
                var index = arrayIds.indexOf(sliderLessonPartId);
                if(index!=0){
                    var div = document.getElementById(lessonPartFrame + sliderLessonPartId);
                    div.style.display = 'none';
                    div = document.getElementById(lessonPartFrame + arrayIds[index-1]);
                    div.style.display = 'block';
                    sliderLessonPartId = arrayIds[index-1];
                }
            });

            var url = "/student/lesson_part/next_question/";


            function constructFrame(id,information, presentation, video, audio, timeleft) {
                if(isNaN(timeleft)){
                    timeleft =  parseInt(timeleft);
                }
                arrayIds.push(id);
                var oldSlide = document.getElementById('lessonPart' + currentLessonPartId);
                if(oldSlide !=null){
                    oldSlide.style.display = 'none';
                }
                var form1 ="";
                form1 += "<div id='lessonPart"+id+"'>";

                form1 += "<div class='row'>" +
                    "<div class='col-sm-3'><p class='text-center m-2'>Информация:" + information+"</p></div>" +
                    " <div class='col-sm-9'><div class=\"embed-responsive embed-responsive-16by9\">\n" +
                    "                                <iframe class=\"embed-responsive-item\" id=\"viewer\"\n" +
                    "                                        src=\"/assets/ViewerJS/#/" + presentation + "\" allowfullscreen\n" +
                    "                                        webkitallowfullscreen></iframe>\n" +
                    "                            </div></div>\n" +
                    "</div>"
                     ;

                form1 += "<div class='row'>";
                if (video != null) {
                    if (video.length > 0) {
                        form1 += "                            <div class=\" col-sm-6 card my-1\">\n" +
                            "                                <div class=\"card-body\">\n" +
                            "                                    <video controls  controlsList=\"nodownload\">\n" +
                            "                                        <source src=\"/" + video + "\">\n" +
                            "                                        Your browser does not support the video tag.\n" +
                            "                                    </video>\n" +
                            "                                </div>\n" +
                            "                            </div>\n";
                    }
                }

                if (audio != null) {
                    if (audio.length > 0) {
                        form1 += "                            <div class=\" col-sm-6 card my-1\">\n" +
                            "                                <div class=\"card-body\">\n" +
                            "                                    <audio controls autoplay='autoplay'  controlsList=\"nodownload\">\n" +
                            "                                        <source src=\"/" + audio + "\">\n" +
                            "                                        Your browser does not support the audio tag.\n" +
                            "                                    </audio>\n" +
                            "                                </div>\n" +
                            "                            </div>";
                    }
                }
                form1 +="</div></div>";
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
                            url: url + currentLessonPartCheckerId,
                            dataType: "json",
                        }).done(function (msg) {
                            if (msg.error === false) {
                                if(msg.message.length != 0){
                                    currentLessonPartCheckerId = msg.message.id;
                                    constructFrame(msg.message.lesson_part.id,msg.message.lesson_part.information,msg.message.lesson_part.presentation, msg.message.lesson_part.video, msg.message.lesson_part.audio,msg.message.lesson_part.seconds);
                                }else{
                                    constructEnd();
                                }
                            } else {
                                toastr.error("Возникла ошибка!");

                            }
                        });
                    }
                },1000);
                form += form1;
                $('#lessonPart').append(form1);
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