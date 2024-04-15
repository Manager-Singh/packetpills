@extends('frontend.layouts.website')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))
@push('after-styles')
    <style>
        .login-btn button {
            width: 100%;
            padding: 4px 0;
            font-size: 18px;
            background-color: #8ac03d;
            transition: 0.9s;
            border-color: #638e3c;
        }
        .login-btn button:hover {
            background-color: #fff;
            color: #8ac03d;
        }
        .login-btn {
            margin-bottom: 0;
        }
        .inner-div {
            padding: 22px 30px;
            box-shadow: 0px 0px 20px 1px #8ac03d36;
            margin-top: 8rem;
            border-radius: 4px;
            background-color: #fff;
            margin-bottom: 2rem;
        }
        .login-pg .section-divider:before, .section-divider:after{
            background-color: #8ac03d; 
        }
        .google-signup-btn a.btn.btn-sm.btn-outline-info.m-1 {
            padding: 5px 25px;
            border-color: #638e3c;
            color: #8ac03d;
            transition: 0.5s;
            font-size: 13px;
        }
        
        .google-signup-btn a.btn.btn-sm.btn-outline-info.m-1:hover {
            color: #fff;
            background-color: #8ac03d;
            border-color: #638e3c;
        }
        .login-pg button.btn a, .login-pg a {
            text-decoration: unset;
            transition: 0.9s;
            color: #8ac03d;
            font-weight: 600;
        }
        .login-pg button.btn a:hover, .login-pg a:hover {
            color: #638e3c;
        }
        .login-pg .form-group input {
            border-color: #638e3c !important;
            padding: 0px 10px !important;
            font-size: 15px;
        }
        .tel-input {
            border-color: #638e3c;
        }
        .tel{
            border-color: #638e3c;
        }
        .login-pg .mobile-error{
            margin-top: 10px;
            position: absolute;
        }
        span.toggle-password.LikePost {
            position: relative;
            top: -29px;
            right: 13px;
            float: right;
            font-size: 18px;
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

<div class="wrapper wrapper--small login-pg">
    <div class="content--x-small inner-div" >
    <div class="row">
              <div class="col-md-12">
                @include('includes.partials.messages')
              </div>
            </div>
        <section class="txt-c">
            <div class="">
                <h1 class="h1 color-dark font-bold"> Welcome back! </h1>
                <span>Login to your MisterPharmacist account</span>

            </div>
        </section>
        <div>
            <div class="row row--middle center-xs ">
                <div class="column column--xs-12">
                    <button class="margin-center w-full flex is-clickable google-signup-btn" style="width: 300px;">
                        @include('frontend.auth.includes.socialite')
                        <!-- <img src="{{asset('website/assets/images/google-logo.svg')}}" alt="Google logo" width="35"
                            height="35">
                        <span class="txt-l txt-no-wrap margin-center google-signup-btn__text">Sign in with Google</span>
                     -->
                    </button>
                    <div class="hidden"></div>

                </div>
            </div>
            <div class="section-divider font-bold color-dark h5"> or </div>
        </div>

        <section class="mt-0">



            {{ html()->form('POST', route('frontend.auth.login.post'))->open() }}
            <div class="row">
                <div class="col">


                    <div class="form-group">

                        <div class="custom-input">

                        <!-- <label class="label-mandatory">@lang('validation.attributes.frontend.mobileno')</label> -->
                            <label class="label-mandatory">Email</label>

                            <div class="tel phone-prefix">
                                <div class="tel-prefix txt-c">
                                    <!-- <p class="color-dark font-semibold mb-0">+1</p> -->
                                    <p class="color-dark font-semibold mb-0">Email</p>
                                </div>
                                <div class="tel-input">
                                    <!-- <input autocomplete="off" maxlength="10" type="tel"
                                        oninput="javascript: if (this.value.length &gt; this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                        onkeypress="return (event.charCode &gt;= 48 &amp;&amp; event.charCode &lt;= 57) || event.charCode == 13"
                                        size="16" pattern="\d*" keyname="landing.fields.phone"
                                        class="full-width home-input ng-untouched ng-pristine ng-invalid @error('mobile_no') is-invalid @enderror"
                                        id="phoneField" placeholder="@lang('validation.attributes.frontend.mobileno')"
                                        required="" name="mobile_no"> -->
                                        <input type="email" class="full-width home-input ng-untouched ng-pristine ng-invalid @error('email') is-invalid @enderror" id="phoneField" placeholder="Enter Registered Email" required="" name="email">
                                        <!-- @error('mobile_no')
                                            <span class="invalid-feedback mobile-error" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror -->
                                </div>
                            </div>

                            <!-- <div class="form-group__msg">
                                <span class="color-error xsmall"></span>
                            </div> -->
                        </div>
                    </div>
                    <!--form-group-->
                </div>
                <!--col-->
            </div>
            <!--row-->

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        {{ html()->label(__('validation.attributes.frontend.password'))->for('password') }}

                        @php 
                        $is_invalid = false; 
                        @endphp

                            @error('password')
                                @php 
                                    $is_invalid = true; 
                                @endphp
                            @enderror

                        
                        {{ html()->password('password')
                                        ->class(['form-control','is-invalid' => $is_invalid])
                                        ->placeholder(__('validation.attributes.frontend.password'))
                                        ->required() }}
                        <span class="toggle-password LikePost"><i class="far fa-eye"></i></span>
                        <!-- @error('password')
                            <span class="invalid-feedback pass-error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror -->
                    </div>
                    <!--form-group-->
                </div>
                <!--col-->
            </div>
            <!--row-->

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <div class="checkbox">
                            {{ html()->label(html()->checkbox('remember', true, 1) . ' ' . __('labels.frontend.auth.remember_me'))->for('remember') }}
                        </div>
                    </div>
                    <!--form-group-->
                </div>
                <!--col-->
            </div>
            <!--row-->



            <div class="row">

                <div class="col">
                    <div class="form-group margin-reset-t">
                        <button type="button" keyname="login.all.sign-up-instead"
                            class="btn btn--small color-link txt-defaultcase"> Don't have an account? <a href="{{route('frontend.index')}}" >Sign up instead</a>
                        </button>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group text-right">
                        <a href="{{ route('frontend.auth.password.reset') }}">@lang('labels.frontend.passwords.forgot_password')</a>
                    </div>
                    <!--form-group-->
                </div>
                <!--col-->
            </div>
            <!--row-->

            <div class="row">
                <div class="col">
                    <div class="form-group clearfix login-btn">
                        {{ form_submit(__('labels.frontend.auth.login_button')) }}
                    </div>
                    <!--form-group-->
                </div>
                <!--col-->
            </div>
            <!--row-->

            @if(config('access.captcha.login'))
            <div class="row">
                <div class="col">
                    @captcha
                    {{ html()->hidden('captcha_status', 'true') }}
                </div>
                <!--col-->
            </div>
            <!--row-->
            @endif

            {{ html()->form()->close() }}
           
            <small keyname="landing.banner.terms"
                class="font-smallest tnc margin-t-s color-light block margin-t-l txt-c">By proceeding, you agree to our
                <a href="#" class="txt-underline" target="_blank">Terms of Use</a> &amp; <a href="#"
                    class="txt-underline" target="_blank">Privacy Policy</a>. Message and data rates may apply. </small>
        </section>

    </div>
</div>

@endsection

@push('after-scripts')

<script>
  // Add a click event listener to elements with the class "LikePost"
  $('.LikePost').on('click', function() {
    // Toggle the visibility of the password input and change the eye icon
    var passwordInput = $('#password');
    passwordInput.toggleAttr('type', 'password', 'text');
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