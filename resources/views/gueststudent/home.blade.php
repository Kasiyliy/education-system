@extends('layouts.guest_student_master')

@section('title', 'ASTCGlobal')
@section('style')
    <style>
        #iskrenne {
            margin-left: 100px;
        }
    </style>
@endsection
@section('content')

    <header class="masthead text-center text-white d-flex">
        <div class="container my-auto">
            <div class="row container"
                 style="font-color:white; background-color: #1d1e29;    background: rgb(0, 0, 0); background: rgba(0, 0, 0, .5);">
                <div class="col-lg-12 mx-auto">
                    <h5 class="">
                        <strong>{{trans('messages.welcome_word1')}}</strong></br>
                        <strong>{{trans('messages.welcome_word2')}}</strong></br>
                        <strong>{{trans('messages.welcome_word3')}}</strong></br>
                        <strong>{{trans('messages.welcome_word4')}}</strong>
                    </h5>
                    <hr class="light my-4">
                </div>
                <div class="col-lg-10" id="iskrenne" style="margin-left:100px;">
                    <p class="text-white text-right">
                        {{trans('messages.welcome_word5')}}</br>
                        @if(session('language') == 'ru')
                            Команда </br>
                            ASTC Global</br>
                        @else
                            ASTC Global</br>
                            team</br>
                        @endif

                    </p>
                </div>
            </div>
        </div>
    </header>
    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Путеводитель. Road map.</h2>
                    <hr class="my-4">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5 text-center">
                    <div class="service-box mt-5 mx-auto">
                        <i class="fas fa-4x fa-file-alt text-primary mb-3 sr-icon-1"></i>
                        <h3 class="mb-3">Мы рады привествовать вас! Welcome!</h3>
                    </div>
                </div>
                <div class="col-lg-3 col-md-5 text-center">
                    <div class="service-box mt-5 mx-auto">
                        <i class="fas fa-4x fa-file-alt text-primary mb-3 sr-icon-1"></i>
                        <h3 class="mb-3">Зарегестрируйтесь. Register with us.</h3>
                    </div>
                </div>
                <div class="col-lg-3 col-md-5 text-center">
                    <div class="service-box mt-5 mx-auto">
                        <i class="fas fa-4x fa-file-alt text-primary mb-3 sr-icon-2"></i>
                        <h3 class="mb-3">Начните обучение. Start training.</h3>
                    </div>
                </div>
                <div class="col-lg-3 col-md-5 text-center">
                    <div class="service-box mt-5 mx-auto">
                        <i class="fas fa-4x fa-file-alt text-primary mb-3 sr-icon-3"></i>
                        <h3 class="mb-3">В случае отсутствия доступа пожалуйста, обратитесь к администратору сайта.
                            <a>Помощь</a>
                        In case of access problems, please, kindly address the administrator.
                            <a>Help</a></h3>
                    </div>
                </div>
                <div class="col-lg-3 col-md-5 text-center">
                    <div class="service-box mt-5 mx-auto">
                        <i class="fas fa-4x fa-heart text-primary mb-3 sr-icon-4"></i>
                        <h3 class="mb-3">Тест Будет доступен после прохождения обучения, по результатам которого будет выдан сертификат.
                         Test will be available after training complation followed by the certificate.</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>



    @include('layouts.guest_student_footer')
@endsection
