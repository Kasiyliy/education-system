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
                        <div class="card-body">
                            <p class="text-dark m-0 text-center">Мои курсы</p>
                        </div>
                    </div>

                    @foreach($sortedSubjectsArray as $sortedSubjects)
                        <div class="card m-2">
                            <div class="card-header">
                                <p class="text-center">{{$sortedSubjects[0]->department->name}}</p>
                            </div>
                            <div class="card-body">
                                <span class="text-muted small">Описание:</span>
                                <p class="text-center">{{$sortedSubjects[0]->department->description}} </p>
                            </div>
                        </div>
                        <div class="row">
                            @foreach($sortedSubjects as $sortedSubject)

                            <div class="col-sm-4">
                                <div class="card">
                                    <div class="card-header">
                                        <p> <span class="text-muted small">Под курс #{{$sortedSubject->id}}</span>:  {{$sortedSubject->name}}</p>
                                    </div>
                                    <div class="card-body">
                                        <span class="text-muted small">Описание:</span>
                                        <p class="text-center">{{$sortedSubject->description}}</p>
                                    </div>
                                    <div class="card-footer">
                                        <a class="float-right btn btn-info text-white btn-xs" href="{{URL::route('student.my.subjects.specific' , ['id'=>$sortedSubject->id])}}">Начать</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection