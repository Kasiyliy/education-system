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
                            <h2>{{trans('messages.presentation_text6')}}
                                <a href="{{URL::route('lesson.show', ['id' => $lessonPart->lesson->id])}}"
                                   class="btn btn-success btn-xs">{{trans('messages.presentation_text19')}}</a>
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

                            <form action="{{URL::route('lesson-part.updatePresentation',['id' => $lessonPart->id])}}" method="POST"
                                  class="form-horizontal" enctype="multipart/form-data">
                                {{csrf_field()}}

                                <div class="row">
                                    <div class="col-sm-6 m-1">
                                        <div class="form-group">
                                            <label for="presentation">{{trans('messages.presentation_text7')}}(jpg, jpeg, png,
                                                mp4(video))</label>
                                            <input type="file" class="form-control" id="presentation" name="presentation"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 m-1">
                                        <div>
                                            <embed style="width: 100%" src="/{{$lessonPart->presentation}}"
                                                   class="embed-responsive-item"/>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit"
                                        class="btn btn-success">{{trans('messages.button_change')}}</button>
                            </form>

                            <form action="{{URL::route('lesson-part.updateAudio',['id' => $lessonPart->id])}}" method="POST"
                                  class="form-horizontal" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="audio">{{trans('messages.presentation_text8')}}(mpga, wav, mp3)</label>
                                            <input type="file" class="form-control" id="audio" name="audio">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <audio controls>
                                            <source src="/{{$lessonPart->audio}}">
                                            Your browser does not support the audio tag.
                                        </audio>
                                    </div>
                                </div>

                                <button type="submit"
                                        class="btn btn-success">{{trans('messages.button_change')}}</button>
                            </form>

                            <form action="{{URL::route('lesson-part.updateVideo',['id' => $lessonPart->id])}}" method="POST"
                                  class="form-horizontal" enctype="multipart/form-data">
                                {{csrf_field()}}

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="video">{{trans('messages.presentation_text9')}}(mp4, mov, avi,
                                                wmv)</label>
                                            <input type="file" class="form-control" id="video" name="video">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <video controls style="width: 100%;">
                                            <source src="/{{$lessonPart->video}}">
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>
                                </div>

                                <button type="submit"
                                        class="btn btn-success">{{trans('messages.button_change')}}</button>
                            </form>

                            <form action="{{URL::route('lesson-part.updateInfoAndSec',['id' => $lessonPart->id])}}" method="POST"
                                  class="form-horizontal">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="seconds">{{trans('messages.presentation_text10')}}</label>
                                    <input type="number" min="0" name="seconds" value="{{$lessonPart->seconds}}"
                                           id="seconds" required>
                                </div>
                                <div class="form-group">
                                    <label for="information">{{trans('messages.presentation_text11')}}</label>
                                    <textarea class="form-control" name="information" id="information"
                                              >{{$lessonPart->information}}</textarea>
                                </div>
                                <button type="submit"
                                        class="btn btn-success">{{trans('messages.button_change')}}</button>
                            </form>
                        </div>
                    </div>
                    <!-- row end -->
                    <div class="clearfix"></div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('extrascript')
    <script src="{{ URL::asset('assets/js/validator.min.js')}}"></script>

@endsection
