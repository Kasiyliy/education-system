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
                            {!! Form::submit('Добавить', ['class' => 'btn btn-info']) !!}
                            {!! Form::close() !!}
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
