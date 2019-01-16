@extends('layouts.master')

@section('title', 'Subject')

@section('content')

    <div class="right_col" role="main">
        <div class="">

            <div class="clearfix"></div>
            <!-- row start -->
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Урок
                                <small> посмотреть</small>
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

                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Часть урока
                                            <small> добавить</small>
                                        </h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        {!! Form::open(['route' => 'lesson-part.store', 'method' => 'POST',
                                        'enctype' => 'multipart/form-data', 'class' => 'form-horizontal']) !!}
                                        {{csrf_field()}}
                                        <div class="form-group">
                                            <label for="presentation">Презентация (1-стр pdf)</label>
                                            <input type="file" class="form-control" id="presentation" name="presentation" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="audio">Аудио</label>
                                            <input type="file" class="form-control" id="audio" name="audio">
                                        </div>
                                        <div class="form-group">
                                            <label for="video">Видео</label>
                                            <input type="file" class="form-control" id="video" name="video">
                                        </div>
                                        <input type="hidden" name="lesson_id" value="{{$lesson->id}}">
                                        <div class="form-group">
                                            <label for="seconds">Секунды</label>
                                            <input type="number" min="0" name="seconds" id="seconds" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="information">Информация</label>
                                            <textarea  class="form-control" name="information" id="information" required></textarea>
                                        </div>
                                        {!! Form::submit('Добавить', ['class' => 'btn btn-info']) !!}
                                        {!! Form::close() !!}
                                    </div>
                                </div>

                            <div class="panel-group" id="accordion">
                                @foreach($lesson->lessonParts as $lessonPart)
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion"
                                                   href="#collapse{{$lessonPart->id}}">
                                                    ID:{{$lessonPart->id}}</a>
                                            </h4>
                                        </div>
                                        <div id="collapse{{$lessonPart->id}}" class="panel-collapse collapse text-center">
                                            <div class="panel-body">

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="m-2">

                                                            <div class="embed-responsive embed-responsive-16by9">
                                                                <embed src="/{{$lessonPart->presentation}}" class="embed-responsive-item" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        @if($lessonPart->audio)
                                                            <div class="card my-1">
                                                                <div class="card-body  my-2">
                                                                    <p>Аудио: <span class="glyphicon glyphicon-music "></span></p>
                                                                    <audio controls>
                                                                        <source src="/{{$lessonPart->audio}}">
                                                                        Your browser does not support the audio tag.
                                                                    </audio>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if($lessonPart->video)
                                                            <div class="card m-2">
                                                                <div class="card-body">
                                                                    <p>Видео: <span class="glyphicon glyphicon-facetime-video "></span></p>
                                                                    <video controls style="width: 100%;">
                                                                        <source src="/{{$lessonPart->video}}">
                                                                        Your browser does not support the video tag.
                                                                    </video>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="col-sm-12 text-center">
                                                        <form action="{{URL::route('lesson-part.destroy' ,['id' => $lessonPart->id] )}}" method="post">
                                                            {{csrf_field()}}
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <a type="submit" class="btn btn-warning form-control" href="{{URL::route('lesson-part.edit', ['id' => $lessonPart->id])}}" >Изменить</a>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <button type="submit" class="btn btn-danger form-control" >Удалить</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

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

                <script>
                    $('#iframe').ready(function () {
                        setTimeout(function () {
                            $('#iframe').contents().find('#download').remove();
                        }, 100);
                    });
                </script>

            @endsection
        </div>
    </div>