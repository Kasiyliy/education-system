@extends('layouts.master')

@section("title", "Вопросы | изменить")
@section('extrastyle')
    <link href="{{ URL::asset('assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/sweetalert.css')}}" rel="stylesheet">

@endsection
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
                            <h2>Варианты вопросов теста</h2>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content mx-auto">

                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <strong>Ошибка!</strong> Ваши введенные данные не прошли валидацию!<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                                {{ Form::open(array('url' => URL::route('question.update',['id' => $question->id]),
                                'method' => 'PUT', 'class'=>'form-horizontal', 'id' => 'myForm')) }}
                                <div class="row mx-auto" id="questions">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label for="question">Вопрос</label>
                                        <textarea required rows="5" id="question" name="value"class="form-control">{{$question->value}}</textarea>
                                    </div>
                                    <div id="variants">
                                        @php
                                            $i = 0;
                                        @endphp

                                        @foreach($question->answers()->get() as $answer)
                                            <div class="form-group">
                                                <div class="checkbox">
                                                    <label><input type="checkbox"
                                                                  @if($answer->right)
                                                                    checked
                                                                  @endif
                                                                  name="variantCBs[{{$i}}]">Правильно</label>
                                                </div>
                                                <input type="text" placeholder="Вариант ответа" name="variants[{{$i}}]"
                                                       class="form-control" value="{{$answer->value}}" required=""><a
                                                        class="btn btn-danger btn-xs pull-right mybutton"
                                                        style="margin-top: 5px;">X</a></div>
                                            @php
                                                $i++;
                                            @endphp
                                        @endforeach
                                    </div>
                                    <a class="btn btn-default" id="addVariant">Добавить вариант</a>
                                </div>
                                <button type="submit" id="addQuestion" class="btn btn-primary pull-right">Сохранить
                                    изменения в вопросе
                                </button>
                            {{ Form::close() }}
                        </div>

                    </div>
                </div>
            </div>
            <!-- row end -->
            <div class="clearfix"></div>

        </div>
    </div>
    <!-- /page content -->

    <!-- Modal For Attendance Update -->
@endsection
@section('extrascript')
    <!-- dataTables -->
    <script src="{{ URL::asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/buttons.bootstrap.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/buttons.flash.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/buttons.html5.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/buttons.print.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/jszip.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/pdfmake.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/vfs_fonts.js')}}"></script>
    <script src="{{ URL::asset('assets/js/select2.full.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/validator.min.js')}}"></script>
    <script>
        $(document).ready(function () {

            var buttons = $('.mybutton');

            for(var i = 0; i < buttons.length; i++){
                buttons[i].addEventListener('click', function(){
                    this.parentNode.parentNode.removeChild(this.parentNode);
                })
            }

            var inputCounter = buttons.length;
            var variants = $('#variants');

            var addVariantBtn = $('#addVariant');
            addVariantBtn.on('click', function () {

                var innerDiv = document.createElement('div');
                innerDiv.className = 'form-group';

                var checkBoxDiv = document.createElement('div');
                checkBoxDiv.className = 'checkbox';

                var checkBoxLbl = document.createElement('label');

                var checkBoxInput = document.createElement('input');
                checkBoxInput.type = 'checkbox';
                checkBoxInput.name = 'variantCBs[' + inputCounter + ']';
                checkBoxLbl.append(checkBoxInput);
                checkBoxLbl.innerHTML += 'Правильно';

                var textInput = document.createElement('input');
                textInput.type = 'text';
                textInput.placeholder = 'Вариант ответа';
                textInput.name = 'variants[' + inputCounter + ']';
                textInput.className = 'form-control';
                textInput.required = true;


                var deleteBtn = document.createElement('a');
                deleteBtn.className = 'btn btn-danger btn-xs pull-right';
                deleteBtn.style.marginTop = '5px';
                deleteBtn.innerText = 'X';
                deleteBtn.addEventListener('click', function () {
                    if (innerDiv) {
                        innerDiv.parentNode.removeChild(innerDiv);
                    }
                });
                inputCounter++;
                checkBoxDiv.append(checkBoxLbl);
                innerDiv.append(checkBoxDiv);
                innerDiv.append(textInput);
                innerDiv.append(deleteBtn);

                variants.append(innerDiv);
            });

            var myForm = $('#myForm');
            myForm.on('submit', function (event) {

                if ($("input[type='checkbox']").length < 1) {
                    new PNotify({
                        title: 'Ошибка',
                        text: 'Добавьте хотя бы 1 вопрос',
                        type: 'error',
                        styling: 'bootstrap3'
                    });
                    event.preventDefault();
                } else {
                    if ($("input[type='checkbox']:checked").length == 0) {
                        new PNotify({
                            title: 'Ошибка',
                            text: 'Добавьте хотя бы 1 правильный ответ!',
                            type: 'error',
                            styling: 'bootstrap3'
                        });
                        event.preventDefault();
                    }
                }
            });
        });
    </script>

@endsection
