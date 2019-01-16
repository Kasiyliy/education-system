@extends('layouts.guest_student_master')

@section('title', 'Feedback')

@section('content')

    <header class="masthead2 text-center text-white d-flex">
        <div class="container my-auto">
            <div class="row"
                 style="font-color:white;   background: rgb(0, 0, 0); background: rgba(0, 0, 0, .5);">
                <div class="col-lg-12 mx-auto">
                    <h5 class="">
                        <strong>{{trans('messages.feedback_text1')}}</strong></br>
                        <strong>{{trans('messages.feedback_text2')}}</strong></br>
                    </h5>
                    <hr class="light my-4">
                </div>
            </div>
        </div>
    </header>

    <body>
        <form id="help1"   action = "{{URL::route('help.feedback_send')}}" method = "post" >
            <div class="container">
                <div class="text-center">
                    <h4>{{trans('messages.feedback_text3')}}</h4>
                </div>
                {{csrf_field()}}
                <div class="row">
                    <div class="col">
                        <label for="name">{{trans('messages.name')}}</label>
                        <input type="text" name = "name" class="form-control" placeholder="{{trans('messages.name')}}" required>
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    </div>
                    <div class="col">
                        <label for="surname">{{trans('messages.surname')}}</label>
                        <input type="text" name = "surname" class="form-control" placeholder="{{trans('messages.surname')}}" required>
                        <span class="text-danger">{{ $errors->first('surname') }}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="email">{{trans('messages.email')}}</label>
                        <input type="email" name = "email" class="form-control" aria-describedby="emailHelp"
                               placeholder="{{trans('messages.email')}}" required>
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                        <small id="emailHelp" class="form-text">{{trans('messages.help_text7')}}</small>
                        <label for="message">{{trans('messages.messages')}}</label>
                        <textarea required rows="5" type="text" name = "message" class="form-control" placeholder="{{trans('messages.messages')}}"></textarea>
                        <span class="text-danger">{{ $errors->first('message') }}</span>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="container">
                        <button type="submit" class="btn btn-success col-md-12">{{trans('messages.send')}}</button>
                    </div>
                </div>
            </div>
        </form>

    </body>
    @include('layouts.guest_student_footer')
@endsection

@section('scripts')
    <script src="{{ URL::asset('assets/js/validator.min.js')}}"></script>

    <script>
        $('#iframe').ready(function () {
            setTimeout(function () {
                $('#iframe').contents().find('#download').remove();
            }, 100);
        });
    </script>
@endsection

<style>

    html {
        scroll-behavior: smooth;
    }

    #help1 {
        background-color: dimgray;
        color: white;
        padding: 20px;
        margin: 0;
    }

    #help:hover {
        opacity: 1;
        background-color: #f1f1f1;
        color: black;
    }

    #help {
        border-radius: 30px;
        opacity: 0.9;
        -webkit-transition: 1s;
        transition: 1s;
        border: none;
    }

    header.masthead2 {
        padding-top: 10rem;
        padding-bottom: calc(10rem - 56px);
        background-image: url("/assets/images/5.jpg");
        background-position: center center;
        background-size: cover;
    }

    @media (min-width: 992px) {
        header.masthead2 {
            height: 100vh;
            min-height: 670px;
            padding-top: 0;
            padding-bottom: 0;
        }
    }

</style>
