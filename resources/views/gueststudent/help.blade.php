@extends('layouts.guest_student_master')

@section('title', 'Courses')

@section('content')

    <header class="masthead2 text-center text-white d-flex">
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
            <div class="row mx-a">
                <div class="col-lg-3">
                    <i class="fas fa-4x fa-file-alt text-primary mb-3 sr-icon-1"></i>
                    <h5 class="mb-3">{{trans('messages.help_text1')}}</h5>
                </div>
                <div class="col-lg-2">
                    <i class="fas fa-4x fa-file-alt text-primary mb-3 sr-icon-1"></i>
                    <h5 class="mb-3">{{trans('messages.help_text2')}}</h5>
                </div>
                <div class="col-lg-2">
                    <i class="fas fa-4x fa-file-alt text-primary mb-3 sr-icon-2"></i>
                    <h5 class="mb-3">{{trans('messages.help_text3')}}</h5>
                </div>
                <div class="col-lg-2">
                    <i class="fas fa-4x fa-file-alt text-primary mb-3 sr-icon-3"></i>
                    <h5 class="mb-3">{{trans('messages.help_text4')}}
                        <a>{{trans('messages.help')}}</a></h5>
                </div>
                <div class="col-lg-3">
                    <i class="fas fa-4x fa-heart text-primary mb-3 sr-icon-4"></i>
                    <h5 class="mb-3">{{trans('messages.help_text5')}}</h5>
                </div>
            </div>
        </div>
    </section>
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
            min-height: 650px;
            padding-top: 0;
            padding-bottom: 0;
        }
    }

</style>
