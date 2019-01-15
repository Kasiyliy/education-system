@extends('layouts.guest_student_master')

@section('title', 'Courses')

@section('content')

    <header class="masthead2 text-center text-white d-flex">

        <div class="container my-auto">
            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <a id="help" href="#help1" class="center btn btn-info p-3 w-25 ">
                        {{trans('messages.help')}}
                    </a>
                </div>
            </div>
        </div>
    </header>

    <body>
    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">{{trans('messages.help_text')}}</h2>
                    <hr class="my-4">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row mx-a text-justify ">
                <div class="col-lg-6 text-center" style="padding-top: 70px;border-right: 3px solid black">
                    <i class="fas fa-4x fa-file-alt text-primary mb-3 sr-icon-1"></i>
                    <h5 class="mb-3">{{trans('messages.help_text1')}}</h5>
                </div>
                <div class="col-lg-6 text-center">
                </div>
            </div>

            <div class="row mx-a text-justify">

                <div class="col-lg-6 text-center" style="padding-top: 70px;border-right: 3px solid black">
                </div>
                <div class="col-lg-6 text-center">
                    <i class="fas fa-4x fa-file-alt text-primary mb-3 sr-icon-1"></i>
                    <h5 class="mb-3">{{trans('messages.help_text2')}}</h5>
                </div>
            </div>

            <div class="row mx-a text-justify">
                <div class="col-lg-6 text-center" style="padding-top: 70px;border-right: 3px solid black">
                    <i class="fas fa-4x fa-file-alt text-primary mb-3 sr-icon-2"></i>
                    <h5 class="mb-3">{{trans('messages.help_text3')}}</h5>
                </div>
                <div class="col-lg-6 text-center">
                </div>
            </div>

            <div class="row mx-a text-justify">
                <div class="col-lg-6 text-center" style="padding-top: 70px;border-right: 3px solid black">
                </div>
                <div class="col-lg-6 text-center">
                    <i class="fas fa-4x fa-file-alt text-primary mb-3 sr-icon-3"></i>
                    <h5 class="mb-3">{{trans('messages.help_text4')}}
                        <a>{{trans('messages.help')}}</a></h5>
                </div>
            </div>

            <div class="row mx-a text-justify">
                <div class="col-lg-6 text-center" style="padding-top: 70px;border-right: 3px solid black">
                    <i class="fas fa-4x fa-heart text-primary mb-3 sr-icon-4"></i>
                    <h5 class="mb-3">{{trans('messages.help_text5')}}</h5>
                </div>
                <div class="col-lg-6 text-center">
                </div>
            </div>
        </div>
    </section>

        <form id="help1"   action = "{{URL::route('help.feedback')}}" method = "post" >
            <div class="container">
                <div class="text-center">
                    <label>{{trans('messages.help_text6')}}</label>
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
        background-color: dodgerblue;
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
        background-image: url("/assets/images/4.jpg");
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
