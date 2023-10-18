@extends('frontend.layouts.website')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))
@push('after-styles')
<style>
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
@php 

$user ='';
$mobile_email ='';



  if(session()->has('user')){

    $user = Session::get('user');


  }
  if(session()->has('mobile_email')){

    $mobile_email = Session::get('mobile_email');

  }

@endphp
@section('content')
              <header  class="nav-header__secondary bg-white nav-header__secondary--shadow top-reset">
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

              </header>
             
<div class="wrapper wrapper--small phone-rest-email">
    <div class="content--x-small" style="padding-top: 8rem;">
        
       

        <section class="margin-t-xl">
            <div class="row">
                <div class="col-md-12">


                <div class="card " >
           
                    <form action="{{route('frontend.auth.password.save')}}" method="post" class="reset-form">
                
                    @csrf
                        <div class="card-header text-center h5 text-white bg-primary">Change Password</div>
                        <div class="card-body px-5">
                        <p class="card-text py-2 text-center">
                        {{(isset($mobile_email)) ? $mobile_email : ''}}
                        </p>
                            <div class="form-outline">
                                <label class="form-label" for="typePassword">New Password</label>
                                <input type="password" name="password" id="typePassword" value=""  class="form-control my-3 @error('password') is-invalid @enderror" rquired />
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                
                                
                            </div>
                            <div class="form-outline">
                                <label class="form-label" for="typeConfirmPassword">Confirm Password</label>
                                <input type="password" name="confirm_password" id="typeConfirmPassword" value=""  class="form-control my-3 @error('confirm_password') is-invalid @enderror" rquired />
                                @error('confirm_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                
                                
                            </div>
                           <input type="hidden" name="user_id" value="{{(isset($user)) ? $user->id : ''}}"/>
                           <input type="hidden" name="mobile_no" value="{{(isset($mobile_email)) ? $mobile_email : ''}}"/>
                            <button type="submit" class="btn btn-primary w-100">Update password</button>
                           
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