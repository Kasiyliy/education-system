@extends('layouts.master')


@section('title', 'Студент-изменение')
@section('extrastyle')
    <link href="{{ URL::asset('assets/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/green.css')}}" rel="stylesheet">

@endsection

@section('content')

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">



        <div class="row">

          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
               <h2>Student<small> Student Information Update</small></h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">

          <form id="myForm" class="form-horizontal form-label-left" novalidate method="post" action="{{URL::route('student.update',$student->id)}}" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            	<input name="_method" type="hidden" value="PATCH">
                <!-- Smart Wizard -->
                <p class="text-danger">Fill up the forms with correct information and click next. * Feilds are required.</p>
                <div id="wizard" class="form_wizard wizard_horizontal">
                  <ul class="wizard_steps">
                    <li>
                      <a href="#step-2">
                        <span class="step_no">2</span>
                        <span class="step_descr">
                                        Student Information
                                      </span>
                      </a>
                    </li>
                  </ul>

                  <div id="step-2">
                    <div class="row">
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <label for="firstName">First Name *:</label>
                          <input type="text" id="firstName" class="form-control has-feedback-left" name="firstName" value="{{$student->firstName}}" required />
                          <i class="fa fa-user form-control-feedback left" aria-hidden="true"></i>
                          <span id="msg_firstName" class="text-danger" ></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <label for="middleName">Middle Name :</label>
                          <input type="text" id="middleName" class="form-control has-feedback-left" name="middleName" value="{{$student->middleName}}" required />
                          <i class="fa fa-user form-control-feedback left" aria-hidden="true"></i>
                          <span id="msg_middleName" class="text-danger" ></span>

                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <label for="lastName">Last Name *:</label>
                          <input type="text" id="lastName" class="form-control has-feedback-left" name="lastName" value="{{$student->lastName}}" required />
                          <i class="fa fa-user form-control-feedback left" aria-hidden="true"></i>
                          <span id="msg_lastName" class="text-danger" ></span>

                      </div>

                      <div class="col-md-2 col-sm-6 col-xs-12">
                          <label for="gender">Gender *:</label>
                          <p>
                            Male:
                            @if($student->gender=="Male")
                            <input type="radio" class="flat" name="gender" id="genderM" value="Male" checked=""  /> Female:
                            <input type="radio" class="flat" name="gender" id="genderF" value="Female" />
                          @else
                            <input type="radio" class="flat" name="gender" id="genderM" value="Male"   /> Female:
                            <input type="radio" class="flat" name="gender" id="genderF" value="Female" checked="" />
                          @endif
                          </p>
                      </div>
                    </div>
                    <div class="row">

                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <label for="dob">Date of birth *:</label>
                          <input type="text" name="dob" id="dob" class="form-control has-feedback-left" value="{{$student->dob->format('d/m/Y')}}" data-inputmask="'mask': '99/99/9999'" required>
                            <i class="fa fa-calendar form-control-feedback left" aria-hidden="true"></i>
                            <span id="msg_dob" class="text-danger" ></span>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="mobileNo">Mobile No *:</label>
                            <input type="text" id="mobileNo" class="form-control has-feedback-left" data-inputmask="'mask': '880 9999999999'" value="{{$student->mobileNo}}" name="mobileNo" required />
                            <i class="fa fa-phone form-control-feedback left" aria-hidden="true"></i>
                            <span id="msg_mobileNo" class="text-danger" ></span>

                        </div>
                    </div>

                  </div>

                </div>
                <!-- End SmartWizard Content -->
             </form>
              </div>
            </div>
          </div>
        </div>
          <div class="clearfix"></div>
      </div>
    </div>
        <!-- /page content -->
@endsection
@section('extrascript')

