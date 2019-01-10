@extends('layouts.guest_student_master')

@section('title', 'ASTCGlobal')

@section('content')

  <div class="container">
      <header class="jumbotron my-4">
          <h1 class="display-3">Добро пожаловать в страницу списка курсов!</h1>
          <p class="lead">
              Мы надеемся, что тут есть что-то подходящее именно для вас!
          </p>
      </header>

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