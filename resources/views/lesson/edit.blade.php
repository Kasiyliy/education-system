@extends('layouts.master')

@section('title', 'Урок | Изменить')

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
                    <h2>{{trans('messages.presentation_text15')}}<small> {{trans('messages.presentation_text16')}}</small></h2>
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


                    <form class="form-horizontal" method="post" action="{{URL::route('lesson.update',['id' =>$lesson->id] )}}">
                    {{csrf_field()}}
                        <input name="_method" type="hidden" value="PUT">
                        <div class="form-group">
                      <label for="name">{{trans('messages.presentation_text3')}}</label>
                      <input type="text" class="form-control" value="{{$lesson->name}}" name="name" id="name" required>
                    </div>
                    <div class="form-group">
                      <label for="description">{{trans('messages.presentation_text4')}}</label>
                      <textarea rows="5" class="form-control"  name="description" id="description" required>{{$lesson->description}}</textarea>
                    </div>
                        <button type = "submit" class = "btn btn-success">{{trans('messages.button_change')}}</button>
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


     $('form').submit(function(e) {
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
