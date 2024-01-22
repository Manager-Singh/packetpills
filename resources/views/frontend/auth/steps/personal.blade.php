@extends('frontend.layouts.step')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))
@push('after-styles')
<style>

.avatar-upload {
  position: relative;
  max-width: 124px;
  margin: 50px auto;
}
.avatar-upload .avatar-edit {
    position: absolute;
    right: 25px;
    z-index: 1;
    top: -4px;
}
.avatar-upload .avatar-edit input {
  display: none;
}
.avatar-upload .avatar-edit input + label {
    display: inline-block;
    width: 30px;
    height: 30px;
    margin-bottom: 0;
    border-radius: 100%;
    background: #FFFFFF;
    border: 1px solid transparent;
    box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
    cursor: pointer;
    font-weight: normal;
    transition: all 0.2s ease-in-out;
}
.avatar-upload .avatar-edit input + label:hover {
  background: #f1f1f1;
  border-color: #d6d6d6;
}
.avatar-upload .avatar-edit input + label:after {
    content: "\f040";
    font-family: 'FontAwesome';
    color: #638e3c;
    position: absolute;
    top: 8px;
    left: 0;
    right: 0;
    text-align: center;
    margin: auto;
}
.avatar-upload .avatar-preview {
    width: 100px;
    height: 100px;
    position: relative;
    border-radius: 100%;
    /* border: 2px solid #638e3c; */
    box-shadow: 0px 0px 6px 2px #638e3c;
}
.avatar-upload .avatar-preview > div {
  width: 100%;
  height: 100%;
  border-radius: 100%;
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center;
}

.avatar-upload label {
    margin: 8px 0;
}
.service-selection-btn {
    position: absolute;
    right: 0;
    z-index: 5;
    background: #8ac03d !important;
    border-color: #638e3c !important;
}
.personal-main {
    position: relative;
}
</style>
@endpush
@section('content')

<div class="container mt-3 mb-5 pt-2 personal-main">
<a class="btn btn-primary btn-sm service-selection-btn" href="{{route('frontend.auth.service.selection')}}"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Service Selection</a>
                <form name="myForm" class="row" enctype="multipart/form-data" id="personal-step" action="{{route('frontend.auth.step.personal.submit')}}" method="post">
                            @csrf
				    <div class="col-md-12">
              <div class="user-info">
                <!-- <img class="user-img" src="{{asset('step/assets/images/user.png')}}"> -->
                <div class="avatar-upload">
                    <div class="avatar-edit">
                        <input type='file' name="avatar_location" id="imageUpload" accept=".png, .jpg, .jpeg" />
                        <label for="imageUpload"></label>
                    </div>
                    <div class="avatar-preview">
                        <div id="imagePreview" style="background-image: url({{asset('step/assets/images/user.png')}});">
                        </div>
                    </div>
                </div>
                <p class="txt">Hi, I'm Alex, your pharmacist and I'll need some information to fill your orders & provide consultation.</p>
             
                

            </div>

				    </div>
            <div class="col-md-2">
