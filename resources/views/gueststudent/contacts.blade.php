@extends('layouts.guest_student_master')

@section('title', 'Contacts')

@section('content')

    <header class="masthead2 text-center text-white d-flex">
        <div class="container my-auto">
        </div>
    </header>
    <body>
        <div class="container rounded contacts">
            <h5 class="text-center">{{trans('messages.contact')}}</h5>
            <b>{{trans('messages.too_global')}}  </b>   "{{$institute->name}}"<br/>
            <b>E-mail:   </b>   {{$institute->email}}<br/>
            <b>{{trans('messages.telephone')}}:   </b>   {{$institute->phoneNo}}<br/>
            <b>{{trans('messages.address')}}  </b>{{$institute->address}}<br/>
        </div>
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

    .contacts{
        position: center;
        margin: 10%;
        border: 1px solid black;
        font-family: "Gill Sans";
        padding-top: 3%;
        padding-bottom: 3%;
    }
    .contacts b{
        padding-left: 20%;
    }
    header.masthead2 {
        padding-top: 10rem;
        padding-bottom: calc(10rem - 56px);
        background-image: url("/assets/images/7.jpg");
        background-position: center center;
        background-size: cover;
    }

    @media (min-width: 992px) {
        header.masthead2 {
            height: 200px;
            min-height: 750px;
            padding-top: 0;
            padding-bottom: 0;
        }
    }
</style>
