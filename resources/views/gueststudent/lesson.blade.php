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
                            <p class="text-dark m-0 text-center">{{$lesson->name}}</p>
                            <a class='btn btn-success' href='{{URL::route('student.my.subjects.specific', ['id' =>$lesson->subject->id])}}' >{{trans('messages.go_course')}}</a>
                        </div>
                        <div class="container-fluid">
                            <div class="text-center my-2">
                                <p class="text-muted text-center" id="slideOutOf"></p>
                                <a class="btn btn-success btn-sm my-2 float-left" id="btnLeft"><span class="fa fa-arrow-left text-white">{{trans('messages.previous')}}</span></a>
                                <span id='countdowntimer' class='text-muted text-center'></span>
                                <a class="btn btn-success btn-sm my-2 float-right" id="btnRight"><span class = "text-white">{{trans('messages.next')}}</span><span class="fa fa-arrow-right text-white"></span></a>
                            </div>
                            <div class="col-sm-12">
                                <div class="card-body" id="lessonPart">

                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <span class="text-muted small">{{trans('messages.description')}}</span>
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


        var form = "";
        var arrayIds = [];

        var currentLessonPartCheckerId = `{{$currentLessonPart->id}}`;
        var currentLessonPartId = `{{$lessonPart->id}}`;
        var sliderLessonPartId = currentLessonPartId;



        function clear(){
            for(var i = 0 ; i < arrayIds.length; i++){
                var oldSlide = document.getElementById('lessonPart' + arrayIds[i]);
                if(oldSlide !=null){
                    oldSlide.style.display = 'none';
                }
            }
        }

        $(document).ready(function () {
            @foreach($otherLessonParts as $oLp)
                constructFrame(
                    `{{$oLp->id}}`,
                    `{{$oLp->information}}`,
                    `{{$oLp->presentation}}`,
                    `{{$oLp->video!= null ? $oLp->video : ""}}`,
                    `{{$oLp->audio!= null ? $oLp->audio : ""}}`,
                    `{{$oLp->seconds}}`,
                false
                );
            @endforeach

            constructFrame(
                "{{$lessonPart->id}}",
                `{{$lessonPart->information}}`,
                `{{$lessonPart->presentation}}`,
                `{{$lessonPart->video!= null ? $lessonPart->video : ""}}`,
                `{{$lessonPart->audio!= null ? $lessonPart->audio : ""}}`,
                {{$lessonPart->seconds}}
            );
            arrayIds.forEach(function(id){
                if(id != currentLessonPartId){
                    var lessonPartFrame = 'lessonPart';
                    var div = document.getElementById(lessonPartFrame + id);
                    div.style.display = 'none';
                }
            });
            $('#btnLeft').click(function () {

                var lessonPartFrame = 'lessonPart';
                var index = arrayIds.indexOf(sliderLessonPartId);
                if(index>0){
                    pauseAll();
                    clear();
                    var div = document.getElementById(lessonPartFrame + sliderLessonPartId);
                    div.style.display = 'none';
                    div = document.getElementById(lessonPartFrame + arrayIds[index-1]);
                    div.removeAttribute('style');
                    sliderLessonPartId = arrayIds[index-1];
                }
                checkSliderSituation();
            });

            $('#btnRight').click(function () {

                var lessonPartFrame = 'lessonPart';
                var index = arrayIds.indexOf(sliderLessonPartId);

                if(index<arrayIds.length-1){
                    pauseAll();
                    clear();
                    var div = document.getElementById(lessonPartFrame + sliderLessonPartId);
                    div.style.display = 'none';
                    div = document.getElementById(lessonPartFrame + arrayIds[index+1]);
                    div.removeAttribute('style');
                    sliderLessonPartId = arrayIds[index+1];
                }
                checkSliderSituation();
            });


            function checkSliderSituation(){
                $('slideOutOf').html((arrayIds.indexOf(sliderLessonPartId) + 1) + '/'+ arrayIds.length );
            }

            var url = "/student/lesson_part/next_question/";


            function constructFrame(id,information, presentation, video, audio, timeleft , checker = true) {
                if(isNaN(timeleft)){
                    timeleft =  parseInt(timeleft);
                }
                arrayIds.push(id);
                var oldSlide = document.getElementById('lessonPart' + currentLessonPartId);
                if(oldSlide !=null){
                    oldSlide.style.display = 'none';
                }

                currentLessonPartId = id;
                sliderLessonPartId = id;
                var form1 ="";
                form1 += "<div class='row' id='lessonPart"+id+"'>";

                form1 += "<div class='col-sm-8'><div class='row'>";

                form1 +=   " <div class='col-sm-12'><div class=\"embed-responsive embed-responsive-16by9\">\n" +
                    "                                <img class=\"embed-responsive-item\" id=\"viewer\"\n" +
                    "                                        src=\"/" + presentation + "\" allowfullscreen\n" +
                    "                                        webkitallowfullscreen></img>\n" +
                    "                            </div></div>\n" ;



                form1 += "                            <div class=\" col-sm-12 card my-1\">\n" +
                    "                                <div class=\"card-body\">\n" +
                    "                                    <audio controls " + (!checker ? "" :"autoplay='autoplay'") + " controlsList=\"nodownload\">\n" +
                    "                                        <source src=\"/" + audio + "\">\n" +
                    "                                        Your browser does not support the audio tag.\n" +
                    "                                    </audio>\n" +
                    "                                </div>\n" +
                    "                            </div>";

                form1 += "</div></div>";

                form1 += "<div class='col-sm-4'><div class='row'>";

                if(video!=null){
                    if(video.length > 0){
                        form1 += "  <div class=\" col-sm-12 card my-1\">\n" +
                            "                                <div class=\"card-body\">\n" +
                            "                                    <video  controls " + (!checker ? "" :"autoplay='autoplay'") + "   controlsList=\"nodownload\">\n" +
                            "                                        <source src=\"/" + video + "\">\n" +
                            "                                        Your browser does not support the video tag.\n" +
                            "                                    </video>\n" +
                            "                                </div>\n" +
                            "                            </div>\n";
                    }
                }

                form1 +=
                    "<div class='col-sm-12' style='max-height:300px; overflow-y:scroll'><p class='text-center m-2'>`" + information+"`</p></div>" ;

                form1 += "</div></div>";

                form1 +="</div>";
                if(checker){
                    var downloadTimer = setInterval(function(){
                        if(sliderLessonPartId == currentLessonPartId){
                            timeleft--;
                        }
                        document.getElementById("countdowntimer").textContent = timeleft;
                        if(timeleft <= 30){
                            document.getElementById("countdowntimer").className = 'text-danger text-center'
                        }
                        if(timeleft==30){
                            toastr.warning(`{{trans('messages.30_second')}}`);
                        }
                        if(timeleft==15){
                            toastr.warning(`{{trans('messages.15_second')}}`);
                        }
                        if(timeleft <= 0)
                        {

                            pauseAll();

                            clearInterval(downloadTimer);
                            $.ajax({
                                method: "GET",
                                url: url + currentLessonPartCheckerId,
                                dataType: "json",
                            }).done(function (msg) {
                                if (msg.error === false) {
                                    if(msg.message.length != 0){
                                        currentLessonPartCheckerId = msg.message.id;
                                        clear();
                                        constructFrame(msg.message.lesson_part.id,msg.message.lesson_part.information,msg.message.lesson_part.presentation, msg.message.lesson_part.video, msg.message.lesson_part.audio,msg.message.lesson_part.seconds);
                                    }else{
                                        constructEnd();
                                    }
                                } else {
                                    toastr.error(`{{trans('messages.have_error')}}`);

                                }
                            });
                        }
                    },1000);
                }
                form = form +form1 ;
                $('#lessonPart').append(form1);
                checkSliderSituation();
            }

            function pauseAudio(){
                var sounds = document.getElementsByTagName('audio');
                for(i=0; i<sounds.length; i++) {
                    if(!sounds[i].paused){
                        sounds[i].pause();
                    }
                }
            }

            function pauseVideo(){
                var videos = document.getElementsByTagName('video');
                for(i=0; i<videos.length; i++) {
                    if(!videos[i].paused){
                        videos[i].pause();
                    }
                }
            }

            function pauseAll(){
                pauseAudio();
                pauseVideo();
            }

            function constructEnd(){
                var lastFrame  = "<div class='jumbotron' id='lastFrame'> " +
                    "<p class='text-center'>'`{{trans('messages.your_lesson_finish')}}`' <a class='btn btn-success' href='{{URL::route('student.my.subjects.specific', ['id' =>$lesson->subject->id])}}' >'`{{trans('messages.go_course')}}`'</a></p>" +
                    "</div>";

                $('#lessonPart').html(lastFrame);
                $('#btnRight').removeClass('btn-success');
                $('#btnRight').addClass('btn-danger');
                $('#btnLeft').removeClass('btn-success');
                $('#btnLeft').addClass('btn-danger');
            }
        });
    </script>
@endsection