</div>
				    <div class="col-md-8 mt-2">

                        
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="fname">First name</label>
                                    <input type="text" id="fname" name="first_name" value="{{$auth->first_name}}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="lname">Last name</label>
                                    <input type="text" id="lname" name="last_name" value="{{$auth->last_name}}"  required>
                                </div>
                                <div class="col-md-12">
                                    <label for="lname">Date Of Birth</label>
                                    <!-- <p class="info">You must be at least 14 year old.</p> -->
                                    <span class="dob">
                                        <input type="text" class="form-control orderUnits" name="month" value="{{$auth->dob('month')}}"  placeholder="MM" maxlength="2"  required />

                                        <input type="text" class="form-control orderUnits1" name="date"  value="{{$auth->dob('day')}}" placeholder="DD" maxlength="2"  required />

                                        <input type="text" class="form-control orderUnits2"  name="year"  value="{{$auth->dob('year')}}"  placeholder="YYYY" maxlength="4"  required />
                                    </span>
                                </div>

                                @if(!isset($auth->mobile_no) && empty($auth->mobile_no))

                                

                                <div class="row align-items-center">
                                    <div class="col-md-12">
                                        <label for="mobile_no">Mobile</label>
                                    </div>
                                    <div class="col-md-2" aria-label="Country code +1">
                                        
                                        <select class="form-control color-dark font-semibold" id="dialing-code" name="dialing_code">
                                            <option value="1">+1</option>
                                            <option value="91">+91</option>
                                        </select>
                                    </div>
                                    <div class="col-md-10">
                                        <input autocomplete="off" type="tel"
                                            oninput="javascript: if (this.value.length &gt; 10) this.value = this.value.slice(0, 10);"
                                            onkeypress="return (event.charCode &gt;= 48 &amp;&amp; event.charCode &lt;= 57) || event.charCode == 13"
                                            keyname="landing.fields.phone" contenteditable="true"
                                            class="home-input full-width font-semibold ng-untouched ng-pristine ng-invalid"
                                            id="phone-number"
                                            placeholder="10 digit phone number" aria-required="true"
                                            required="">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col otp-box hide" style="display:none;">
                                        <div class="form-group mt-4">
                                            <!-- {{ html()->label(__('validation.attributes.frontend.otp'))->for('otp') }} -->

                                            {{ html()->text('otp')->class('form-control w-100')->placeholder(__('validation.attributes.frontend.otp'))->attribute('id','otp')->attribute('maxlength', 6)->attribute('minlength', 6)->required() }}
                                            
                                        </div><!--form-group-->
                                    </div><!--col-->
                                </div><!--row-->
                            @else
                                <div class="col-md-12">
                                    <label for="mobile_no">Mobile</label>
                                    <input type="text" id="mobile_no" name="mobile_no" value="+{{$auth->dialing_code}}{{$auth->mobile_no}}" readonly required>
                                </div>
                            @endif

                            </div>

                            @if(!isset($auth->mobile_no) && empty($auth->mobile_no))
                                <!-- <input type="submit" class="next button" value="Verify Otp" /> -->

                                <span id="error-msg" class="p-2 float-left"></span>
                                <button type="button" class="next button lineheight-reset request-otp">Send OTP</button>
                                <button type="button" class="next button lineheight-reset register-submit" style="display:none">{{ __('labels.frontend.auth.otp_verfied') }}</button>
                            @else
                                <input type="submit" class="next button bb" value="Next" />
                            @endif
                            
                            <p class="info-bold">3 Hours delivery for emergency medicines.</p>
                          


                </div>
                <div class="col-md-2">
</div>

</form>
			
		</div>
@endsection

@push('after-scripts')

<script type="text/javascript">
    $(document).ready(function() {
        $("#personal-step").parsley();
        $("#imageUpload").change(function() {
            readURL(this);
        });

        $('.request-otp').click(function(e) {
            e.preventDefault();
            $("#error-msg").text('');
            // Get the phone number and OTP
            var phone = $('#phone-number').val();
            var dialing_code = $('#dialing-code').val();
            
        //   var otp = $('#otp').val();
            if(phone.length < 10){
                $("#error-msg").text('Phone number should be a 10 digit.');
            }
        //   console.log(phone);
            $.ajax({
                type: 'POST',
                url: "{{ route('frontend.user.personal.send.otp') }}", 
                data: {_token:"{{ csrf_token() }}",mobile_no:phone,dialing_code:dialing_code},
                success: function(response) {
                console.log(response);
                response = JSON.parse(response);
                        
                        if (response.error == 0 ) {

                            if(response.status == 'exist'){
                                // location.href = response.route;
                            }
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


    function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview').css('background-image', 'url('+e.target.result +')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}


document.getElementsByClassName("orderUnits")[0].addEventListener("input", amountofUnits);
document.getElementsByClassName("orderUnits1")[0].addEventListener("input", amountofUnits);
document.getElementsByClassName("orderUnits2")[0].addEventListener("input", amountofUnits);

function amountofUnits() {
   this.value = this.value.replace(/[^\d]/, '')
}

</script>


<script>
    $(function() {
        




                $('.register-submit').click(function(e) {
                  e.preventDefault();
  
                  // Get the phone number and OTP
                  var phone = $('#phone-number').val();
                  var otp = $('#otp').val();
                  var user_from = 'google';
                  var email = "{{(isset($auth->email)) ? $auth->email : ''}}";
                  $("#error-msg").text('');
                    if(otp.length < 6){
                        $("#error-msg").text('Otp should be a 6 digit.');
                    }
                //   console.log(phone);
                    $.ajax({
                      type: 'POST',
                      url: "{{ route('frontend.user.personal.email.phone.change') }}", 
                      data: {_token:"{{ csrf_token() }}",mobile_no:phone,otp:otp,user_from:user_from},
                      success: function(response) {
                        console.log(response);
                        console.log(response.link);
                        response = JSON.parse(response);
                              console.log(response);
                              if (response.profile_step == 0) {
                                window.location.reload();
                              }else{
                                $("#error-msg").text(response.message);
                              }
                             // window.location.reload();
                              $('.otp-box').show(); 
                              
                              $('.genrated-otp').text(response.otp); 
                              $('.request-otp').hide(); 
                              $('.register-submit').show(); 
                                                         
                          }
                      });
                });
        




    });

                
</script>
@if(config('access.captcha.login'))
@captchaScripts
@endif
@endpush
