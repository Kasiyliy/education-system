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
                            <h2>{{trans('messages.presentation_text17')}}
                                <small> {{trans('messages.presentation_text18')}}</small>
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
                                    <h2>{{trans('messages.presentation_text6')}}
                                    </h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    {!! Form::open(['route' => 'lesson-part.store', 'method' => 'POST',
                                    'enctype' => 'multipart/form-data', 'class' => 'form-horizontal']) !!}
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label for="presentation">{{trans('messages.presentation_text7')}}</label>
                                        <input type="file" class="form-control" id="presentation" name="presentation"
                                               required>
                                    </div>
                                    <div class="form-group">
                                        <label for="audio">{{trans('messages.presentation_text8')}}</label>
                                        <input type="file" class="form-control" id="audio" name="audio">
                                    </div>
                                    <div class="form-group">
                                        <label for="video">{{trans('messages.presentation_text9')}}</label>
                                        <input type="file" class="form-control" id="video" name="video">
                                    </div>
                                    <input type="hidden" name="lesson_id" value="{{$lesson->id}}">
                                    <div class="form-group">
                                        <label for="seconds">{{trans('messages.presentation_text10')}}</label>
                                        <input type="number" min="0" name="seconds" id="seconds" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="information">{{trans('messages.presentation_text11')}}</label>
                                        <textarea class="form-control" name="information" id="information"
                                                  required></textarea>
                                    </div>
                                    <button type="submit"
                                            class="btn btn-success">{{trans('messages.button_create')}}</button>
                                </div>
                            </div>

                            <div class="panel-group" id="accordion">
                                @foreach($lesson->lessonParts as $lessonPart)
                                    <div class="panel panel-default">

                                        <a data-toggle="collapse" data-parent="#accordion"
                                           href="#collapse{{$lessonPart->id}}">
                                            <div class="panel-heading">

                                                <h4 class="panel-title">
                                                    ID:{{$lessonPart->id}}
                                                </h4>
                                            </div>
                                        </a>
                                        <div id="collapse{{$lessonPart->id}}"
                                             class="panel-collapse collapse text-center">
                                            <div class="panel-body">

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="m-2">

                                                            <div class="embed-responsive embed-responsive-16by9">
                                                                <embed src="/{{$lessonPart->presentation}}"
                                                                       class="embed-responsive-item"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        @if($lessonPart->audio)
                                                            <div class="card my-1">
                                                                <div class="card-body  my-2">
                                                                    <p>{{trans('messages.presentation_text8')}}: <span
                                                                                class="glyphicon glyphicon-music "></span>
                                                                    </p>
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
                                                                    <p>{{trans('messages.presentation_text9')}}: <span
                                                                                class="glyphicon glyphicon-facetime-video "></span>
                                                                    </p>
                                                                    <video controls style="width: 100%;">
                                                                        <source src="/{{$lessonPart->video}}">
                                                                        Your browser does not support the video tag.
                                                                    </video>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="col-sm-12 text-center">
                                                        <form action="{{URL::route('lesson-part.destroy' ,['id' => $lessonPart->id] )}}"
                                                              method="post">
                                                            {{csrf_field()}}
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <a type="submit"
                                                                       class="btn btn-warning form-control"
                                                                       href="{{URL::route('lesson-part.edit', ['id' => $lessonPart->id])}}">{{trans('messages.button_change')}}</a>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <button type="submit"
                                                                            class="btn btn-danger form-control">{{trans('messages.button_delete')}}</button>
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