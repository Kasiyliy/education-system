@extends('layouts.guest_student_master')
@section('title', 'Our values')
@section('style')
    <style>
        #iskrenne {
            margin-left: 100px;
        }
    </style>
@endsection
@section('content')

    <header class="masthead1 text-center text-white d-flex">
        <div class="container my-auto">
        </div>
    </header>

    <header class="text-white">
        <div class="row col-md-13"
             style="font-color:white; background: rgba(0, 0, 0, .5);">
            <div class="mx-auto">
                <h5 style="font-family: 'Gill Sans';font-weight: bold;">
                    {{trans('messages.our_values')}}
                </h5>
                <hr class="light my-4">
            </div>
        </div>
    </header>



    <div class="row">
        <div class="container col-md-3 lineborder" >
            <h5 style="font-family: 'Gill Sans';font-weight: bold;">
                {{trans('messages.our_values_text1')}}
            </h5>
            <p>
                {{trans('messages.our_values_text12')}}
            </p>

        </div>

        <div class="container col-md-3 lineborder">
            <h5 style="font-family: 'Gill Sans';font-weight: bold;">
                {{trans('messages.our_values_text2')}}
            </h5>
            <p>
                {{trans('messages.our_values_text22')}}
            </p>
        </div>
        <div class="container col-md-3 lineborder">
            <h5 style="font-family: 'Gill Sans';font-weight: bold;">
                {{trans('messages.our_values_text3')}}
            </h5>
            <p>
                {{trans('messages.our_values_text32')}}
            </p>

        </div>
        <div class="container col-md-3 lineborder">
            <h5 style="font-family: 'Gill Sans';font-weight: bold;">
                {{trans('messages.our_values_text4')}}
            </h5>
            <p>
                {{trans('messages.our_values_text42')}}
            </p>

        </div>


    </div>
    @include('layouts.guest_student_footer')
@endsection

<style>
    .lineborder:after{
        border-left: 2px solid lightslategrey;
        content : "";
        position: absolute;
        right    : 0;
        z-index: 100;
        top  : 30%;
        width  : 3px;
        height   : 30%;
    }
    h5 {
        font-family: 'Gill Sans';
        font-weight: bold;
    }

    p {
        font-family: 'Gill Sans';
    }

    div.container {
        padding-left: 40px;
        padding-top: 20px;
        padding-right: 40px;
        margin-bottom: 40px;
        margin-top: 40px;
    }

    header.masthead1 {
        padding-top: 10rem;
        padding-bottom: calc(10rem - 56px);
        background-image: url("/assets/images/8.jpg");
        background-position: center center;
        background-size: cover;
    }

    header.masthead1 hr {
        margin-top: 30px;
        margin-bottom: 30px;
    }

    header.masthead1 h1 {
        font-size: 2rem;
    }

    header.masthead1 p {
        font-weight: 300;
    }

    @media (min-width: 768px) {
        header.masthead1 p {
            font-size: 1.15rem;
        }
    }

    @media (min-width: 992px) {
        header.masthead1 {
            height: 100vh;
            min-height: 650px;
            padding-top: 0;
            padding-bottom: 0;
        }

        header.masthead1 h1 {
            font-size: 3rem;
        }
    }

    @media (min-width: 1200px) {
        header.masthead1 h1 {
            font-size: 4rem;
        }
    }
</style>
