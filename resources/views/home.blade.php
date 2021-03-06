<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>{{AppHelper::getShortName($institute->name)}} | Главная </title>

    <!-- Bootstrap -->
    <link href="{{ URL::asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ URL::asset('assets/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{ URL::asset('assets/css/animate.min.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ URL::asset('assets/css/custom.min.css')}}" rel="stylesheet">
</head>

<body class="login masthead6">
<div>


    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <form name="login" method="post" action="{{URL::route('user.login')}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <h1>{{trans('messages.login')}} </h1>
                    <div>
                        <input type="text" class="form-control" name="login" placeholder="Username" required=""/>
                    </div>
                    <div>
                        <input type="password" class="form-control" name="password" placeholder="Password" required=""/>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-success btn-lg">{{trans('messages.signin')}} <i
                                    class="fa fa-2x fa-sign-in"></i>
                        </button>
                    </div>

                    <div class="clearfix"></div>

                </form>
                <a href = "/" style = "color:white;">{{trans('messages.return')}}</a>
                <div class="separator">
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    @if (Session::has('error'))
                        <div class="alert alert-danger">
                            {{ Session::get('error') }}
                        </div>
                    @endif
                    @if (Session::has('warning'))
                        <div class="alert alert-warning">
                            {{ Session::get('warning') }}
                        </div>
                    @endif

                    <div class="clearfix"></div>
                    <br/>

                    <div>
                        <h2 style="font-size:16px;"><i class="fa fa-bank"></i> {{$institute->name}}</h2>
                        <p>©{{date('Y')}} All Rights Reserved.</p>
                    </div>
                </div>

            </section>
        </div>


    </div>
</div>
</body>
</html>

<style>


    body.masthead6 {
        background-image: url("/assets/images/9.jpg");
        background-position: inherit;
        background-repeat: no-repeat;
        background-size: 100%;
        color: white;
        height: 100%;
    }


    @media (min-width: 992px) {
        body.masthead6 {
            height: 100px;
            min-height: 300px;
            padding-top: 0;
            padding-bottom: 0;
        }
    }

    @media (min-width: 10px) {
        body.masthead6 {
            height: 1000px;
            min-height: 100%;
            background-position: center;
            background-size: cover;
            padding-top: 0;
            padding-bottom: 0;
        }
    }
</style>