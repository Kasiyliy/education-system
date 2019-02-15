@extends('layouts.master')


@section('title', 'Настройки')

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
                            <h2>Пользователь
                                <small> Информация о пользователе.</small>
                            </h2>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <form class="form-label-left" novalidate method="post"
                                  action="{{URL::route('user.postsettings')}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="for" value="info">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label" for="firstname">Имя <span
                                                        class="required">*</span>
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-info blue"></i></span>
                                                <input id="name" type="text" class="form-control" name="firstname"
                                                       value="{{$user->firstname}}" placeholder="Name"
                                                       required="required" type="text">
                                            </div>
                                            <span class="text-danger">{{ $errors->first('firstname') }}</span>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label" for="lastname">Фамилия <span
                                                        class="required">*</span>
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-info blue"></i></span>
                                                <input id="name" type="text" class="form-control" name="lastname"
                                                       value="{{$user->lastname}}" placeholder="Name"
                                                       required="required" type="text">
                                            </div>
                                            <span class="text-danger">{{ $errors->first('lastname') }}</span>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label" for="userName">Логин<span
                                                        class="required">*</span>
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-info blue"></i></span>
                                                <input type="text" disabled="disabled" class="form-control" name="login"
                                                       value="{{$user->login}}" placeholder="" required="required">
                                            </div>
                                            <span class="text-danger">{{ $errors->first('login') }}</span>
                                            <input type="hidden" name="user_id" value="{{$user->id}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label" for="group">Группа<span
                                                        class="required">*</span>
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-info blue"></i></span>
                                                @if($user->group == 'Teacher')
                                                    <input type="text" disabled="disabled" class="form-control"
                                                           name="group"
                                                           value="{{trans('messages.user_text10')}}"
                                                           placeholder="admin33"
                                                           required="required">

                                                @elseif($user->group == 'Student')
                                                    <input type="text" disabled="disabled" class="form-control"
                                                           name="group"
                                                           value="{{trans('messages.user_text11')}}"
                                                           placeholder="admin33"
                                                           required="required">

                                                @elseif($user->group == 'Admin')
                                                    <input type="text" disabled="disabled" class="form-control"
                                                           name="group"
                                                           value="{{trans('messages.admin')}}"
                                                           placeholder="admin33"
                                                           required="required">

                                                @endif
                                            </div>
                                            <span class="text-danger">{{ $errors->first('group') }}</span>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label" for="email">E-mail
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i
                                                            class="fa fa-envelope blue"></i></span>
                                                <input type="text" id="email" name="email"
                                                       placeholder="mrrepto@repto.co" value="{{$user->email}}"
                                                       class="form-control">
                                            </div>
                                            <span class="text-danger">{{ $errors->first('email') }}</span>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label" for="description">Описания
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-info blue"></i></span>
                                                <textarea id="description" name="description"
                                                          class="form-control col-md-7 col-xs-12">{{$user->description}}</textarea>
                                            </div>
                                            <span class="text-danger">{{ $errors->first('description') }}</span>

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-refresh">
                                            Обновить</i></button>
                                </div>
                            </form>

                            <hr>

                            <form class="form-label-left" novalidate method="post"
                                  action="{{URL::route('user.postsettings')}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="for" value="password">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label" for="oldpassword">Текущий пароль<span
                                                        class="required">*</span>
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-key blue"></i></span>
                                                <input id="name" class="form-control" name="oldpassword" value=""
                                                       required="required" type="password">
                                            </div>
                                            <span class="text-danger">{{ $errors->first('oldpassword') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label" for="password">Новый пароль<span
                                                        class="required">*</span>
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-key blue"></i></span>
                                                <input id="name" class="form-control" name="password" value=""
                                                       type="password">
                                            </div>
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label" for="confirmpassword">Подтвердить новый
                                                пароль<span class="required">*</span>
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-key blue"></i></span>
                                                <input type="password" class="form-control" name="password_confirmation"
                                                       value="" required="required">
                                            </div>
                                            <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-refresh">
                                            Изменить пароль</i></button>
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
    <script src="{{ URL::asset('assets/js/validator.min.js')}}"></script>
    <!-- validator -->
    <script>
        // initialize the validator function
        validator.message.date = 'not a real date';

        // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
        $('form')
            .on('blur', 'input[required], input.optional, select.required', validator.checkField)
            .on('change', 'select.required', validator.checkField)
            .on('keypress', 'input[required][pattern]', validator.keypress);


        $('form').submit(function (e) {
            e.preventDefault();
            var submit = true;

            // evaluate the form using generic validaing
            if (!validator.checkAll($(this))) {
                submit = false;
            }

            if (submit)
                this.submit();

            return false;
        });
    </script>
    <!-- /validator -->
@endsection
