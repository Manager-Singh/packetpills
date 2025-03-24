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

.referl-form input[type=radio] {
    width: 50%;
}

.referl-form .radio-btn {
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
}

.referl-form .radio-label {
    display: inline-block;
    height: 25px;
    width: 25px;
    font-size: 16px;
    cursor: pointer;
    border: 2px solid #000;
    border-radius: 5px;
    background-color: white;
    color: #007bff;
    user-select: none;
    text-align: center;
    line-height: 25px;
}

.referl-form .radio-btn:checked + .radio-label {
    background-color: #8ac03d;
    color: white;
    position: relative;
}
.referl-form .radio-btn:checked + .radio-label::after {
    content: "✔";
    font-size: 35px;
    color: #212843;
    position: absolute;
    top: 12px;
    font-weight: 100;
    left: 20px;
    transform: translate(-50%, -50%);
}
.referl-form label {
    display: block;
}
.referl-form label.label {
    position: relative;
    left: 60px;
    top: -40px;
}
textarea#other-message {
    margin-top: -25px;
    margin-bottom: 20px;
    width: 100%;
    height: 120px;
}
div#refer-area input, div#refer-area  select {
    margin-bottom: 10px;
    padding: 8px 15px;
    font-size: 18px;
}

h2.where-title {
    margin-bottom: 35px;
}
</style>
@endpush
@section('content')

<div class="container mt-3 mb-5 pt-2 personal-main">
<a class="btn btn-primary btn-sm service-selection-btn" href="{{route('frontend.auth.service.selection')}}"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Service Selection</a>
                <form name="myForm" class="row" enctype="multipart/form-data" id="personal-step" action="{{route('frontend.auth.step.referral.update')}}" method="post">
                            @csrf
				    
                <div class="col-md-2">
                </div>
				    <div class="col-md-8 mt-2">

                        
                            <div class="row referl-form">
                                <h2 class="where-title">How Did You Find us?</h2>
                            <div class="col-md-6 ">
                                
                                    <input type="radio" id="referby" name="from_you_found" value="refer-by-user" class="radio-btn" onclick="show_fields('refer-area')" required>
                                    <label for="referby" class="radio-label"></label>                                    
                                    <label for="referby" class="label"><b>Personal Refer</b>  <i class="fa fa-info-circle" aria-hidden="true"></i></label>   

                                     <input type="radio" id="insta" name="from_you_found" value="instagram" class="radio-btn" onclick="show_fields('no-area')" required>
                                     <label for="insta" class="radio-label"></label>                       
                                    <label for="insta" class="label">Instagram</label>
                                    
                                    <input type="radio" id="twitter" name="from_you_found" value="twitter" class="radio-btn" onclick="show_fields('no-area')" required>                       
                                    <label for="twitter" class="radio-label"></label>
                                    <label for="twitter" class="label">Twitter</label>

                                    <input type="radio" id="tiktok" name="from_you_found" value="Tiktok" class="radio-btn" onclick="show_fields('no-area')" required>                       
                                    <label for="tiktok" class="radio-label"></label>
                                    <label for="tiktok" class="label">Tiktok</label>
                                    
                                                                         
                                        

                                    
                            </div>
                            <div class="col-md-6 ">

                                     <input type="radio" id="facebook" name="from_you_found" value="facebook" class="radio-btn" onclick="show_fields('no-area')" required>
                                    <label for="facebook" class="radio-label"></label>                                  
                                    <label for="facebook" class="label">Facebook</label>
                                    
                                    <input type="radio" id="email" name="from_you_found" value="Google/Search Engine" class="radio-btn" onclick="show_fields('no-area')"  required>
                                    <label for="email" class="radio-label"></label>                                    
                                    <label for="email" class="label">Google/Search Engine</label>
                                    
                                    <input type="radio" id="linkedin" name="from_you_found" value="Linkedin" class="radio-btn" onclick="show_fields('no-area')"  required>
                                    <label for="linkedin" class="radio-label"></label>                                    
                                    <label for="linkedin" class="label">Linkedin</label>

                                    <input type="radio" id="other" name="from_you_found" value="other" class="radio-btn" onclick="show_fields('other-area')" required>
                                    <label for="other" class="radio-label"></label>                                   
                                    <label for="other" class="label">Other</label>                               
                                    
                                    
                            </div>
                            
                            <div class="col-md-12 ">
                            <div id="other-area" style="display:none"> 
                                                <textarea id="other-message" name="other_message" placeholder="Other Platforms"></textarea>
                                            </div>                     
                                    
                            <div id="refer-area" style="display:none">
                            <p class="info-bold">Personal Refer by user.</p>
    
                            <label for="referral_source">Referral Source:</label>
                            <select id="referral_source" name="refred_by" required>
                                <option>Select Referral Source</option>
                                <option value="Friend/Family">Friend/Family</option>
                                <option value="Health Care Provider/Medical Staff">Health Care Provider/Medical Staff</option>
                            </select><br/>
                                <input type="text" id="name" name="name" value="" placeholder="Name" />
                                <input type="email" id="email" name="email" value="" placeholder="Email" />
                                <input type="phone" id="phone" name="contact_number" value="" placeholder="Contact Number" />
                            </div> 

                                    
                            </div>
                                <input type="submit" class="next button bb" value="Update Referral" />
                                <p class="info-bold">3 Hours delivery for emergency medicines.</p>
                            </div>

                      
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


        $("#pronouns").change(function() {
            var pronouns = $(this).val();
            if(pronouns && pronouns == 'Custom'){
                $('.custom-pronouns').fadeIn();
            }else{
                $('.custom-pronouns').fadeOut();
            }
        });


        

        $('.request-otp').click(function(e) {
            e.preventDefault();
            $("#error-msg").text('');
            // Get the phone number and OTP
            var phone = $('#phone-number').val();
            var dialing_code = $('#dialing-code').val();
            var user_from = 'google';
            
        //   var otp = $('#otp').val();
            if(phone.length < 10){
                $("#error-msg").text('Phone number should be a 10 digit.');
            }
        //   console.log(phone);
            $.ajax({
                type: 'POST',
                url: "{{ route('frontend.user.google.account.send.otp') }}", 
                data: {_token:"{{ csrf_token() }}",mobile_no:phone,dialing_code:dialing_code,user_from:user_from},
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

function show_fields(divId) {
    console.log(divId);
    // Hide all extra fields first
    $('#other-area, #refer-area').hide();

    // If divId is not "no-area", show the selected field
    if (divId !== 'no-area') {
        $('#' + divId).show();
    }
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
                  var dialing_code = $('#dialing-code').val();
                  $("#error-msg").text('');
                    if(otp.length < 6){
                        $("#error-msg").text('Otp should be a 6 digit.');
                    }
                //   console.log(phone);
                    $.ajax({
                      type: 'POST',
                      url: "{{ route('frontend.user.personal.email.phone.change') }}", 
                      data: {_token:"{{ csrf_token() }}",dialing_code:dialing_code,mobile_no:phone,otp:otp,user_from:user_from},
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
