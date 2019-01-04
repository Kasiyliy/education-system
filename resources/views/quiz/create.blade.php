@extends('layouts.master')

@section('title', 'Тесты')
@section('extrastyle')
    <link href="{{ URL::asset('assets/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/switchery.min.css')}}" rel="stylesheet">
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
                            <form id="quizForm" class="form-horizontal form-label-left custom-error" novalidate
                              method="post" action="{{URL::route('quiz.store')}}">

                            <div class="x_title">
                                <h2>
                                    Тесты
                                </h2>

                                <label class="pull-right">
                                </label>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <strong>Ошибка!</strong> Были выявлены ошибки с введенными данными.<br><br>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="item form-group">
                                            <label class="control-label" for="subject_id">Наименование<span
                                                        class="required">*</span>
                                            </label>

                                            <input id="name" type="text" class="form-control col-md-7 col-xs-12"  name="name" value="{{old('name')}}" required="required" type="text">
                                            <span class="text-danger">{{ $errors->first('name') }}</span>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="item form-group">
                                            <label class="control-label " for="department">Глобальный курс <span
                                                        class="required">*</span>
                                            </label>

                                            {!!Form::select('department_id', $departments, null, ['placeholder' => 'Pick a department','class'=>'select2_single department form-control has-feedback-left','required'=>'required','id'=>'department_id'])!!}
                                            <i class="fa fa-home form-control-feedback left" aria-hidden="true"></i>
                                            <span class="text-danger">{{ $errors->first('department_id') }}</span>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="item form-group">
                                            <label class="control-label" for="subject_id">Под курс <span
                                                        class="required">*</span>
                                            </label>

                                            {!!Form::select('subject_id',$subjects, null, ['placeholder' => 'Pick a Subject','class'=>'select2_single subject form-control has-feedback-left','required'=>'required' ,'id'=>'subject_id'])!!}
                                            <i class="fa fa-book form-control-feedback left" aria-hidden="true"></i>
                                            <span class="text-danger">{{ $errors->first('subject_id') }}</span>

                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="item form-group">
                                            <label class="control-label" for="description">Краткое описание теста<span class="required">*</span>
                                            </label>

                                            <textarea id="description" required="required" name="description" class="form-control col-md-7 col-xs-12">{{old('description')}}</textarea>
                                            <span class="text-danger">{{ $errors->first('description') }}</span>

                                        </div>
                                    </div>

                                    <div class="col-md-4">

                                        <button id="btnsave" type="submit"
                                                class="btn btn-success btn-attend center-margin"><i class="fa fa-check">
                                                Сохранить</i></button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table id="quizList"
                                                   class="table table-striped table-bordered table-hover">
                                                <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Наименование</th>
                                                    <th>Урок</th>
                                                    <th>Изменить</th>
                                                    <th>Удалить</th>
                                                </tr>
                                                </thead>
                                                <tbody id="quizBody">


                                                <tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </form>
                    </div>
                    <!-- row end -->


                </div>
            </div>
            <!-- /page content -->
            @endsection
            @section('extrascript')

                <script src="{{ URL::asset('assets/js/validator.min.js')}}"></script>
                <script src="{{ URL::asset('assets/js/select2.full.min.js')}}"></script>
                <script src="{{ URL::asset('assets/js/switchery.min.js')}}"></script>
                <script src="{{ URL::asset('assets/js/validator.min.js')}}"></script>
                <script src="{{ URL::asset('assets/js/moment.min.js')}}"></script>
                <script src="{{ URL::asset('assets/js/daterangepicker.js')}}"></script>
                <!-- validator -->
                <script>
                    $(document).ready(function () {

                        $('form')
                            .on('blur', 'input[required], input.optional, select.required', validator.checkField)
                            .on('change', 'select.required', validator.checkField)
                            .on('keypress', 'input[required][pattern]', validator.keypress);

                        $('form').submit(function (e) {
                            e.preventDefault();
                            var submit = true;

                            // evaluate the form using generic validaing
                            if (!validator.checkAll($(this))) {
                                var emptyCount = $('table#studentList :input').filter(function () {
                                    return $(this).val() == "" && $(this);
                                }).length;
                                if (emptyCount > 0) {
                                    new PNotify({
                                        title: 'Validation Error!',
                                        text: 'Please wite all students marks corretly!',
                                        type: 'error',
                                        styling: 'bootstrap3'
                                    });
                                }
                                submit = false;
                            }

                            if (submit)
                                this.submit();

                            return false;
                        });

                        <!-- /validator -->
                        $(".department").select2({
                            placeholder: "Выберите глобальный курс",
                            allowClear: true
                        });
                        $(".subject").select2({
                            placeholder: "Выберите урок",
                            allowClear: true
                        });
                        //get subject lists
                        $('#department_id').on('change', function () {
                            var dept = $('#department_id').val();
                            //for subjects
                            $.ajax({
                                url: '/subject/' + dept + '/1',
                                type: 'get',
                                dataType: 'json',
                                success: function (data) {
                                    //console.log(data);
                                    $('#subject_id').empty();
                                    $('#subject_id').append('<option  value="">Pick a Subject</option>');
                                    $.each(data.subjects.data, function (key, value) {
                                        $('#subject_id').append('<option  value="' + value.id + '">' + value.name + '[' + value.code + ']</option>');

                                    });
                                    $(".subject").select2({
                                        placeholder: "Выберите урок",
                                        allowClear: true
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
                        });
                        //fucntions

                        $('#subject_id').on('change', function () {
                            refreshTable();
                        });

                        function deleteModel(id){
                            $.ajax({
                                url: "/quiz/" + id,
                                type: 'delete',
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                },
                                dataType: 'json',
                                success: function (data) {
                                    refreshTable();
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

                        //add row to table
                        function addRow(id, stdname, subject) {
                            var table = document.getElementById('quizList');
                            var rowCount = table.rows.length;
                            var row = table.insertRow(rowCount);

                            var cell0 = row.insertCell(0);
                            cell0.innerHTML = id;

                            var cell1 = row.insertCell(1);
                            cell1.innerHTML = stdname;

                            var cell2 = row.insertCell(2);
                            cell2.innerHTML = subject;

                            var cell3 = row.insertCell(3);
                            var editBtn = document.createElement('a');
                            editBtn.className = 'btn btn-warning';
                            editBtn.innerHTML = 'изменить';
                            editBtn.href = '/quiz/' + id + '/edit';
                            cell3.appendChild(editBtn);

                            var cell4 = row.insertCell(4);
                            var refBtn = document.createElement('a');
                            refBtn.className = 'btn btn-danger';
                            refBtn.innerHTML = 'удалить';
                            refBtn.addEventListener('click' , function(){
                                deleteModel(id);
                            });
                            cell4.appendChild(refBtn);
                        };

                        function removeAllRows(){
                            $("#quizList").find("tr:gt(0)").remove();
                        };

                        function refreshTable() {
                            removeAllRows();
                            var subj = $('#subject_id').val();
                            $.ajax({
                                url: "{{URL::route('quiz.index3')}}",
                                type: 'get',
                                data: {
                                    'subject_id': subj,
                                },
                                dataType: 'json',
                                success: function (data) {

                                    $.each(data.quizes, function (key, value) {
                                        addRow(value.id, value.name ,value.subjectName);
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
                        };


                    });


                </script>
@endsection
