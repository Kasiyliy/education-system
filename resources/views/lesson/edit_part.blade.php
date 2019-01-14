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
                            <h2>Часть урока
                                <small> добавить</small>
                                <a href="{{URL::route('lesson.show', ['id' => $lessonPart->lesson->id])}}" class="btn btn-info btn-xs">Назад к курсу</a>
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
                            <form action="{{URL::route('lesson-part.update',['id' => $lessonPart->id])}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
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

                            <div class="form-group">
                                <label for="seconds">Секунды</label>
                                <input type="number" min="0" name="seconds" value="{{$lessonPart->seconds}}" id="seconds" required>
                            </div>
                            {!! Form::submit('Изменить', ['class' => 'btn btn-info']) !!}
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
