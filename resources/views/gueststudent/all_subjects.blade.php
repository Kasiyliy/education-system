@extends('layouts.guest_student_master')

@section('title', 'ASTCGlobal')

@section('content')

  <div class="container-fluid">
    <div class="row">

        @foreach($subjects as $subject)
            <div class="col-sm-4 my-2">
                <div class="card mb-4 box-shadow">
                    <div class="card-header">
                        <h4 class="my-0 font-weight-normal">{{$subject->name}}</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">{{$subject->price}} <small class="text-muted">тг</small></h1>
                        <p>{{$subject->description}}</p>
                        <button type="button" class="btn btn-lg btn-block btn-primary">Contact us</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
  </div>

@endsection

@section('scripts')
  <script src="{{ URL::asset('assets/js/validator.min.js')}}"></script>

  <script>
      $('#iframe').ready(function() {
          setTimeout(function() {
              $('#iframe').contents().find('#download').remove();
          }, 100);
      });
  </script>
@endsection