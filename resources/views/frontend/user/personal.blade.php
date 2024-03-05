@extends('frontend.layouts.step')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))
@push('after-styles')
<link rel="stylesheet" href="{{asset('step/assets/css/after-login-style.css')}}">
<style>

</style>
@endpush
@section('content')
<div class="container mt-0 mb-5">
		    	<div class="row ">
            <div class="col-md-12 text-right">  <a href="{{route('frontend.user.personal.details')}}?id={{$user->id}}"><button type="button" class="btn btn-primary next">Edit profile</button></a>
</div>
				    <div class="col-md-6">
              <div class="p-detail">
                <p class="txt-b">First Name</p>
                <p class="bold-txt">{{$user->first_name}} </p>
                <p class="txt-b">Date of Birth</p>
                <p class="bold-txt">{{$user->date_of_birth}}</p>
                <p class="txt-b">Cell Phone (SMS enabled)<a href="javascript:void(0)" onclick="changeOTPVerify('mobile');">Change</a></p>
                <p class="bold-txt">{{$user->mobile_no}}</p>
                <p class="txt-b">Alternate Phone </p>
                <p class="bold-txt">{{$user->alternate_phone}}</p>
              </div>
              <!-- <label for="fname">Language Preference</label>
                <select name="language" id="language">
                    <option value="">English (EN)</option>
                    <option value="">Français (FR)</option>
                    
                  </select> -->

				    </div>
				    <div class="col-md-6">   
              <div class="p-detail">
                <p class="txt-b">Last Name</p>
                <p class="bold-txt">{{$user->last_name}}</p>
                <p class="txt-b">Gender</p>
                <p class="bold-txt">{{$user->gender}}</p>
                @if($user->avatar_type == 'google')
                <p class="txt-b">Email Id <small>(*You are signed up using "login with google so you can't change gmail")</small></p>
                @else
                <p class="txt-b">Email Id <a href="javascript:void(0)" onclick="changeOTPVerify('email');">Change</a></p>

                @endif
                <p class="bold-txt">{{$user->email}}</p>
              </div>
            </div>
 
			
			</div>
		</div>


  
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update personal details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form  id="personal-form" action="{{route('frontend.auth.step.personal.update')}}" method="post" enctype='multipart/form-data'>
      @csrf
          <div class="form-group">
            <label for="first_name" class="col-form-label">First Name:</label>
            <input type="text" name="first_name" class="form-control" value="{{$user->first_name}}" id="first_name">
          </div>
          <div class="form-group">
            <label for="last_name" class="col-form-label">Last Name:</label>
            <input type="text" name="last_name" class="form-control" value="{{$user->last_name}}" id="last_name">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Gender:</label>
            
                
                <div class="gender-div">
                    <span class="gender">
                        <input type="radio" name="gender" {{ ( $auth->gender == 'Male') ? 'checked' : ''}} value="Male" required>
                        <label>Male</label>
                    </span>
                    <span class="gender">
                        <input type="radio" name="gender" {{ ( $auth->gender == 'Female') ? 'checked' : ''}} value="Female" required>
                        <label>Female</label>
                    </span>
                    <span class="gender">
                        <input type="radio" name="gender" {{ ( $auth->gender == 'Prefer to not share') ? 'checked' : ''}} value="Prefer to not share" required>
                        <label>Prefer to not share</label>
                    </span>
                </div>
                    
          </div>
          <div class="row form-group">
            <div class="col-md-12">
              <label for="lname">Date Of Birth</label>
              <p class="info">You must be at least 14 year old.</p>
              <span class="dob">
                <input type="text" class="form-control orderUnits" name="month" value="{{$auth->dob('month')}}"  placeholder="MM" maxlength="2"  required />

                <input type="text" class="form-control orderUnits1" name="date"  value="{{$auth->dob('day')}}" placeholder="DD" maxlength="2"  required />

                <input type="text" class="form-control orderUnits2"  name="year"  value="{{$auth->dob('year')}}"  placeholder="YYYY" maxlength="4"  required />
              </span>
            </div>
          </div>




        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="document.getElementById('personal-form').submit()">Update</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Cell Phone/Email Change</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form  id="personal-form" action="{{route('frontend.user.personal.email.phone.change')}}" method="post" enctype='multipart/form-data'>
      @csrf
          <div class="form-group mobile_no" style="display:none">
            <label for="mobile_no" class="col-form-label">Mobile Number:</label>
            <input type="text" name="mobile_no" class="form-control"  id="mobile_no">
          </div>
          <div class="form-group email" style="display:none">
            <label for="email" class="col-form-label">Email:</label>
            <input type="text" name="email" class="form-control"  id="email">
          </div>
          <div class="form-group otp-box " style="display:none">
            <label for="otp" class="col-form-label">OTP:</label>
            <input type="text" name="otp" class="form-control"  id="otp">
          </div>
         
          
      
          <div class="margin-t-l">
              <span id="error-msg" class="p-2 float-left"></span>
              <button type="button" class="btn btn--full btn--brand txt-defaultcase lineheight-reset request-otp">OTP Verfiy</button>
              <button type="submit" class="btn btn--full btn--brand txt-defaultcase lineheight-reset register-submit" style="display:none">Update</button>

          </div>



        </form>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
@endsection

@push('after-scripts')
<script>
         function changeOTPVerify(type){

swal({
    title: "Do you want to make changes?",
    text: "",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Yes",
    closeOnConfirm: false
    },
    function(){
      swal.close();
      console.log(type);
      if(type == 'email'){
        $('.email').show();
        $('.mobile_no').hide();
        $('.request-otp').hide(); 
        $('.otp-box').hide();
        $('.register-submit').show(); 

      }else if(type == 'mobile'){

        $('.email').hide();
        $('.mobile_no').show();
        $('.register-submit').hide(); 
        $('.request-otp').show(); 

      }
      $('#exampleModalCenter').modal();
       
                   
    });

}   
$(function() {

      $('.request-otp').click(function(e) {
                  e.preventDefault();
                  $("#error-msg").text('');
                  // Get the phone number and OTP
                  var phone = $('#mobile_no').val();
                  var email = $('#email').val();
                  var dialing_code = "{{$auth->dialing_code}}";
                  console.log("{{ route('frontend.user.personal.send.otp') }}");
                //   var otp = $('#otp').val();
                    if(phone && phone.length < 10){
                        $("#error-msg").text('Phone number should be a 10 digit.');
                    } 
                    var tokenn = "{{ csrf_token() }}";
                  console.log(tokenn);
                    $.ajax({
                      type: 'POST',
                      url: "{{ route('frontend.user.personal.send.otp') }}", 
                      data: {_token:tokenn,mobile_no:phone,dialing_code:dialing_code,email:email},
                      success: function(response) {
                        console.log(response);
                        response = JSON.parse(response);
                              console.log(response.otp);
                              if (response.error == 0 ) {
                                if(response.status == 'exist'){
                                   // location.href = response.route;
                                }
                                console.log(response);
                                $('.otp-box').show(); 
                                $('.genrated-otp').text(response.otp); 
                                $('.request-otp').hide(); 
                                $('.register-submit').show(); 
                                
                              }else{
                                $("#error-msg").text(response.message);
                              }
                            
                                                         
                          }
                      });
                });

       
     
    });



 

      </script>
@if(config('access.captcha.login'))

@captchaScripts
@endif
@endpush