@extends('layouts.guest_student_master')

@section('title', 'ASTCGlobal')
@section('content')

    <header class="masthead text-center text-white d-flex">
        <div class="container my-auto">
            <div class="row"
                 style="font-color:white;   background: rgb(0, 0, 0); background: rgba(0, 0, 0, .5);">
                <div class="col-lg-12 mx-auto">
                    <h5 class="">
                        <strong>{{trans('messages.welcome_word1')}}</strong></br>
                        <strong>{{trans('messages.welcome_word2')}}</strong></br>
                        <strong>{{trans('messages.welcome_word3')}}</strong></br>
                        <strong>{{trans('messages.welcome_word4')}}</strong></br>
                        <strong>{{trans('messages.welcome_word5')}}</strong>
                    </h5>
                    <hr class="light my-4">
                </div>
                <div class="col-lg-10" id="iskrenne" style="margin-left:100px;">
                    <p class="text-white text-right">
                        {{trans('messages.welcome_word6')}}<br>
                        @if(session('language') == 'ru')
                            Команда ASTC Global<br>
                        @else
                            ASTC Global team<br>
                        @endif

                    </p>
                </div>
            </div>
        </div>
    </header>



    @include('layouts.guest_student_footer')
@endsection
