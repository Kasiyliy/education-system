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
                            <div class="card-header" style=" background-image: linear-gradient(to bottom , #ECEAEF, #B2ABB3)">
                                <p>
                                    <span class="text-muted small">{{trans('messages.courses')}} #{{$subject->id}}</span>: {{$subject->name}}
                                </p>
                            </div>
                            <div class="card-body">
                                <span class="text-muted small">{{trans('messages.opisanie')}}:</span>
                                <p class="">{{$subject->description}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @include('layouts.guest_student_footer')

@endsection
<style>


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