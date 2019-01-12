@extends('layouts.guest_student_master')

@section('title', 'Contacts')

@section('content')

    <header class="masthead2 text-center text-white d-flex">
        <div class="container my-auto">
        </div>
    </header>
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
        background-image: url("/assets/images/7.jpg");
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
            height: 200px;
            min-height: 750px;
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
