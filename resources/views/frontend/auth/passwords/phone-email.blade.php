@extends('frontend.layouts.website')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))
@push('after-styles')
<style>
  p.text-subtitle {
      font-size: 15px;
  }
  .phone-rest-email .card-header {
    background-color: #8ac03d !important;
    }
    button.btn:hover {
    background-color: #fff;
    color: #638e3c;
    border-color: #8ac03d;
}
button.btn {
    background: #8ac03d;
    border-color: #8ac03d;
    transition: 0.9s;
}
.login-register a:hover {
    background: #8ac03d;
    color: #fff;
}
.login-register a {
    font-size: 18px;
    color: #638e3c;
    text-decoration: unset;
    border: 1px solid;
    padding: 1px 7px;
    border-radius: 0.25rem;
    transition: 0.9s;
}
  </style>
@endpush
@section('content')
              <!-- <header  class="nav-header__secondary bg-white nav-header__secondary--shadow top-reset">
                <div >
                  <div  class="landing-wrapper">
                    <div  class="padding-reset-l padding-reset-r card__header">
                      <div  class="row row--middle center-xs row--nowrap row--nogutters">
    
                        <div  class="column full-height column--xs">
                          <div  class="row center-xs">
                            <div  class="border-focus-visible">
                              <div  class="pp-logo">
                                <a href="#">
                                  <img  alt="" height="90" class="pp-logo__default" src="{{asset('website/assets/images/logo-removebg.png')}}">
                                </a>
                              </div>
                            </div>
                          </div>

                        </div>

                      </div>
                    </div>
                  </div>
                </div>

              </header> -->
             
<div class="wrapper wrapper--small phone-rest-email">
    <div class="content--x-small" style="padding-top: 8rem;">
        
        <!-- @php 

        if(isset($user)){
          print_r($user);
        }
        @endphp -->

        <section class="margin-t-xl">
            <div class="row">
                <div class="col-md-12">


                <div class="card " >
           
                @if(isset($user))
                    <form action="{{route('frontend.auth.password.phone.verify')}}" method="post" class="reset-form">
                @else    
                    <form action="{{route('frontend.auth.password.phone.post')}}" id="form-reset" method="post" class="reset-form">
                @endif
                    @csrf
                        <div class="card-header text-center h5 text-white bg-primary">Password Reset</div>
                        <div class="card-body px-5">
                            <p class="card-text py-2 text-center text-subtitle">
                                Enter your mobile number and we'll send you an sms with instructions to reset your password.
                            </p>
                            <div class="form-outline">
                                <label class="form-label" for="typeEmail">Phone Number</label>
                                <input type="text" name="mobile_no" id="typeEmail" value="{{ (isset($mobile_email)) ? $mobile_email : '' }}"  {{ (isset($user)) ? 'readonly' : '' }} class="form-control my-3 @error('mobile_no') is-invalid @enderror" rquired />
                                @error('mobile_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                
                                
                            </div>
                            @if(isset($user))
                            <div class="form-outline">
                                <label class="form-label" for="typeOtp">OTP</label>
                                <input type="text" name="otp" id="typeOtp" class="form-control my-3 @error('otp') is-invalid @enderror" rquired />
                               <span class="otp-msg" style="display:none">OTP is required.</span>
                                
                            </div>
                            @endif
                            <span class="error-msg"></span>
                        <input type="hidden" id="type" name="type" value="{{ (isset($type)) ? $type : ''}}" />
                            @if(isset($user))
                            <button type="button" class="btn btn-primary w-100 otp-validation">OTP Verify</button>
                            @else
                            <button type="submit" class="btn btn-primary w-100 reset-form-submit">Reset password</button>
                            @endif
                            <div class="d-flex justify-content-between mt-4 login-register">
                                <a class="login" href="{{route('frontend.auth.new.login')}}">Login</a>
                                <a class="register" href="{{route('frontend.index')}}">Register</a>
                            </div>
                        </div>
                    </form>    
                </div>
            
                   

                </div>
            </div>


       </section>

    </div>
</div>

@endsection

@push('after-scripts')



<script>
    $(document).ready(function() {
      //otp-validation
        $(".reset-form").parsley();
        $(".otp-validation").click(function() {
          event.preventDefault();
          
          if($('#typeOtp').val()){
            $('.otp-msg').fadeOut();
            $('.reset-form').submit();
          }else{
            $('.otp-msg').fadeIn();
          }
          

           


          

        });

           
        // $('.reset-form-submit').click(function(event){

        // event.preventDefault();
        // console.log('asfasfasddf sadfsaf sdf');
        // $('.reset-form').submit();
        // });
        $('.reset-form-submit').click(function(event){
          event.preventDefault();
            $('.reset-form-submit').removeAttr('disabled');
            $('.error-msg').text();
            var input = $('#typeEmail').val();
            var emailRegex = /^\S+@\S+\.\S+$/;
            var phoneRegex = /^\d+$/;
            if(!input){
              
             return false;

            }

            if (emailRegex.test(input)) {
                
                $('#type').val('email');
                // Add your logic for email handling here
            } else if (phoneRegex.test(input)) {
              $('#type').val('mobile');
                // Add your logic for phone number handling here
            } else {
              $('.error-msg').text('Invalid email or phone number format');
              return false;
            }
            console.log('It is the help tiei');
            $('.reset-form').submit();
            
        });
        
    });

</script>
@if(config('access.captcha.login'))
@captchaScripts
@endif
@endpush