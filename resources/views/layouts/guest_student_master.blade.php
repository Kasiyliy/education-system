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
            opacity: 1;
        }

    </style>
    @yield('styles')

</head>

<body id="page-top">

<nav class="navbar navbar-expand-lg navbar-dark  fixed-top" style="background-color: black" id="mainNav">
    <div class="container-fluid" style='width:90%'>
        <a class="navbar-brand js-scroll-trigger" href="/">
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
                       aria-haspopup="true" aria-expanded="false">{{trans('messages.courses')}}</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item"
                           href="{{URL::route('homestudent.subjects')}}">{{trans('messages.courses')}}</a>
                        @if(Auth::check())
                        @if(Auth::user()->student)
                            <a class="dropdown-item"
                               href="{{URL::route('student.my.subjects')}}">{{trans('messages.mycourses')}}</a>
                        @endif
                        @endif
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="/guest#portfolio">{{trans('messages.feedback')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger"
                       href="{{URL::route('ourvalues')}}">{{trans('messages.nashicennosti')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger"
                       href="{{URL::route('contacts')}}">{{trans('messages.contacts')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger"
                       href="{{URL::route('help')}}">{{trans('messages.help')}}</a>
                </li>
                @if(Auth::check())
                    @if(Gate::check('Admin'))
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="{{URL::route('user.dashboard')}}">{{trans('messages.adminpanel')}}</a>
                        </li>
                    @elseif(Gate::check('Teacher'))
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="{{URL::route('user.dashboard')}}">{{trans('messages.teacherpanel')}}</a>
                        </li>
                    @endif

                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger"
                           href="{{URL::route('user.logout')}}">{{trans('messages.signout')}}</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="/login">{{trans('messages.signin')}}</a>
                    </li>
                @endif
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="nav-item">
                    <b><a class="nav-link js-scroll-trigger" href="{{URL::route('setlangrus')}}">
                            РУС</a></b>
                </li>
                <li class="nav-item" style=" border-left: 1px solid white">
                    <b> <a class="nav-link js-scroll-trigger" href="{{URL::route('setlangeng')}}">
                            ENG</a></b>
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
<script src="{{ URL::asset('assets/js/toastr.min.js')}}"></script>

<script>
    window.onscroll = function() {myFunction()};

    // Get the navbar
    var navbar = document.getElementById("mainNav");

    var sticky = navbar.offsetTop;

    // Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
    function myFunction() {
        if (window.pageYOffset >= sticky+5) {
            navbar.classList.add("fixed-top")
        } else {
            navbar.classList.remove("fixed-top");
        }
    }
    myFunction();
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
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
