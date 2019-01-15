<!-- <!DOCTYPE html> -->
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{session('inNameShort')}} - @yield("title")</title>
    <!-- Bootstrap -->
    <link href="{{ URL::asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ URL::asset('assets/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/nprogress.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/jquery.mCustomScrollbar.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/pnotify.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/pnotify.buttons.css')}}" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="{{ URL::asset('assets/css/custom.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/app.css')}}" rel="stylesheet">
    @yield("extrastyle")
    <script>
        var hash = '{{session('user_session_sha1')}}';
    </script>
</head>

<body class="nav-md footer_fixed">

<div class="container body">
    <div class="main_container">

        <div class="col-md-3 left_col menu_fixed">
            <div class="left_col scroll-view">

                <div class="navbar nav_title" style="border: 0; margin-top:20px">
                    <a href="{{URL::route('user.dashboard')}}" class="site_title"><i class="fa fa-bank"></i>
                        <span> {{session('inName')}}</span></a>
                </div>

                <div class="clearfix"></div>

                `
                <br/>

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <h3>{{trans('messages.main_menu')}} </h3>
                        <ul class="nav side-menu">
                            @can('Admin')
                                <li><a><i class="fa fa-home"></i> {{trans('messages.disciplina')}} <span
                                                class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li>
                                            <a href="{{URL::route('department.create')}}">{{trans('messages.add_disciplina')}}</a>
                                        </li>
                                        <li>
                                            <a href="{{URL::route('department.index')}}">{{trans('messages.all_disciplina')}}</a>
                                        </li>

                                    </ul>
                                </li>
                            @endcan
                            @if(Gate::check('Admin') || Gate::check('Teacher'))
                                <li><a><i class="fa fa-book"></i>{{trans('messages.courses')}}<span
                                                class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li>
                                            <a href="{{URL::route('subject.create')}}">{{trans('messages.add_course')}}</a>
                                        </li>
                                        <li>
                                            <a href="{{URL::route('subject.index')}}">{{trans('messages.my_courses')}}</a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                            @can('Admin')
                                <li><a><i class="fa fa-users"></i>{{trans('messages.student')}}<span
                                                class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li>
                                            <a href="{{URL::route('student.create')}}">{{trans('messages.add_student')}}</a>
                                        </li>
                                        <li>
                                            <a href="{{URL::route('student.index')}}">{{trans('messages.all_student')}}</a>
                                        </li>
                                        <li>
                                            <a href="{{URL::route('student.registration.create')}}">{{trans('messages.register_student')}}</a>
                                        </li>
                                        <li>
                                            <a href="{{URL::route('student.registration.index')}}">{{trans('messages.all_registered_student')}}</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-lock"></i>{{trans('messages.teachercontrol')}}<span
                                                class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li>
                                            <a href="{{URL::route('teacher.control')}}">{{trans('messages.teachercontrolteacher')}}</a>
                                        </li>
                                    </ul>
                                </li>
                            @endcan
                            @if(Gate::check('Admin') || Gate::check('Teacher'))


                                <li><a><i class="fa fa-envelope"></i>{{trans('messages.messages')}}
                                        @if(($count = App\Message::where('read', false)->where('acceptor_user_id', Auth::id())->count())> 0)
                                            <span class="badge">{{$count}}</span>
                                        @endif
                                        <span
                                                class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li>
                                            <a href="{{URL::route('message.index')}}">{{trans('messages.my_messages')}}</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-edit"></i> {{trans('messages.test')}} <span
                                                class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{URL::route('quiz.create')}}">{{trans('messages.add_test')}}</a>
                                        </li>
                                        <li><a href="{{URL::route('quiz.index')}}">{{trans('messages.list_test')}}</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-file-text"></i>{{trans('messages.result')}}<span
                                                class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li>
                                            <a href="{{URL::route('result.quiz')}}">{{trans('messages.test_result')}}</a>
                                        </li>
                                        {{--<li><a href="{{URL::route('result.individual')}}">Student Wise</a></li>--}}
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-file-powerpoint-o"
                                          aria-hidden="true"></i>{{trans('messages.presentation')}}<span
                                                class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li>
                                            <a href="{{URL::route('lesson.create')}}">{{trans('messages.add_presentation')}}</a>
                                        </li>
                                        <li>
                                            <a href="{{URL::route('lesson.index')}}">{{trans('messages.list_presentation')}}</a>
                                        </li>
                                    </ul>
                                </li>

                            @endif
                            @can('Admin')
                                <li><a><i class="fa fa-users"></i>{{trans('messages.user')}}<span
                                                class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{URL::route('user.create')}}">{{trans('messages.add_user')}}</a>
                                        </li>
                                        <li><a href="{{URL::route('user.index')}}">{{trans('messages.user_list')}}</a>
                                        </li>

                                        <li>
                                            <a href="{{URL::route('user.addstudent')}}">{{trans('messages.add_student_user')}}</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="{{URL::route('institute.index')}}"><i
                                                class="fa fa-building"></i>{{trans('messages.about_us')}}</a>

                                </li>
                            @endcan


                        </ul>
                    </div>
                    <div class="menu_section">
                        <h3></h3>

                    </div>

                </div>
                <!-- /sidebar menu -->

                <!-- /menu footer buttons -->
                <div class="sidebar-footer hidden-small">
                    <a href="{{URL::route('user.settings')}}" data-toggle="tooltip" data-placement="top"
                       title="Настройки">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                    </a>
                    <a class="fullScreen" data-toggle="tooltip" data-placement="top" title="Полноэкранный режим">
                        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                    </a>
                    <a href="{{URL::route('lock')}}" data-toggle="tooltip" data-placement="top" title="Заблокировать">
                        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                    </a>
                    <a href="{{URL::route('user.logout')}}" data-toggle="tooltip" data-placement="top" title="Выйти">
                        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                    </a>
                </div>
                <!-- /menu footer buttons -->
            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <nav class="" role="navigation">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <ul class="nav navbar-nav navbar-right">

                        <li>
                            <a style="text-color:white;" href="{{URL::route('setlangrus')}}">
                                РУС</a>
                        </li>
                        <li style=" border-left: 1px solid white">
                            <a style="text-color:white;" href="{{URL::route('setlangeng')}}">
                                ENG</a>
                        </li>
                        <li class="">
                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown"
                               aria-expanded="false">
                                <img src="/assets/images/users/user.png" alt="">{{Session::get('name')}}
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu">
                                <li>
                                    <a href="{{URL::route('user.settings')}}"><i class="glyphicon glyphicon-cog"></i>
                                        Настройки</a>
                                </li>
                                <li>
                                    <a class="fullScreen"><i class="glyphicon glyphicon-fullscreen"></i> Полноэкранный
                                        режим</a>
                                </li>
                                <li>
                                    <a href="{{URL::route('lock')}}"><i class="glyphicon  glyphicon-eye-close"></i>
                                        Заблокировать</a>
                                </li>
                                <li><a href="{{URL::route('user.logout')}}"><i class="glyphicon glyphicon-off"></i>
                                        Выйти</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->

        <!--Child Page Content Start  -->

    @yield('content')

    <!--Child Page Content End  -->

    @include('layouts.footer')

    <!-- jQuery -->
        <script src="{{ URL::asset('assets/js/jquery.min.js')}}"></script>
        <!-- Bootstrap -->
        <script src="{{ URL::asset('assets/js/bootstrap.min.js')}}"></script>
        <!-- FastClick -->
        <script src="{{ URL::asset('assets/js/fastclick.js')}}"></script>
        <!-- NProgress -->
        <script src="{{ URL::asset('assets/js/nprogress.js')}}"></script>

        <script src="{{ URL::asset('assets/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>

        <script src="{{ URL::asset('assets/js/pnotify.js')}}"></script>
        <script src="{{ URL::asset('assets/js/pnotify.buttons.js')}}"></script>

    @yield("extrascript")
    <!-- Custom Theme Scripts -->
        <script src="{{ URL::asset('assets/js/custom.min.js')}}"></script>
        <script src="{{ URL::asset('assets/js/app.js')}}"></script>

        <!-- PNotify -->
        <script>
            $(document).ready(function () {
                @if(Session::has('success'))
                new PNotify({
                    title: '{{Session::get("success")["title"]}}',
                    text: '{{Session::get("success")["body"]}}',
                    type: 'success',
                    styling: 'bootstrap3'
                });
                @endif
                @if(Session::has('error'))
                new PNotify({
                    title: '{{Session::get("error")["title"]}}',
                    text: '{{Session::get("error")["body"]}}',
                    type: 'error',
                    styling: 'bootstrap3'
                });
                @endif
                @if(Session::has('warning'))
                new PNotify({
                    title: '{{Session::get("warning")["title"]}}',
                    text: '{{Session::get("warning")["body"]}}',
                    styling: 'bootstrap3'
                });
                @endif

            });
        </script>
        <!-- /PNotify -->

</body>
</html>