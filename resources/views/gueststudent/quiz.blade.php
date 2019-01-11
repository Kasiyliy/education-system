@extends('layouts.guest_student_master')

@section('title', 'ASTCGlobal')

@section('content')

  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-3">
        <div class="card m-2 my-4">
          <div class="card-header text-center">
            Профиль
          </div>
          <ul class="list-group">
            <li class="list-group-item text-muted"><span class="fa fa-user"></span> {{Auth::user()->login}} <i class="fa fa-dashboard fa-1x"></i></li>
            <li class="list-group-item"><span class="fa fa-envelope"></span> {{Auth::user()->email}}</li>
            <li class="list-group-item"><span class="fa fa-address-book"></span> {{Auth::user()->student->firstName.' '.Auth::user()->student->lastName }}</li>
            <li class="list-group-item"><span class="fa fa-calendar-alt"></span> {{substr(Auth::user()->student->dob,0,10)}}</li>
          </ul>
        </div>
      </div>
      <div class="col-sm-9">
        <div class="container-fluid">
          <div class="card my-4">
            <div class="card-header">
              <span class="text-muted small">Наименование:</span>
              <p class="text-dark m-0 text-center">{{$quiz->name}}</p>
            </div>
            <div class="card-body text-center">

              <div id="quizContent" class="center-margin">
                <ul class="list-group my-5">
                  <li class="list-group-item">Курс: {{$quiz->subject->department->name}}</li>
                  <li class="list-group-item">Под курс: {{$quiz->subject->name}}</li>
                  <li class="list-group-item">Вопросов: {{$quiz->questions->count()}}</li>
                  <li class="list-group-item">Дата начала: {{date('Y-m-d')}}</li>
                </ul>
              </div>
              <div id="buttons" class="center-margin">
                @if(!isset($quizResult))
                      <a id="startButton" class="btn btn-primary text-white ">Начать</a>
                @else
                    <p class="text-danger">Тест уже пройден!</p>
                    <p class="
                            @if($quizResult->percentage>=50)
                            text-success
                            @else
                            text-danger
                            @endif
                            "
                    >Ваш оценка - {{$quizResult->percentage}}</p>
                @endif
                <a id="finishButton" class="btn btn-success text-white d-none">Закончить</a>
              </div>
              <div>
                <a id="nextButton" class="btn btn-success d-none text-white">
                  Следующее
                </a>
              </div>
            </div>
            <div class="card-footer">
              <span class="text-muted small">Описание:</span>
              <p class="text-dark m-0 text-center">{{$quiz->description}}</p>
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
    var currentQuestionId = 0;
    var results = [];
    var questionIndex = 0;
    var quiz = [
        @foreach($quiz->questions as  $question)
        {
            id : "{{$question->id}}",
            question : "{{$question->value}}",
            answers : [
            @for($i = 0 ;  $i < $question->answers->count(); $i++ )
            {
                    id: {{$question->answers[$i]->id}} ,
                    value : "{{$question->answers[$i]->value}}" ,
            },
            @endfor
          ]
        },
        @endforeach
    ];

      $(document).ready(function() {
          var startDate;
        $('#startButton').on('click', function(){
            $('#startButton').addClass('d-none');
            $('#nextButton').removeClass('d-none');
            startDate = new Date();
            nextQuestion();
        });

        $('#nextButton').on('click', function(){
            nextQuestion();
        });

        $('#finishButton').on('click', function(){
            if(results.length != quiz.length){
                toastr.error("Закончите тест!");
                return;
            }

            $.ajax({
                method: "POST",
                url: "{{URL::route('quizresult.store')}}",
                dataType: "json",
                data : {
                    'values' : JSON.stringify(results),
                    'quiz_id' : {{$quiz->id}},
                    "_token": "{{ csrf_token() }}",
                }
            }).done(function( msg ) {
                if(msg.error == 0){
                    toastr.success("Вы сдали тест!");
                    $('#quizContent').html('');
                    var result = document.createElement('h3');
                    result.innerText = 'Ваш результат - ' + JSON.parse(msg.message).percentage + "%";
                    $('#quizContent').append(result);
                    $('#finishButton').hide();
                    var toMySubjectSpecific = document.createElement('a');
                    toMySubjectSpecific.className = 'btn btn-success text-white';
                    toMySubjectSpecific.innerText = 'Перейти к моим курсам';
                    toMySubjectSpecific.href = "{{URL::route("student.my.subjects.specific" , ['id' => $quiz->subject->id])}}";
                    $('#quizContent').append(toMySubjectSpecific);
                }else{
                    toastr.error("Возникла ошибка!");
                }
            });
        });
        function constructResult(){
            if(currentQuestionId!=0){
                var selected = [];
                $('#quizContent input:checked').each(function(){
                    selected.push(parseInt($(this).attr('value')));
                });

                if(selected.length ==0){
                    toastr.error("Выберите один вариант!");
                    error = true;
                }

                results.push({
                    id : currentQuestionId,
                    selected : selected,
                });
            }
        }

        function nextQuestion(){
            var found = false;
            if(quiz[quiz.length-1].id != currentQuestionId){
                var error = false;
                constructResult();
                if(error){
                    return;
                }
                $('#quizContent').html('');
                quiz.forEach(function(question){
                    if(found == true){
                        createNext(question);
                        found = false;
                        return;
                    }

                    if(currentQuestionId == 0){
                        currentQuestionId = question.id;
                        createNext(question);
                        return;
                    }else if(currentQuestionId == question.id){
                        found = true;
                    }

                });
            }else{
                if(results.length < quiz.length){
                    constructResult();
                }
                if(results.length == quiz.length){
                    $('#quizContent').html('');
                    var endDate = new Date();
                    var seconds = (endDate.getTime() - startDate.getTime()) / 1000;
                    var features = document.createElement('p');
                    var res = 'Дата начала: ' + startDate.toLocaleString() + "<br>";
                    res += 'Дата окончания: ' + endDate.toLocaleString() + "<br>";
                    res += 'Общее количество вопросов: ' + quiz.length + "<br>";

                    features.innerHTML = res;
                    $('#quizContent').html(features);
                    $('#nextButton').addClass('d-none');
                    $('#finishButton').removeClass('d-none');

                }
            }
        }

        function  createNext(question){
            currentQuestionId = question.id;
            var content = $('#quizContent');
            var questionText = document.createElement('p');
            questionText.innerHTML = (++questionIndex ) + ". " +  question.question;
            content.append(questionText);

            question.answers.forEach(function (answer){
                var answerDiv = document.createElement('div');
                var answerValue = document.createElement('p');
                var checkBox = document.createElement('input');
                checkBox.type='checkbox';
                checkBox.value = answer.id;
                answerValue.className = 'text-left';
                answerValue.append(checkBox);
                var optionText = document.createElement('span');
                optionText.innerText = " " + answer.value;
                answerValue.append(optionText);
                answerDiv.append(answerValue);
                content.append(answerDiv);
                $('input[type="checkbox"]').on('change', function () {
                    $('input[type = "checkbox"]').not(this).prop('checked', false);
                });
            });

        }
      });
  </script>
@endsection