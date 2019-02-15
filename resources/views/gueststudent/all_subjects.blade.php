@extends('layouts.guest_student_master')

@section('title', 'Courses')

@section('content')

    <header class="masthead2 text-center text-white d-flex">
        <div class="container my-auto">
        </div>
    </header>
    <section id="services">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">{{trans('messages.all_subjects_text1')}}</h2>
                <hr class="my-4">
            </div>
        </div>
        <div class="row mx-1">

            @foreach($departments as $department)
                <div class="col-md-3" style="margin-top: 100px">
                    <div class="thumbnail">
                        <a class="text-decoration-none"
                           href="{{URL::route('subjects.specific' , ['id'=>$department->id])}}">
                            <div class="card-header background11">
                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-10 center"><br/>
                                        <p class="center" style=" font-family: 'Gill Sans'">{{$department->name}}</p>
                                    </div>
                                </div>
                                <div class="row bottom123">
                                    <div class="col-md-8"></div>
                                    <div class="col-md-2"><br/>
                                        <p style=" font-family: 'Gill Sans'">{{trans('messages.start_department')}}<span
                                                    class="fa fa-caret-down"></span></p>
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach

        </div>
    </section>
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

    .background11 {
        height: 200px;
        background-image: url("/assets/images/PNGblack1.png");
        background-repeat: no-repeat;
        background-position: bottom left;
        background-size: 150px;
    }

    .bottom123 {
        position: absolute;
        bottom: 0;
        right: 100px;
    }

    .background11:hover {
        background-color: darkgrey;
        color: white;
    }

    header.masthead2 {
        padding-top: 10rem;
        padding-bottom: calc(10rem - 56px);
        background-image: url("/assets/images/3.jpg");
        background-position: center center;
        background-size: cover;
    }

    header.masthead2 hr {
        margin-top: 30px;
        margin-bottom: 30px;
    }

    header.masthead2 h1 {
        font-size: 2rem;
    }

    header.masthead2 p {
        font-weight: 300;
    }

    @media (min-width: 768px) {
        header.masthead2 p {
            font-size: 1.15rem;
        }
    }

    @media (min-width: 992px) {
        header.masthead2 {
            height: 100vh;
            min-height: 650px;
            padding-top: 0;
            padding-bottom: 0;
        }

        header.masthead2 h1 {
            font-size: 3rem;
        }
    }

    @media (min-width: 1200px) {
        header.masthead2 h1 {
            font-size: 4rem;
        }
    }
</style>
