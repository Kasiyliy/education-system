@extends('layouts.master')


@section('title', 'Информационная панель')

@section('content')

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <!-- /top tiles -->
            <div class="row tile_count text-center">
              <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-2x fa-home green"></i>{{trans('messages.disciplina')}}</span>
                <div class="count red">{{$total["department"]}}</div>
              </div>
              <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-2x fa-users green"></i>{{trans('messages.student')}}</span>
                <div class="count blue">{{$total["admitted"]}}</div>
              </div>
              <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-2x fa-book green"></i>{{trans('messages.courses')}}</span>
                <div class="count red">{{$total["subject"]}}</div>
              </div>
            </div>
            <!-- /top tiles -->
            <!-- Graph start -->
<div class="clearfix"></div>
          </div>
        </div>
        <!-- /page content -->

@endsection
@section('extrascript')
<script src="{{ URL::asset('assets/js/Chart.min.js')}}"></script>
  <!-- Chart.js -->

@endsection