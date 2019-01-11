@extends('layouts.master')

@section('title', 'Чат | Люди')
@section('extrastyle')
    <link href="{{ URL::asset('assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
@endsection
@section('content')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">

            <div class="clearfix"></div>
            <!-- row start -->
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Чат с {{$student->firstName.' '.$student->lastName.' '.$student->middleName}}
                                <small>Под курс: {{$subject->name}}</small>
                            </h2>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content" style="overflow: auto; height: 300px;">
                            <table id="datatable-buttons" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Сообщение</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($messages as $message)
                                    <tr>
                                        <td>
                                            <p class="text-muted">
                                                @if($message->sender_user_id == $student->user_id)
                                                    Собеседник:
                                                @else
                                                    Я:
                                                @endif
                                                {{$message->created_at}}
                                            </p>
                                            {{$message->content}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="container-fluid">
                            <form id = "chat_form" method="post" action="{{URL::route('message.store')}}"
                                  class="form form-horizontal my-2 m-3">
                                {{csrf_field()}}
                                <input type="hidden" name="acceptor_user_id" value="{{$student->user_id}}">
                                <input type="hidden" name="subject_id" value="{{$subject->id}}">
                                <br>
                                <textarea required name="content" class="form-control my-2"
                                          placeholder="Сообщение"></textarea>
                                <br>
                                <button class="form-control" type="submit">Отправить</button>
                            </form>
                        </div>
                    </div>
                    <!-- row end -->
                    <div class="clearfix"></div>

                </div>
            </div>
            <!-- /page content -->
        @endsection
        @section('extrascript')
            <!-- dataTables -->
                <script src="{{ URL::asset('assets/js/jquery.dataTables.min.js')}}"></script>
                <script src="{{ URL::asset('assets/js/dataTables.bootstrap.min.js')}}"></script>
                <script src="{{ URL::asset('assets/js/dataTables.responsive.min.js')}}"></script>
                <script src="{{ URL::asset('assets/js/dataTables.buttons.min.js')}}"></script>
                <script src="{{ URL::asset('assets/js/buttons.bootstrap.min.js')}}"></script>
                <script src="{{ URL::asset('assets/js/buttons.flash.min.js')}}"></script>
                <script src="{{ URL::asset('assets/js/buttons.html5.min.js')}}"></script>
                <script src="{{ URL::asset('assets/js/buttons.print.min.js')}}"></script>
                <script src="{{ URL::asset('assets/js/jszip.min.js')}}"></script>
                <script src="{{ URL::asset('assets/js/pdfmake.min.js')}}"></script>
                <script src="{{ URL::asset('assets/js/vfs_fonts.js')}}"></script>
                <script type="text/javascript">

                    var shiftDown = false;
                    var chatForm = $("#chat_form");
                    var messageBox = chatForm.children("textarea");

                    $(document).keypress(function (e) {
                        if(e.keyCode == 13) {
                            if(messageBox.is(":focus") && !shiftDown) {
                                e.preventDefault(); // prevent another \n from being entered
                                chatForm.submit();
                            }
                        }
                    });

                    $(document).keydown(function (e) {
                        if(e.keyCode == 16) shiftDown = true;
                    });

                    $(document).keyup(function (e) {
                        if(e.keyCode == 16) shiftDown = false;
                    });
                </script>

@endsection
