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
                    <form action="{{route('frontend.auth.password.phone.post')}}" method="post" class="reset-form">
                @endif
                    @csrf
                        <div class="card-header text-center h5 text-white bg-primary">Password Reset</div>
                        <div class="card-body px-5">
                            <p class="card-text py-2 text-center text-subtitle">
                                Enter your mobile number/email address and we'll send you an sms/email with instructions to reset your password.
                            </p>
                            <div class="form-outline">
                                <label class="form-label" for="typeEmail">Phone/Email Address</label>
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
                                
                                
                                
                            </div>
                            @endif
                            @if(isset($user))
                            <button type="submit" class="btn btn-primary w-100">OTP Verify</button>
                            @else
                            <button type="submit" class="btn btn-primary w-100">Reset password</button>
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
@if(config('access.captcha.login'))
@captchaScripts
@endif
@endpush