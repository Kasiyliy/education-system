@extends('layouts.master')

@section('title', 'Student')
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
                    <h2>Students<small> Student information.</small></h2>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="row">
                      <div class="col-md-3 col-sm-12 col-xs-12">
                       <h3>{{$student->firstName}} {{$student->middleName}} {{$student->lastName}}</h3>

                       <ul class="list-unstyled user_data">
                         <li><i class="fa fa-map-marker user-profile-icon"></i> {{$student->presentAddress}}
                         </li>
                         <li><i class="fa fa-phone user-profile-icon"></i> {{$student->mobileNo}}
                         </li>
                       </ul>

                       <a class="btn btn-success" href="{{URL::route('student.edit',$student->id)}}"><i class="fa fa-edit m-right-xs"></i> Edit Infomation</a>
                       <br />
                    </div>
                      <div class="col-md-9 col-sm-12 col-xs-12">

                       <div class="" role="tabpanel" data-example-id="togglable-tabs">
                         <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                           <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Basic Info</a>
                           </li>
                         </ul>
                         <div id="myTabContent" class="tab-content">
                           <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                             <ul class="list-unstyled">
                               <li>
                                 <i class="fa fa-2x fa-user"></i> <strong>Name: </strong> {{$student->firstname}} {{$student->middleName}} {{$student->lastName}}
                               </li>
                               <li>
                                 @if($student->gender=="Male")
                                 <i class="fa fa-2x fa-male"></i> <strong>Gender: </strong>  {{$student->gender}}
                               @else
                                 <i class="fa fa-2x fa-female"></i> <strong>Gender: </strong>  {{$student->gender}}

                               @endif
                               </li>
                               <li>
                                 <i class="fa fa-2x fa-calendar"></i> <strong>Date Of Birth: </strong>  {{$student->dob->format('F j, Y')}}
                               </li>
                               <li>
                                 <i class="fa fa-2x fa-phone"></i> <strong>Mobile No: </strong>  {{$student->mobileNo}}
                               </li>
                             </ul>
                           </div>
                         </div>
                       </div>
                     </div>
                   </div>
                 </div>
               </div>


                  </div>
                </div>
              </div>
            </div>
              <!-- row end -->
              <div class="clearfix"></div>

          </div>
        </div>
        <!-- /page content -->
@endsection
