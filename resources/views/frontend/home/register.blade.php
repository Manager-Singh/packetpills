<style>
span#error-msg {
    color: red;
    font-weight: 600;
}
</style>
<div class="hero hero--desktop hero--exp-2"
    style="background-size: auto 125%;background-position: center center;background-size: contain;padding: 0;min-height: 100vh;background-repeat: no-repeat; background-image: url({{asset('website/assets/images/TransparentCircle.png')}});">

    <div class="landing-wrapper margin-t-xl">
   
        <!-- <div  class="row align-items-center">
            <div class="col-md-2"><button type="button" class="btn btn-outline-primary"><i class="fas fa-chevron-left"></i></button></div>
            <div class="col-md-7 text-center"><a href="#">
                        <img  alt="" height="90" class="pp-logo__default" src="{{asset('website/assets/images/logo-removebg.png')}}">
                    </a></div>
            <div class="col-md-3" style="padding-left: 72px;">
                <p class="paragraph color-white">Already a member?</p>
                <a class="color-link h4 font-semibold is-clickable" href="{{route('frontend.auth.new.login')}}" bis_skin_checked="1">Sign In</a>
            </div>
        </div>     -->
        <div class="content-exp2">
            <div>
                <h1 class="hero__heading color-brand font-bold txt-c"> Let's Get Started !</h1>
                
            </div>

        </div>
        <div class="row center-xs">
            <div class="column column--xs-8 column--s-8 column--m-6 column--l-5 column--xl-4">
                <div class="hero__form margin-t-xl hero__form--vertical signup-form--desktop">

                    <div aria-label="Sign up with Pocketpills">
                        @if(Auth::check())
                            <p class="paragraph font-semibold hero__form-label txt-center--xs color-brand">
                                Hi, 
                                @if(isset(Auth::user()->full_name))

                                    {{Auth::user()->full_name}}

                                @else
                                    Alexandre
                                @endif
                                
                            </p>
                            <p class="paragraph font-semibold hero__form-label txt-center--xs color-brand"> Welcome back!</p><a href="{{route('frontend.user.dashboard')}}"><button _ngcontent-serverapp-c48="" type="submit" class="btn btn--brand txt-defaultcase go-dashboard-btn"><span _ngcontent-serverapp-c48="" translate="" class="button__label txt-defaultcase">Go to dashboard</span><i class="fa fa-angle-arrow-right" aria-hidden="true"></i></button></a>
                        @else
                        <p style="margin-bottom: 0;" class="paragraph font-semibold hero__form-label txt-center--xs color-brand">Simply Signup to
                            Join </p>

                        @endif



                        <div class="row row--nogutters">
                            <div class="column column--xs-12 row row--nogutters center-xs">
                                <div class="hero__form-wrapper">
                                    <div class="hero__form-row row row--nogutters row--grow-3">
                                        <div class="column column--xs full-width">
                                            <div class="hero__form-field">
                                                @if(!Auth::check())
                                                <form novalidate="" action="{{route('frontend.auth.login.post')}}" method="POST" class="ng-untouched ng-pristine ng-valid">
                                                

                                                <div class="form-inline">
                                                    <div class="form-inline__form">
                                                        <label class="hide-label" for="email">Email</label>
                                                        <div class="tel">
                                                            <div class="tel-prefix txt-c" aria-label="Country code +1">
                                                            <b>Email</b>
                                                            </div>
                                                            <div class="tel-input">
                                                                <input type="email" id="email" class="home-input full-width font-semibold ng-untouched ng-pristine ng-invalid" id="phone-number" placeholder="Enter valid email" aria-required="true" required="">
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="form-inline">
                                                    <div class="form-inline__form">
                                                    <div class="row">
                                                        <div class="col otp-box hide" style="display:none;">
                                                            <div class="form-group mt-4">
                                                               <small><b>Your verification code has been sent to your email. Please enter it below to register your account.</b></small>
                                                                {{ html()->text('otp')->class('form-control w-100')->placeholder(__(' Enter Two-Factor Code'))->attribute('id','otp')->attribute('maxlength', 6)->attribute('minlength', 6)->required() }}
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                        
                                                    </div>

                                                </div>
                                                <div id="regs_form"></div>


                                                <div class="margin-t-l">
                                                    <span id="error-msg" class="p-2 float-left"></span>
                                                    <button type="button" class="btn btn--full btn--brand txt-defaultcase lineheight-reset request-otp">{{ __('labels.frontend.auth.get_started') }}</button>
                                                    <button type="button" class="btn btn--full btn--brand txt-defaultcase lineheight-reset register-submit" style="display:none">{{ __('Verify Two Factor Code') }} & {{ __('labels.frontend.auth.next') }}</button>
                                                    <a href="{{route('frontend.index')}}" ><button type="button" class="btn btn--full btn--brand txt-defaultcase lineheight-reset mt-2">Start Again</button></a>
                                                </div>


                                                <div aria-live="assertive" role="alert" aria-atomic="true"
                                                    aria-label="This field is required.">

                                                </div>

                                                <div aria-live="assertive" role="alert" aria-atomic="true"
                                                    aria-label="false">
                                                    <div class="form-group__msg margin-t-s txt-c" style="display: none;">
                                                        <span class="color-error xsmall txt-c font-semibold"
                                                            style="display: none;">This field is required.</span>
                                                        <span class="color-error xsmall txt-c font-semibold"></span>

                                                    </div>
                                                </div>
                                            </form> 
                                            <!-- <form novalidate="" action="{{route('frontend.auth.login.post')}}" method="POST" class="ng-untouched ng-pristine ng-valid">
                                                

                                                <div class="form-inline">
                                                    <div class="form-inline__form">
                                                        <label class="hide-label"
                                                            for="phone-number">Phone</label>
                                                        <div class="tel">
                                                            <div class="tel-prefix txt-c" aria-label="Country code +1">
                                                                
                                                                <select class="form-control color-dark font-semibold" id="dialing-code" name="dialing_code">
                                                                    <option value="1">+1</option>
                                                                    <option value="91">+91</option>
                                                                </select>
                                                            </div>
                                                            <div class="tel-input">
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
                                                    </div>

                                                </div>
                                                <div class="form-inline">
                                                    <div class="form-inline__form">
                                                    <div class="row">
                                                        <div class="col otp-box hide" style="display:none;">
                                                            <div class="form-group mt-4">
                                                               
                                                                {{ html()->text('otp')->class('form-control w-100')->placeholder(__('validation.attributes.frontend.otp'))->attribute('id','otp')->attribute('maxlength', 6)->attribute('minlength', 6)->required() }}
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                        
                                                    </div>

                                                </div>


                                                <div class="margin-t-l">
                                                    <span id="error-msg" class="p-2 float-left"></span>
                                                    <button type="button" class="btn btn--full btn--brand txt-defaultcase lineheight-reset request-otp">{{ __('labels.frontend.auth.get_started') }}</button>
                                                    <button type="button" class="btn btn--full btn--brand txt-defaultcase lineheight-reset register-submit" style="display:none">{{ __('labels.frontend.auth.otp_verfied') }} & {{ __('labels.frontend.auth.next') }}</button>
                                                    <a href="{{route('frontend.index')}}" ><button type="button" class="btn btn--full btn--brand txt-defaultcase lineheight-reset mt-2">Start Again</button></a>
                                                </div>


                                                <div aria-live="assertive" role="alert" aria-atomic="true"
                                                    aria-label="This field is required.">

                                                </div>

                                                <div aria-live="assertive" role="alert" aria-atomic="true"
                                                    aria-label="false">
                                                    <div class="form-group__msg margin-t-s txt-c" style="display: none;">
                                                        <span class="color-error xsmall txt-c font-semibold"
                                                            style="display: none;">This field is required.</span>
                                                        <span class="color-error xsmall txt-c font-semibold"></span>

                                                    </div>
                                                </div>
                                            </form> -->
                                            @endif
                                            </div>
                                        </div>



                                    </div>
                                    <small keyname="landing.banner.terms"
                                        class="font-smallest tnc block margin-t-l term-cond">By proceeding, you agree to
                                        our <a href="https://misterpharmacist.com/terms-and-conditions" class="txt-underline" target="_blank">Terms of Use</a> &amp; <a
                                            href="https://misterpharmacist.com/privacy-policy" class="txt-underline" target="_blank">Privacy Policy</a>.  </small>

                                </div>
                            </div>
                            <div class="row login-with mt-3">
                                <div class="col">
                                    <div class="text-center">
                                        @include('frontend.auth.includes.socialite')
                                      </div>
                                </div><!--col-->
                            </div><!--row-->
                        </div>
                    </div>

                </div>
            </div>
        </div>


        
    </div>
