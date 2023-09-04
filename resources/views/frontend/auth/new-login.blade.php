@extends('frontend.layouts.website')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))

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

<div class="wrapper wrapper--small">
    <div class="content--x-small" style="padding-top: 8rem;">
        <section class="txt-c">
            <div class="margin-t-xl">
                <h1 class="h1 color-dark font-bold"> Welcome back! </h1>
                <p>Login to your MisterPharmacist account</p>

            </div>
        </section>
        <div>
            <div class="row row--middle center-xs margin-t-xl">
                <div class="column column--xs-12">
                    <button class="margin-center w-full flex is-clickable google-signup-btn" style="width: 300px;">
                        @include('frontend.auth.includes.socialite')
                        <img src="{{asset('website/assets/images/google-logo.svg')}}" alt="Google logo" width="35"
                            height="35">
                        <span class="txt-l txt-no-wrap margin-center google-signup-btn__text">Sign in with Google</span>
                    </button>
                    <div class="hidden"></div>

                </div>
            </div>
            <div class="section-divider margin-t-xl font-bold color-dark h5"> or </div>
        </div>

        <section class="margin-t-xl">



            {{ html()->form('POST', route('frontend.auth.login.post'))->open() }}
            <div class="row">
                <div class="col">


                    <div class="form-group">

                        <div class="custom-input">

                            <label class="label-mandatory">@lang('validation.attributes.frontend.mobileno')</label>

                            <div class="tel phone-prefix">
                                <div class="tel-prefix txt-c">
                                    <p class="color-dark font-semibold">+1</p>
                                </div>
                                <div class="tel-input">
                                    <input autocomplete="off" maxlength="10" type="tel"
                                        oninput="javascript: if (this.value.length &gt; this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                        onkeypress="return (event.charCode &gt;= 48 &amp;&amp; event.charCode &lt;= 57) || event.charCode == 13"
                                        size="16" pattern="\d*" keyname="landing.fields.phone"
                                        class="full-width home-input ng-untouched ng-pristine ng-invalid"
                                        id="phoneField" placeholder="@lang('validation.attributes.frontend.mobileno')"
                                        required="" name="mobile_no">
                                </div>
                            </div>

                            <div class="form-group__msg">
                                <span class="color-error xsmall"></span>
                            </div>
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

                        {{ html()->password('password')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.password'))
                                        ->required() }}
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
                        <a
                            href="{{ route('frontend.auth.password.reset') }}">@lang('labels.frontend.passwords.forgot_password')</a>
                    </div>
                    <!--form-group-->
                </div>
                <!--col-->
            </div>
            <!--row-->

            <div class="row">
                <div class="col">
                    <div class="form-group clearfix">
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
@if(config('access.captcha.login'))
@captchaScripts
@endif
@endpush