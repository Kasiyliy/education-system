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
            <li class="list-group-item"><span class="fa fa-arrow-circle-left"></span><a class="btn-link" href="{{URL::route('student.my.subjects.specific', ['id' =>$subject->id])}}">Перейти обратно на урок</a></li>
          </ul>
        </div>
      </div>
      <div class="col-sm-9">
        <div class="container-fluid">
          <div class="card my-4">
            <div class="card-body">
              <p class="text-dark m-0 text-center">
              {{trans('messages.chat_instructor')}} "{{$subject->name}}" - {{$subject->user->firstname.' '.$subject->user->lastname.' '.$subject->user->middlename}}
              </p>
            </div>
          </div>

        </div>

        <div class="x_content container-fluid"  style="overflow: auto; height: 300px; ">
          <table id="datatable-buttons" class="table table-hover table-bordered">
            <thead>
            <tr>
              <th>Сообщение</th>
            </tr>
            </thead>
            <tbody >
            @foreach($messages as $message)
              <tr>
                <td style="min-width: 100%;">
                  <p class="text-muted">
                    @if($message->sender_user_id == $subject->user->id)
                      Собеседник:
                    @else
                      Я:
                    @endif
                    {{$message->created_at}}
                  </p>
                  {{$message->content}}
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>

        </div>
        <div class="container-fluid">
          <form method="post" action="{{URL::route('message.store')}}" class="form form-horizontal my-2 m-3">
            {{csrf_field()}}
            <input type="hidden" name="acceptor_user_id" value="{{$subject->user->id}}">
            <input type="hidden" name="subject_id" value="{{$subject->id}}">
            <br>
            <textarea required name="content" class="form-control my-2" placeholder="Сообщение"></textarea>
            <br>
            <button class="form-control btn btn-success" type="submit">Отправить</button>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection