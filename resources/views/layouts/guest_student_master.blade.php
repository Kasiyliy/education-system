<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>
        @yield('title','Мои курсы')
    </title>

    <!-- Bootstrap core CSS -->
    <link href="/assets/front/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="/assets/front/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800'
          rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic'
          rel='stylesheet' type='text/css'>

    <!-- Plugin CSS -->
    <link href="/assets/front/vendor/magnific-popup/magnific-popup.css" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/toastr.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/assets/front/css/creative.min.css" rel="stylesheet">
    <style>
        #toast-container > div {
            opacity:1;
        }
    </style>
    @yield('styles')

</head>

<body id="page-top">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="mainNav">
    <div class="container-fluid" style='width:90%'>
        <a class="navbar-brand js-scroll-trigger" href="#page-top">
            <img src="/assets/images/PNGGold.png" alt="ASTC GLOBAL" width='120px' class="img img-responsive">
        </a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto text-white">

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                       aria-haspopup="true" aria-expanded="false">Курсы</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{URL::route('homestudent.subjects')}}">Все курсы</a>
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
            <ul class="nav navbar-nav navbar-right" style="background: #0a0c0e">
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="{{URL::route('setlangrus')}}">
                        Рус</a>
                </li>
                <li class="nav-item" style = " border-left: 1px solid white">
                    <a class="nav-link js-scroll-trigger" href="{{URL::route('setlangeng')}}">
                        Анг</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

@yield('content')

<script src="/assets/front/vendor/jquery/jquery.min.js"></script>
<script src="/assets/front/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/front/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="/assets/front/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="/assets/front/vendor/scrollreveal/scrollreveal.min.js"></script>
<script src="/assets/front/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
<script src="/assets/front/js/creative.min.js"></script>
<script src="/assets/pdfjs/pdf.js"></script>
<script src="/assets/pdfjs/pdf.worker.js"></script>
<script src="{{ URL::asset('assets/js/toastr.min.js')}}"></script>

<script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-left",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    $(document).ready(function () {
        @if(Session::has('success'))
        toastr.success("{{Session::get("success")}}");
        @endif
        @if(Session::has('error'))
        toastr.error("{{Session::get("error")}}");
        @endif
        @if(Session::has('warning'))
        toastr.warning("{{Session::get("warning")}}");
        @endif
        @if(Session::has('info'))
        toastr.warning("{{Session::get("info")}}");
        @endif
    });
</script>
@yield('scripts')
</body>

</html>
