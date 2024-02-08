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
<style>
.password-pg img.user-img {
    border-radius: 50%;
    margin-bottom: 25px;
    width: 100px;
    height: 100px;
    border: unset;
    box-shadow: 0px 0px 17px -3px #638e3c;
    margin-right: 25px;
}
        span.toggle-password.LikePost {
            position: relative;
            top: -50px;
            right: 13px;
            float: right;
            font-size: 18px;
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
                               
                                <span class="toggle-password LikePost"><i class="far fa-eye"></i></span>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                
                                
                            </div>
                            <div class="form-outline">
                                <label class="form-label" for="typeConfirmPassword">Confirm Password</label>
                                <input type="password" name="confirm_password" id="typeConfirmPassword" value=""  class="form-control my-3 @error('confirm_password') is-invalid @enderror" rquired />
                                <span class="toggle-password LikePost"><i class="far fa-eye"></i></span>
                               
                                @error('confirm_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                
                                
                            </div>
                          
                            <input type="hidden" name="type" value="{{(isset($type)) ? $type : old('type') }}"/>
                           <input type="hidden" name="user_id" value="{{(isset($user->id)) ? $user->id : old('user_id') }}"/>
                           <input type="hidden" name="mobile_no" value="{{(isset($mobile_email) && !empty($mobile_email)) ? $mobile_email : old('mobile_no')}}"/>
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
<script>
  // Add a click event listener to elements with the class "LikePost"
  $('.LikePost').on('click', function() {
    // Toggle the visibility of the password input and change the eye icon
    var passwordInput = $('#typePassword');
    var passwordInput1 = $('#typeConfirmPassword');
    passwordInput.toggleAttr('type', 'password', 'text');
    passwordInput1.toggleAttr('type', 'password', 'text');
    toggleEyeIcon($(this));
  });

  // jQuery plugin to toggle attribute values
  $.fn.toggleAttr = function(attr, val1, val2) {
    return this.each(function() {
      var currentVal = $(this).attr(attr);
      var newVal = currentVal === val1 ? val2 : val1;
      $(this).attr(attr, newVal);
    });
  };

  // Function to toggle the eye icon
  function toggleEyeIcon(element) {
    var eyeIcon = element.find('i');
    eyeIcon.toggleClass('fa-eye fa-eye-slash');
  }
</script>
@if(config('access.captcha.login'))
@captchaScripts
@endif
@endpush