</div>





@push('after-scripts')

{!!  GoogleReCaptchaV2::render('regs_form') !!}
<script>
    $(function() {


        $('.request-otp').click(function(e) {
            e.preventDefault();
            $("#error-msg").text('');
            var email = $('#email').val();
            var captchaResponse = grecaptcha.getResponse();

            
            //   console.log(phone);
            $.ajax({
                type: 'POST',
                url: "{{ route('frontend.auth.email.send.otp') }}", 
                data: {_token:"{{ csrf_token() }}",email:email,'g-recaptcha-response': captchaResponse},
                success: function(response) {
                response = JSON.parse(response);
                        console.log(response.otp);
                        if (response.error == 0 ) {
                            if(response.status == 'exist'){
                                location.href = response.route;
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
        
       /** $('.request-otp').click(function(e) {
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
                url: "{{ route('frontend.auth.send.otp') }}", 
                data: {_token:"{{ csrf_token() }}",mobile_no:phone,dialing_code:dialing_code},
                success: function(response) {
                response = JSON.parse(response);
                        console.log(response.otp);
                        if (response.error == 0 ) {
                        if(response.status == 'exist'){
                            location.href = response.route;
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
        }); **/


        $('.register-submit').click(function(e) {
                  e.preventDefault();
  
                  // Get the phone number and OTP
                  var email = $('#email').val();
                  var otp = $('#otp').val();
                  $("#error-msg").text('');
                    if(otp.length < 6){
                        $("#error-msg").text('Otp should be a 6 digit.');
                    }
                //   console.log(phone);
                    $.ajax({
                      type: 'POST',
                      url: "{{ route('frontend.auth.email.verify.otp') }}", 
                      data: {_token:"{{ csrf_token() }}",email:email,otp:otp},
                      success: function(response) {
                        console.log(response);
                        console.log(response.link);
                        response = JSON.parse(response);
                              console.log(response);
                              if (response.profile_step == 0) {
                                location.href = "{{route('frontend.auth.service.selection')}}";
                               // location.href = "{{route('frontend.user.prescription.upload')}}";
                                
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


            /*    $('.register-submit').click(function(e) {
                  e.preventDefault();
  
                  // Get the phone number and OTP
                  var phone = $('#phone-number').val();
                  var otp = $('#otp').val();
                  $("#error-msg").text('');
                    if(otp.length < 6){
                        $("#error-msg").text('Otp should be a 6 digit.');
                    }
                //   console.log(phone);
                    $.ajax({
                      type: 'POST',
                      url: "{{ route('frontend.auth.verify.otp') }}", 
                      data: {_token:"{{ csrf_token() }}",mobile_no:phone,otp:otp},
                      success: function(response) {
                        console.log(response);
                        console.log(response.link);
                        response = JSON.parse(response);
                              console.log(response);
                              if (response.profile_step == 0) {
                                location.href = "{{route('frontend.auth.service.selection')}}";
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
                });*/
        




    });

                
</script>
    @if (config('access.captcha.registration'))
        @captchaScripts
    @endif
@endpush