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
            <li class="list-group-item"><span class="fa fa-envelope"></span><a class="btn-link" href="{{URL::route('student.my.subjects.chat', ['id' => $subject->id])}}"> Перейти в чат с учителем</a></li>
          </ul>
        </div>
      </div>
      <div class="col-sm-9">
        <div class="container-fluid">
          <div class="card my-4">
            <div class="card-body">
              <p class="text-dark m-0 text-center">Уроки</p>
            </div>
          </div>
        </div>

        <div class="content">
          <div id="accordion">

            @foreach($lessons as $lesson )
              <div class="card">
                <div class="card-header" id="heading{{$lesson->id}}">
                  <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$lesson->id}}" aria-controls="collapse{{$lesson->id}}">
                      {{$lesson->name}} <span class="fa fa-arrow-circle-down text-danger"></span>
                    </button>
                  </h5>
                </div>

                <div id="collapse{{$lesson->id}}" class="collapse" aria-labelledby="heading{{$lesson->id}}" data-parent="#accordion">
                  <div class="card-body">
                    {{$lesson->description}}
                  </div>
                  <a class="btn btn-success btn-xs m-2 float-right text-white" href="{{URL::route('student.my.subjects.specific.lesson', ['id' => $lesson->id])}}">
                    Открыть
                  </a>
                </div>
              </div>
            @endforeach

          </div>
        </div>

        <div class="container-fluid">
          <div class="card my-4">
            <div class="card-body">
              <p class="text-dark m-0 text-center">Тесты</p>
            </div>
          </div>
        </div>


        <div class="content">
          <div id="accordion1">

            @foreach($quizes as $quiz )
              <div class="card">
                <div class="card-header" id="headingquiz{{$quiz->id}}">
                  <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapsequiz{{$quiz->id}}" aria-controls="collapsequiz{{$quiz->id}}">
                      {{$quiz->name}} <span class="fa fa-arrow-circle-down text-danger"></span>
                    </button>
                  </h5>
                </div>

                <div id="collapsequiz{{$quiz->id}}" class="collapse" aria-labelledby="headingquiz{{$quiz->id}}" data-parent="#accordion1">
                  <div class="card-body">
                    {{$quiz->description}}
                  </div>
                  <a class="btn btn-success btn-xs m-2 float-right text-white" href="{{URL::route('student.my.subjects.specific.quiz', ['id' => $quiz->id])}}">
                    Открыть
                  </a>
                </div>
              </div>
            @endforeach

          </div>
        </div>

      </div>
    </div>
  </div>

@endsection