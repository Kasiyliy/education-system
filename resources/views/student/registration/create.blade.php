@extends('layouts.master')


@section('title', 'Регистрация')
@section('extrastyle')
    <link href="{{ URL::asset('assets/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/switchery.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">

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
                        <div class="x_content">
                            <h2>{{trans('messages.registration_text1')}}
                                <small>{{trans('messages.registration_text2')}}</small>
                            </h2>

                        </div>
                        <div class="x_content">
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <strong>{{trans('messages.registration_text21')}}
                                        !</strong> {{trans('messages.registration_text22')}}.<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form class="form-horizontal form-label-left" novalidate method="post"
                                  action="{{URL::route('student.registration.store')}}">

                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="item form-group">
                                            <label for="subject">{{trans('messages.registration_text3')}}<span
                                                        class="required">*</span>
                                            </label>

                                            {!!Form::select('subject_id', $subjects, null, ['placeholder' => '','class'=>'select2_single subject form-control has-feedback-left','required'=>'required','id'=>'subject_id'])!!}
                                            <i class="fa fa-home form-control-feedback left" aria-hidden="true"></i>
                                            <span class="text-danger">{{ $errors->first('subject_id') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="row">
                                    <table id="studentList"
                                           class="table table-striped table-bordered nowrap" style="width:100%">
                                        <thead>
                                        <tr>

                                            <th>Id No</th>
                                            <th>{{trans('messages.registration_text4')}}</th>
                                            <th>{{trans('messages.registration_text5')}}</th>
                                            <th>{{trans('messages.registration_text6')}}?</th>

                                        </tr>
                                        </thead>
                                        <tbody id='tbodyid'>
                                        <tbody>
                                    </table>
                                </div>

                                <div class="ln_solid"></div>

                                <div class="row">
                                    <button id="btnsave" type="submit" class="btn btn-lg btn-success pull-right"><i
                                                class="fa fa-check">{{trans('messages.button_subscribe')}}</i></button>
                                </div>

                            </form>
                        </div>
                    </div>
                    <!-- row end -->
                    <div class="clearfix"></div>
                </div>
            </div>

        </div>
    </div>
    <!-- /page content -->
@endsection
@section('extrascript')
    <script src="{{ URL::asset('assets/js/select2.full.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/switchery.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/dataTables.fixedHeader.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/responsive.bootstrap.min.js')}}"></script>
    <!-- validator -->
    <script>
        $(document).ready(function () {
            $('#btnsave').hide();
            $(".subject").select2({
                placeholder: "",
                allowClear: true
            });


            //get students lists
            $('#subject_id').on('change', function () {
                var sub = $('#subject_id').val();
                if (!sub) {
                    new PNotify({
                        title: '{{trans('messages.validation_error')}}!',
                        text: '{{trans('messages.registration_text7')}}!',
                        type: 'error',
                        styling: 'bootstrap3'
                    });
                } else {
                    $.ajax({
                        url: '/students/subject/' + sub,
                        type: 'get',
                        dataType: 'json',
                        success: function (data) {
                            //console.log(data);
                            if (data.students.length > 0) {
                                $('#btnsave').show();
                            } else {
                                $('#btnsave').hide();
                            }
                            $("#studentList").dataTable().fnDestroy();
                            var studentIds = [];
                            $("#studentList").find("tr:gt(0)").remove();
                            $.each(data.registeredStudents, function (key, value) {
                                studentIds.push(value.students_id);
                            });

                            $.each(data.students, function (key, value) {
                                if (!studentIds.includes(value.id)) {
                                    addRow(value.id, value.firstName + ' ' + value.middleName + ' ' + value.lastName, value.idNo, false);
                                }
                            });


                            $('#studentList').DataTable({
                                responsive: true,
                            });

                            var elems = Array.prototype.slice.call(document.querySelectorAll('.tb-switch'));
                            elems.forEach(function (html) {
                                var switchery = new Switchery(html);
                            });
                        },
                        error: function (data) {
                            var respone = JSON.parse(data.responseText);
                            $.each(respone.message, function (key, value) {
                                new PNotify({
                                    title: 'Error!',
                                    text: value,
                                    type: 'error',
                                    styling: 'bootstrap3'
                                });
                            });
                        }
                    });
                }
            });

            $('#studentList').DataTable({
                responsive: true,
            });
        });

        //add row to table
        function addRow(id, stdname, idNo, flag) {
            var table = document.getElementById('tbodyid');
            var rowCount = table.rows.length;
            var row = table.insertRow(rowCount);


            var cell2 = row.insertCell(0);
            var regiNo = document.createElement("label");

            regiNo.innerHTML = id;
            cell2.appendChild(regiNo);
            var hdregi = document.createElement("input");
            hdregi.name = "ids[]";
            hdregi.value = id;
            hdregi.type = "hidden";
            cell2.appendChild(hdregi);

            var cell4 = row.insertCell(1);
            var name = document.createElement("label");
            name.innerHTML = stdname;
            cell4.appendChild(name);


            var cell6 = row.insertCell(2);
            var dateBox = document.createElement("input");
            dateBox.type = "date";
            dateBox.name = "dateToLearn";
            dateBox.onchange = function () {
                dateBox.value = dateBox.value;
                dateBox.name = "dateToLearn";
            };
            dateBox.value = dateBox.value;
            cell6.appendChild(dateBox);

            var cell5 = row.insertCell(3);
            var chkbox = document.createElement("input");
            chkbox.type = "checkbox";
            chkbox.checked = flag;
            chkbox.className = "js-switch tb-switch";
            chkbox.name = "registeredIds[" + id + "]";
            chkbox.size = "3";
            cell5.appendChild(chkbox);

            var inputs = $('input[type=date]');



        };




    </script>
@endsection