<script src="{{ URL::asset('assets/js/jquery.smartWizard.js')}}"></script>
<script src="{{ URL::asset('assets/js/select2.full.min.js')}}"></script>
<script src="{{ URL::asset('assets/js/icheck.min.js')}}"></script>
<script src="{{ URL::asset('assets/js/jquery.inputmask.bundle.min.js')}}"></script>
<script src="{{ URL::asset('assets/js/validator.min.js')}}"></script>

   <script>
   $(document).ready(function() {
    $('#wizard').smartWizard({transitionEffect:'slideleft',onLeaveStep:leaveAStepCallback,onFinish:onFinishCallback,enableFinishButton:true});
    $('.buttonNext').addClass('btn btn-success');
    $('.buttonPrevious').addClass('btn btn-primary');
    $('.buttonFinish').addClass('btn btn-default');
    $('.buttonFinish').attr('id','btnFinished');
    function leaveAStepCallback(obj){
        var step_num= obj.attr('rel');
        if(step_num==4)
          return true;
        return validateSteps(step_num);
      }

      function onFinishCallback(){
       if(validateAllSteps()){
         var form = $('form')[0];
         var formData = new FormData(form);
        $.ajax({
          type: 'POST',
          dataType: 'json',
          url: $('form').attr('action'),
          data: formData,
          contentType: false,
          cache: false,
          processData:false,
          success: function(data) {
            $('#myForm').trigger("reset");
            new PNotify({
                  title: "Data Update",
                  text: data.message,
                  type: 'success',
                  styling: 'bootstrap3'
            });
            setTimeout(function() {
            window.location.href = '/student'
          },1000);

          },
          error: function(data){
            var respone = JSON.parse(data.responseText);
            $.each(respone.message, function( key, value ) {
                new PNotify({
                      title: key,
                      text: value,
                      type: 'error',
                      styling: 'bootstrap3'
                });
            });

        }

      });
    }
      }
      $('form').on('reset', function(e)
      {
          setTimeout(function() {
          $('#myForm :radio').iCheck('update');
          $("#wizard").smartWizard('goToStep', 1);
          $("select").each(function () { //added a each loop here
              $(this).select2('val', '')
          });
      });
      });
    $(".select2_single").select2({
        placeholder: "Select a Option",
         allowClear: true
    });
$(":input").inputmask();

   function validateAllSteps(){
       var isStepValid = true;

       if(validateStep1() == false){
         isStepValid = false;
         $('#wizard').smartWizard('setError',{stepnum:1,iserror:true});
       }else{
         $('#wizard').smartWizard('setError',{stepnum:1,iserror:false});
       }

       if(validateStep2() == false){
         isStepValid = false;
         $('#wizard').smartWizard('setError',{stepnum:2,iserror:true});
       }else{
         $('#wizard').smartWizard('setError',{stepnum:2,iserror:false});
       }
       if(validateStep3() == false){
         isStepValid = false;
         $('#wizard').smartWizard('setError',{stepnum:3,iserror:true});
       }else{
         $('#wizard').smartWizard('setError',{stepnum:3,iserror:false});
       }


       if(!isStepValid){
          $('#wizard').smartWizard('showMessage','Please correct the errors in the steps and continue');
       }

       return isStepValid;
    }


		function validateSteps(step){
		  var isStepValid = true;
      // validate step 1
      if(step == 1){
        if(validateStep1() == false ){
          isStepValid = false;
          $('#wizard').smartWizard('showMessage','Please correct the errors in step '+step+ ' and click next.');
          $('#wizard').smartWizard('setError',{stepnum:step,iserror:true});
        }else{
          $('#wizard').smartWizard('setError',{stepnum:step,iserror:false});
          $('.msgBox').hide();
        }
      }
      // validate step 2
      if(step == 2){
        if(validateStep2() == false ){
          isStepValid = false;
          $('#wizard').smartWizard('showMessage','Please correct the errors in step '+step+ ' and click next.');
          $('#wizard').smartWizard('setError',{stepnum:step,iserror:true});
        }else{
          $('#wizard').smartWizard('setError',{stepnum:step,iserror:false});
          $('.msgBox').hide();
        }
      }
      // validate step3
      if(step == 3){
        if(validateStep3() == false ){
          isStepValid = false;
          $('#wizard').smartWizard('showMessage','Please correct the errors in step '+step+ ' and click next.');
          $('#wizard').smartWizard('setError',{stepnum:step,iserror:true});
        }else{
          $('#wizard').smartWizard('setError',{stepnum:step,iserror:false});
          $('.msgBox').hide();

        }
      }

      return isStepValid;
    }

		function validateStep1(){
       var isValid = true;
       var dep = $('#department_id').val();
       var ses = $('#session').val();
       var sec = $('#bncReg').val();
       var id = $('#idNo').val();
       if(!dep){
         isValid = false;
         $('#msg_department_id').html('Please select department!').show();
       }else{
         $('#msg_department_id').html('').hide();
       }
       if(!ses){
         isValid = false;
         $('#msg_session').html('Please write session!').show();
       }else{
         $('#msg_session').html('').hide();
       }
       if(!sec){
         isValid = false;
         $('#msg_bncReg').html('Please write BNC Reg. no!').show();
       }else{
         $('#msg_bncReg').html('').hide();
       }

       if(!id){
         isValid = false;
         $('#msg_idNo').html('Please write ID no!').show();
       }else{
         $('#msg_idNo').html('').hide();
       }
       return isValid;
    }
    function validateStep2(){
       var isValid = true;
       var fn = $('#firstName').val();
       var ln = $('#lastName').val();
       var bl = $('#bloodgroup').val();
       var rl = $('#religion').val();
       var nl = $('#nationality').val();
       var dob = $('#dob').val();
       var cell = $('#mobileNo').val();
       if(!fn){
         isValid = false;
         $('#msg_firstName').html('Please write first name!').show();
       }else{
         $('#msg_firstName').html('').hide();
       }
       if(!ln){
         isValid = false;
         $('#msg_lastName').html('Please write last name!').show();
       }else{
         $('#msg_lastName').html('').hide();
       }
       if(!bl){
         isValid = false;
         $('#msg_bloodgroup').html('Please select blood group!').show();
       }else{
         $('#msg_bloodgroup').html('').hide();
       }
       if(!rl){
         isValid = false;
         $('#msg_religion').html('Please write religion!').show();
       }else{
         $('#msg_religion').html('').hide();
       }
       if(!nl){
         isValid = false;
         $('#msg_nationality').html('Please write nationality!').show();
       }else{
         $('#msg_nationality').html('').hide();
       }
       if(!dob){
         isValid = false;
         $('#msg_dob').html('Please write date of birth!').show();
       }else{
         $('#msg_dob').html('').hide();
       }
       if(!cell){
         isValid = false;
         $('#msg_mobileNo').html('Please write mobile no!').show();
       }else{
         $('#msg_mobileNo').html('').hide();
       }
       return isValid;
    }
    function validateStep3(){
      var isValid = true;
      var fn = $('#fatherName').val();
      var fnc = $('#fatherMobileNo').val();
      var mn = $('#motherName').val();
      var mnc = $('#motherMobileNo').val();
      var pra = $('#presentAddress').val();
      var paa = $('#parmanentAddress').val();
      if(!fn){
        isValid = false;
        $('#msg_fatherName').html('Please write father name!').show();
      }else{
        $('#msg_fatherName').html('').hide();
      }
      if(!fnc){
        isValid = false;
        $('#msg_fatherMobileNo').html('Please write father mobile no!').show();
      }else{
        $('#msg_fatherMobileNo').html('').hide();
      }
      if(!mn){
        isValid = false;
        $('#msg_motherName').html('Please write mother name!').show();
      }else{
        $('#msg_motherName').html('').hide();
      }
      if(!mnc){
        isValid = false;
        $('#msg_motherMobileNo').html('Please write mother mobile no!').show();
      }else{
        $('#msg_motherMobileNo').html('').hide();
      }
      if(!pra){
        isValid = false;
        $('#msg_pra').html('Please write present address!').show();
      }else{
        $('#msg_pra').html('').hide();
      }
      if(!paa){
        isValid = false;
        $('#msg_paa').html('Please write parmanent address!').show();
      }else{
        $('#msg_paa').html('').hide();
      }
      return isValid;
    }


  });
   </script>

@endsection
