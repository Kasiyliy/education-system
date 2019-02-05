@extends('layouts.guest_student_master')

@section('title', 'Courses')

@section('content')

    <div class="row">
        <div class="col-lg-4 masthead6">
        </div>
        <div class="col-lg-4 masthead7">
        </div>
        <div class="col-lg-4 masthead8">
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card-body">
                    <p class="text-dark m-0 text-center">{{trans('messages.courses')}}</p>
                </div>
                @foreach($subjects as $subject)

                    <div class="container col-sm-12" style="margin-bottom: 30px;">
                        <div class="card">
                            <div class="card-header"
                                 style=" background-image: linear-gradient(to bottom , #ECEAEF, #B2ABB3)">
                                <p>
                                    <span class="text-muted small"></span>: {{$subject->name}}
                                </p>
                            </div>
                            <div class="card-body">
                                <span class="text-muted small">{{trans('messages.opisanie')}}:</span>
                                <p class="">{{$subject->description}}</p>
                            </div>
                            @if(Auth::check(\App\User::STUDENT))
                                @foreach($student_subjects as $student_subject)
                                    <?php
                                    $subject_id = $subject->id;
                                    $student_subject_id = $student_subject->subject_id;
                                    ?>
                                    @if($subject_id == $student_subject_id)
                                        <form action="{{URL::route('student.my.subjects')}}">
                                            <button id="gocourse" type="submit"
                                                    class='col-md-12 btn btn-success'>Go
                                            </button>
                                        </form>
                                    @else
                                        <button id="infoadmin" type="submit" onclick="openForm()"
                                                class='btn btn-info open-button'>Go
                                        </button>
                                    @endif

                                @endforeach
                            @else
                                <button id="infoadmin" type="submit" onclick="openForm()"
                                        class='btn btn-info open-button'>Go
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @include('layouts.guest_student_footer')




@endsection


<div class="form-popup center-block" id="myForm">
    <form action="" class="form-container">
        <label><b>{{trans('messages.cannot_course')}}</b></label>
        <span class="close">&times;</span>
    </form>
</div>

<style>
    .open-button {
        color: white;
        border: none;
        cursor: pointer;
        opacity: 0.8;
        bottom: 23px;
        right: 28px;
    }

    .form-popup {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0, 0, 0); /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
    }

    .form-container {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }

    .form-container .btn:hover, .open-button:hover {
        opacity: 1;
    }

    div.masthead6 {
        background-image: url("/assets/images/1.jpg");
        background-position: center center;
        background-size: 100%;
    }

    div.masthead7 {
        background-image: url("/assets/images/6.jpg");
        background-position: center center;
        background-size: 100%;
    }

    div.masthead8 {
        background-image: url("/assets/images/11.jpg");
        background-position: center center;
        background-size: cover;
    }


    @media (min-width: 992px) {
        div.masthead6 {
            height: 100px;
            min-height: 300px;
            padding-top: 0;
            padding-bottom: 0;
            margin-top: 80px;
        }

        div.masthead7 {
            height: 100px;
            min-height: 300px;
            padding-top: 0;
            padding-bottom: 0;
            margin-top: 80px;
        }

        div.masthead8 {
            height: 100px;
            min-height: 300px;
            padding-top: 0;
            padding-bottom: 0;
            margin-top: 80px;
        }
    }
</style>


<script src="{{ URL::asset('assets/js/jquery.min.js')}}"></script>

<script>
    function openForm() {
        document.getElementById("myForm").style.display = "block";
    }

    var span = document.getElementsByClassName("close")[0];

    span.onclick = function () {
        document.getElementById("myForm").style.display = "none";
    }
</script>
