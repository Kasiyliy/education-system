<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container-fluid" style='width:90%'>
        <a class="navbar-brand js-scroll-trigger" href="#page-top">
            <img src="assets/images/PNGGold.png" alt="ASTC GLOBAL" width='120px' class="img img-responsive">
        </a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#about">О нас</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#services">Курсы</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#portfolio">Отзывы</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#contact">Контакты</a>
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
