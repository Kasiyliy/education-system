@extends('layouts.master')

@section('title', 'Subject')

@section('content')

    <
    <div class="right_col" role="main">
        <div class="">

            <div class="clearfix"></div>
            <!-- row start -->
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Урок
                                <small> посмотреть</small>
                            </h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <strong>Упс!</strong> Возникли ошибки!<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" id="viewer"
                                        src="/assets/ViewerJS/#/{{$lesson->presentation}}" allowfullscreen
                                        webkitallowfullscreen></iframe>
                                {{--<embed class="embed-responsive-item"--}}
                                        {{--src="{{URL::to('/').'/'.$lesson->presentation }}"--}}
                                        {{--frameborder="0"></embed>--}}

                            </div>


                        </div>
                    </div>
                    <!-- row end -->
                    <div class="clearfix"></div>

                </div>
            </div>
            <!-- /page content -->
            @endsection
            @section('extrascript')
                <script src="{{ URL::asset('assets/js/validator.min.js')}}"></script>

                <script>
                    $('#iframe').ready(function() {
                        setTimeout(function() {
                            $('#iframe').contents().find('#download').remove();
                        }, 100);
                    });
                </script>

        </div>@endsection
