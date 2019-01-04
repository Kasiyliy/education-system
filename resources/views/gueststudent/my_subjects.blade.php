@extends('layouts.guest_student_master')

@section('title', 'ASTCGlobal')

@section('nav')
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container-fluid" style='width:90%'>
      <a class="navbar-brand js-scroll-trigger" href="#page-top">
        <img src="/assets/images/PNGGold.png" alt="ASTC GLOBAL" width='120px' class="img img-responsive">
      </a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="/guest#about">О нас</a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Курсы</a>
            <div class="dropdown-menu">
              <a class="dropdown-item" >Глобальный курс</a>
              @if(Auth::check(\App\User::STUDENT))
                <a class="dropdown-item" href="{{URL::route('student.my.subjects')}}">Мои курсы</a>
              @endif

            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="/guest#portfolio">Отзывы</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="/guest#contact">Контакты</a>
          </li>
          @if(Auth::check())
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="{{URL::route('user.logout')}}">Выход</a>
            </li>
          @else
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="login">Вход</a>
            </li>
          @endif
        </ul>
      </div>
    </div>
  </nav>
@endsection

@section('content')

@endsection